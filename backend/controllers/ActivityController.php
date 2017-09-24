<?php

namespace backend\controllers;
use backend\components\ImgUrl;
use common\models\ActivityTicket;
use common\models\MessageCode;
use common\models\Order;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Yii;
use common\models\Activity;
use backend\models\Search\Activity as ActivitySearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ActivityController implements the CRUD actions for Activity model.
 */
class ActivityController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Activity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * 历史数据
     * @return string
     */
    public function actionHistory()
    {
        $searchModel = new ActivitySearch();
        $dataProvider = $searchModel->searchs(Yii::$app->request->queryParams);
    
        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Activity model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Activity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Activity();
        if ( $name = Yii::$app->request->get('name')){
            $model->merchant_name=$name;
        }
        $models = new ActivityTicket();
        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($id = $model->add(Yii::$app->request->post('ActivityTicket'))) {
                Yii::$app->getSession()->setFlash('success', '添加活动成功');
                return $this->redirect(['view', 'id' => $model->id]);
            }
            Yii::$app->getSession()->setFlash('danger', $model->getFirstErrors());
            return $this->redirect(['create']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'models' => $models,
            ]);
        }
    }

    /**
     * Updates an existing Activity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $models = ActivityTicket::find()->where(['activity_id' => $id])->asArray()->all();
        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->edit(Yii::$app->request->post('ActivityTicket'))) {
                Yii::$app->getSession()->setFlash('success', '修改活动成功');
                return $this->redirect(['view', 'id' => $model->id]);
            }
            Yii::$app->getSession()->setFlash('danger', $model->getFirstErrors());
            return $this->redirect(['create']);
        } else {
            if ($model->purchase_limitation) {
                $model->limitation_num = 1;
            } else {
                $model->limitation_num = 0;
            }
            $model->apply_end_time = date('Y-m-d H:i:s', $model->apply_end_time);
            $model->start_time = date('Y-m-d H:i:s', $model->start_time);
            $model->end_time = date('Y-m-d H:i:s', $model->end_time);
            return $this->render('update', [
                'model' => $model,
                'models' => $models,
            ]);
        }
    }

    /**
     * Deletes an existing Activity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        //删除票种
        ActivityTicket::deleteAll(['activity_id'=>$id]);
        return $this->redirect(['/activity/index','Activity'=>['id'=>1,'merchant_id'=>'']]);
    }

    /**
     * Finds the Activity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Activity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Activity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    /**
     * 百度编辑器
     * @return array
     */
    public function actions()
    {
        $bannerUrl = '/upload/activity/';
        $Url  =ImgUrl::Url($bannerUrl);
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
                'config' => [
                   'imageUrlPrefix' => Yii::$app->params['imgs'],
                    //'imagePathFormat' => $Url."{time}{rand:6}",
                   // "imageUrlPrefix"  => "www.douya.com",//图片访问路径前缀
                    "imagePathFormat" => "{time}{rand:6}" //上传保存路径{yyyy}{mm}{dd}
                ],
            ]
        ];
    }
    
    
    public function actionValidateForm () {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new Activity();   //这里要替换成自己的模型类
        $model->load(Yii::$app->request->post());
        return \yii\widgets\ActiveForm::validate($model);
    }
    
    
    /**
     * 停封活动
     * @param $id
     */
    public function actionStop($id){
        $Activity = Yii::$app->request->get('Activity');
        $merchant_id = '';
        if (array_key_exists('merchant_id',$Activity['Activity'])){
            $merchant_id =$Activity['Activity']['merchant_id'];
        }
        $data =  Activity::findOne(['id'=>$id]);
        $data->status=0;
        if ($data->save(false)){
            Yii::$app->getSession()->setFlash('danger','停封活动成功');
            if ($merchant_id){
                return $this->redirect(['index','Activity'=>['merchant_id'=>$merchant_id,'id'=>1]]);
            }
                return $this->redirect(['/activity/index','Activity'=>['id'=>1,'merchant_id'=>'']]);
        }
        Yii::$app->getSession()->setFlash('danger','停封活动失败');
        if ($merchant_id){
            return $this->redirect(['index','Activity'=>['merchant_id'=>$merchant_id]]);
        }
        return $this->redirect(['/activity/index','Activity'=>['id'=>1,'merchant_id'=>'']]);
    }
    
    /**
     * 启用活动
     * @param $id
     */
    public function actionOpen($id){
        $Activity = Yii::$app->request->get('Activity');
        $merchant_id = '';
        if (array_key_exists('merchant_id',$Activity['Activity'])){
            $merchant_id =$Activity['Activity']['merchant_id'];
        }
        $data =  Activity::findOne(['id'=>$id]);
        $data->status=1;
        if ($data->save(false)){
            Yii::$app->getSession()->setFlash('info','启用活动成功');
            if ($merchant_id){
                return $this->redirect(['index','Activity'=>['merchant_id'=>$merchant_id,'id'=>1]]);
            }
            return $this->redirect(['/activity/index','Activity'=>['id'=>1,'merchant_id'=>'']]);
        }
        Yii::$app->getSession()->setFlash('danger','启用活动失败');
        if ($merchant_id){
            return $this->redirect(['index','Activity'=>['merchant_id'=>$merchant_id]]);
        }
        return $this->redirect(['/activity/index','Activity'=>['id'=>1,'merchant_id'=>'']]);
    }
    
    
    /**
     * 活动票种
     * @param $id
     * @return string
     */
    public function actionTicket($id)
    {
        $data = ActivityTicket::find()->where(['activity_id' => $id])->asArray()->all();
        return $this->render('ticket', [
            'models' => $data
        ]);
    }
    
}
