<?php

namespace backend\controllers;

use common\models\ActivityTicket;
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
        $models = new ActivityTicket();
        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($id = $model->add(Yii::$app->request->post('ActivityTicket'))){
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
        $models = ActivityTicket::find()->where(['activity_id'=>$id])->asArray()->all();
        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->edit(Yii::$app->request->post('ActivityTicket'))){
                Yii::$app->getSession()->setFlash('success', '修改活动成功');
                return $this->redirect(['view', 'id' => $model->id]);
            }
            Yii::$app->getSession()->setFlash('danger', $model->getFirstErrors());
            return $this->redirect(['create']);
        } else {
            $model->apply_end_time=date('Y-m-d H:i:s',$model->apply_end_time);
            $model->start_time=date('Y-m-d H:i:s',$model->start_time);
            $model->end_time=date('Y-m-d H:i:s',$model->end_time);
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
        return $this->redirect(['index']);
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
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
                'config' => [
                    //'imageUrlPrefix' => '@web', /* 图片访问路径前缀 */
                    'imagePathFormat' => Yii::getAlias('@web')."/uploads/activity/{time}{rand:6}"
                   // "imageUrlPrefix"  => "www.douya.com",//图片访问路径前缀
                   // "imagePathFormat" => "/uploads/activity/{time}{rand:6}" //上传保存路径{yyyy}{mm}{dd}
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
}
