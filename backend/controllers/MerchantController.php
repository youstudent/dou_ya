<?php

namespace backend\controllers;

use backend\models\Salesman;
use common\models\CollectMerchant;
use common\models\MerchantImg;
use Yii;
use common\models\Merchant;
use backend\models\Search\Merchant as MerchantSearch;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MerchantController implements the CRUD actions for Merchant model.
 */
class MerchantController extends Controller
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
     * Lists all Merchant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MerchantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Merchant model.
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
     * Creates a new Merchant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Merchant();
        $model->created_at=time();
        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->imgs = UploadedFile::getInstances($model, 'imgs');
            if ($model->upload()) {
                // 文件上传成功
                Yii::$app->getSession()->setFlash('success', '创建成功');
                return $this->redirect(['view', 'id' => $model->id]);
            }
            return false;
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Merchant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->imgs = UploadedFile::getInstances($model, 'imgs');
            if ($model->upload()) {
                // 文件上传成功
                Yii::$app->getSession()->setFlash('success', '修改成功');
                return $this->redirect(['view', 'id' => $model->id]);
            }
            return false;
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Merchant model.
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
     * Finds the Merchant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Merchant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Merchant::findOne($id)) !== null) {
            //同时删除玩家收藏的商家ID
            CollectMerchant::deleteAll(['merchant_id'=>$id]);
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * 删除图片
     * @param $id
     * @param $v
     * @return \yii\web\Response
     */
    public function actionDel($id,$v){
        MerchantImg::deleteAll(['id'=>$id]);
        Yii::$app->getSession()->setFlash('danger', '删除成功');
        return $this->redirect(['view', 'id' => $v]);
    }
}
