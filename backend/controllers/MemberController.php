<?php

namespace backend\controllers;

use SebastianBergmann\CodeCoverage\Report\Xml\Facade;
use Yii;
use common\models\Member;
use backend\models\Search\Member as MemberSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MemberController implements the CRUD actions for Member model.
 */
class MemberController extends Controller
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
     * Lists all Member models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MemberSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Member model.
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
     * Creates a new Member model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Member();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/member/index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Member model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario='update';
        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['/member/index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Member model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Member model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Member the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Member::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        
    }
    
    /**
     * 停封账号
     * @param $id
     */
    public function actionStop($id){
       $data =  Member::findOne(['id'=>$id]);
       $data->status=0;
       if ($data->save(false)){
           Yii::$app->getSession()->setFlash('info','停封账号成功');
           return $this->redirect('index');
       }
        Yii::$app->getSession()->setFlash('danger','停封账号失败');
        return $this->redirect('index');
    }
    
    /**
     * 解封账号
     * @param $id
     */
    public function actionOpen($id){
        $data =  Member::findOne(['id'=>$id]);
        $data->status=1;
        if ($data->save(false)){
            Yii::$app->getSession()->setFlash('info','解封账号成功');
            return $this->redirect('index');
        }
        Yii::$app->getSession()->setFlash('danger','解封账号失败');
        return $this->redirect('index');
    }
}
