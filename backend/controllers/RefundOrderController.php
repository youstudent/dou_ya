<?php

namespace backend\controllers;

use common\models\OrderRefund;
use common\models\OrderTicket;
use Yii;
use common\models\Order;
use backend\models\Search\Order as OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class RefundOrderController extends Controller
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
     *  退款已处理
     * Lists all Order models.
     * @return mixed
     */
    public function actionPaidIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->searchss(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     *  退款待处理
     * Lists all Order models.
     * @return mixed
     */
    public function actionUnpaidIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * 退款通过
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionGetPass($id){
       $data =  Order::findOne(['id'=>$id]);
       if ($data){
         $data->status=3;
         $row = OrderRefund::findOne(['order_id'=>$id]);
         $row->updated_at=time();
         //删除该订单的票种
          OrderTicket::deleteAll(['order_id'=>$data->id]);
         if ($data->save(false) && $row->save(false)){
             Yii::$app->getSession()->setFlash('info','通过成功');
             return $this->redirect(['paid-index','Order'=>['status'=>[2]]]);
         }
       }else{
          throw new NotFoundHttpException('没找到该订单');
       }
    }
    
    /**
     * 退款拒绝
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUnPass($id){
        $model = OrderRefund::findOne(['order_id'=>$id]);
        if ($model->UnPass(Yii::$app->request->post())) {
            Yii::$app->getSession()->setFlash('danger','拒绝成功');
            return $this->redirect(['paid-index','Order'=>['status'=>[2]]]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    /** 获取订单详情
     * @param $id
     * @param $status
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionGetDetails($id,$status){
        $model  = OrderRefund::findOne(['order_id'=>$id]);
        if ($model){
            return $this->render('dateils',['model'=>$model,'status'=>$status]);
        }else{
            throw  new NotFoundHttpException('该订单退款详情未找到');
        }
        
    }
}
