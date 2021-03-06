<?php

namespace backend\controllers;

use common\models\OrderTicket;
use moonland\phpexcel\Excel;
use Yii;
use common\models\Order;
use backend\models\Search\Order as OrderSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionPaidIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->searchs(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionUnpaidIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->searchss(Yii::$app->request->queryParams);
        
        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
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
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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
     * Deletes an existing Order model.
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
     *  导出订单
     */
    public function actionExcel($status)
    {
        $row = Order::find()->where(['status' => $status])->all();
        foreach ($row as $key => &$value) {
            $datas = OrderTicket::find()->where(['order_id' => $value['id']])->asArray()->all();
            if ($datas) {
                $value['user_id'] = implode(',', ArrayHelper::map($datas, 'id', 'code'));
            } else {
                $value['user_id'] = '';
            }
            $value['order_time'] = date('Y-m-d H:i:s', $value['order_time']);
            $value['status'] = $value['status'] == 1 ? '已支付' : '待支付';
        }
        
        if ($row) {
            Excel::export([
                'models' => $row,
                'fileName' => date('Ymd') . '_' . 'Export',
            ]);
        }
        
    }
    
    /**
     * 电子票详情
     * @param $id
     * @return string
     */
    public function actionGetDetails($id)
    {
        $model = Order::findOne(['id' => $id]);
        $data = OrderTicket::find()->where(['order_id' => $id])->asArray()->all();
        return $this->render('updates', [
            'model' => $model,
            'data' => $data
        ]);
    }
    
}
