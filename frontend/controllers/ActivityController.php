<?php

namespace frontend\controllers;

use common\models\Activity;
use common\models\ActivityTicket;
use common\models\CollectActivity;
use common\models\CollectMerchant;
use common\models\Merchant;
use common\models\Order;
use function GuzzleHttp\Psr7\str;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use PHPUnit\Framework\Constraint\IsFalse;
use Prophecy\Argument\Token\ExactValueToken;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

class ActivityController extends ObjectController
{
    /**
     * 活动列表(最新|最热)
     * @return string
     */
    public function actionNewesIndex()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $orderBy = \Yii::$app->request->post('type');
        if (!$orderBy) {
            return $this->returnAjax(0, '必须传参数!!type:created_at最新,type:allpage_view最热');
        }
        $select = ['id', 'merchant_name', 'activity_name',
                  'activity_img', 'start_time', 'end_time',
                  'collect_number', 'allpage_view'];
        $data = Activity::find()->select($select)->orderBy("$orderBy DESC")->asArray()->all();
        if ($data) {
            $result = Activity::formatting($data);
            return $this->returnAjax(1, '成功', $result);
        }
        return $this->returnAjax(0, '暂未活动');
    }
    
    /**
     * 搜索活动名,或者商家名
     * @return mixed
     */
    public function actionSearch()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $keyword = \Yii::$app->request->post('search');
        if (!$keyword) {
            return $this->returnAjax(0, '请传参数!!search:商家名或者活动名');
        }
        $select = ['id', 'merchant_name', 'activity_name',
                  'activity_img', 'start_time', 'end_time',
                  'collect_number', 'allpage_view'];
        $data = Activity::find()->select($select)->where(['or', ['like', 'merchant_name', $keyword], ['like', 'activity_name', $keyword]])->asArray()->all();
        if ($data) {
            $result = Activity::formatting($data);
            return $this->returnAjax(1, '成功', $result);
        }
        return $this->returnAjax(0, '未搜索到');
    }
    
    /**
     * 活动详情
     * @return string
     */
    public function actionDetails()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $activity_id = \Yii::$app->request->post('activity_id');
        if (!$activity_id) {
            return $this->returnAjax(0, '请传活动ID参数');
        }
        $data = Activity::find()->where(['id' => $activity_id])->asArray()->one();
        if ($data) {
            $result = Activity::details($data);
            return $this->returnAjax(1, '成功', $result);
        }
        return $this->returnAjax(0, '未找到活动详情ID为' . $activity_id);
    }
    
    
    /**
     *  更新活动浏览量
     * @return mixed
     */
    public function actionAllpageView()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $activity_id = \Yii::$app->request->post('activity_id');
        if (!$activity_id) {
            return $this->returnAjax(0, '请传活动ID参数');
        }
        if ($result = Activity::findOne(['id' => $activity_id])) {
            $result->allpage_view = $result->allpage_view + 1;
            return $result->save(false) ? $this->returnAjax(1, '成功') : $this->returnAjax(0, '增加浏览量失败ID为' . $activity_id);
        }
        return $this->returnAjax(0, '未查询活动数据ID'.$activity_id);
    }
    
    
    /**
     * 查询我的活动 (已支付|待支付)
     * @return mixed
     */
    public function actionMyActivity()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $user_id = \Yii::$app->request->post('user_id');
        $type = \Yii::$app->request->post('type');
        if (empty($user_id || $type)) {
            return $this->returnAjax(0, '用户user_id不能为空 type:0待支付1已支付');
        }
        $data = Order::find()->where(['user_id' => $user_id, 'status' => $type])->orderBy('order_time DESC')->asArray()->all();
        if (!$data) {
            return $this->returnAjax(0, '没有活动订单');
        }
        //格式化订单时间,,
        foreach ($data as $key => &$value) {
            $value['order_time'] = date('Y年m月d日', $value['order_time']);
            //查询订到总的价格
        }
        return $this->returnAjax(1, '成功', $data);
    }
    
    /**
     * 参加活动
     * @return mixed
     */
    public function actionJoinActivity()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $activity_id = \Yii::$app->request->post('activity_id');
        if (!$activity_id) {
            return $this->returnAjax(0, '活动activity_id不能为空');
        }
        //查询活动
        $data = Activity::find()->select(['id', 'activity_name', 'activity_img'])->where(['id' => $activity_id, 'status' => 1])->andWhere(['>', 'apply_end_time', time()])->asArray()->one();
        if (!$data) {
            return $this->returnAjax(0, '该活动报名截止或已下线');
        }
        //处理图片
        $data['activity_img'] = \Yii::$app->params['img_domain'] . $data['activity_img'];
        //查询票种
        $ticket = ActivityTicket::find()->select('price,title')->orderBy('price ASC')->where(['activity_id' => $activity_id])->asArray()->all();
        //合并活动和票种
        $new_data = ArrayHelper::merge($ticket, $data);
    
        return $this->returnAjax(1, '成功', $new_data);
    
    }
    
    /**
     * 收藏活动
     * @return mixed
     */
    public function actionCollectActivity()
    {
        if (!\Yii::$app->request->post()) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $model = new CollectActivity();
        //接收参数
        $model->load(\Yii::$app->request->post(), '');
        if (!Activity::find()->where(['id' => $model->activity_id])->exists()) {
            return $this->returnAjax(0, '该活动不存在ID' . $model->activity_id);
        }
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            //收藏活动
            $model->created_at = time();
            if ($model->save() == false) throw new Exception('收藏活动失败');
            //更新活动收藏人数
            $Activity = Activity::findOne(['id' => $model->activity_id]);
            $Activity->collect_number = $Activity->collect_number + 1;
            if ($Activity->save(false) == false) throw new Exception('更新活动收藏数失败');
            $transaction->commit();
            return $this->returnAjax(1, '收藏成功');
        } catch (Exception $e) {
            $transaction->rollBack();
            return $this->returnAjax(0, current($model->getFirstErrors()));
        }
        
    }
    
    /**
     * 收藏商家
     * @return mixed
     */
    public function actionCollectMerchant()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $model = new CollectMerchant();
        //接收参数
        $model->load(\Yii::$app->request->post(), '');
        //查询商家是否存在
        if (!Merchant::find()->where(['id' => $model->merchant_id])->exists()) {
            return $this->returnAjax(0, '该商家不存在ID' . $model->merchant_id);
        }
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            //收藏商家
            $model->created_at = time();
            if ($model->save() == false) throw new Exception('收藏商家失败');
            $transaction->commit();
            return $this->returnAjax(1, '收藏成功');
        } catch (Exception $e) {
            $transaction->rollBack();
            return $this->returnAjax(0, current($model->getFirstErrors()));
        }
        
    }
    
    
}
