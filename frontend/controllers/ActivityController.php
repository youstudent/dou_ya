<?php

namespace frontend\controllers;

use Behat\Gherkin\Loader\YamlFileLoader;
use common\models\Activity;
use common\models\ActivityTicket;
use common\models\CollectActivity;
use common\models\CollectMerchant;
use common\models\Member;
use common\models\Merchant;
use common\models\Order;
use frontend\models\GetUserInfo;
//use function GuzzleHttp\Psr7\str;
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
        if (!GetUserInfo::check()){
            return $this->returnAjax(0, '你被停封了!请联系管理员');
        }
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $orderBy = \Yii::$app->request->post('type');
        if (!$orderBy) {
            return $this->returnAjax(0, '必须传参数!!type:created_at最新,type:allpage_view最热');
        }
        $select = ['id', 'merchant_name', 'activity_name',
            'activity_img', 'start_time', 'end_time',
            'collect_number', 'allpage_view', 'apply_end_time'];
        
        //分页数据
        $pageSize = \Yii::$app->request->post('page');
        if (!isset($pageSize) || empty($pageSize)) {
            $page = 1;
        } else {
            $page = $pageSize;
        }
        //TODO::要改的size
        $size = \Yii::$app->params['size'];
        $limit = ($page - 1) * $size;
        $count = Activity::find()->select('id')->where(['status' => 1])->andWhere(['<', 'end_time', time()])->count();
        $totalPage = ceil($count / $size);
        $nowPage = $page;
        $pageInfo = ['totalPage' => $totalPage, 'nowPage' => $nowPage];
        
        //查询正在进行的活动
        $data = Activity::find()->select($select)->where(['status' => 1])->andWhere(['>', 'end_time', time()])
            ->orderBy("$orderBy DESC")
            ->asArray()
            ->limit($size)
            ->offset($limit)
            ->all();
        
        if ($data) {
            $result = Activity::formatting($data);
            $datas['data'] = $result;
            $datas['pageInfo'] = $pageInfo;
            return $this->returnAjax(1, '成功', $datas);
        }
        return $this->returnAjax(0, '暂未活动');
    }
    
    /**
     * 搜索活动名,或者商家名
     * @return mixed
     */
    public function actionSearch()
    {
        if (!GetUserInfo::check()){
            return $this->returnAjax(0, '你被停封了!请联系管理员');
        }
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $keyword = \Yii::$app->request->post('search');
        //if (!$keyword) {
          //  return $this->returnAjax(0, '请传参数!!search:商家名或者活动名');
        //}
        $select = ['id', 'merchant_name', 'activity_name',
            'activity_img', 'start_time', 'end_time',
            'collect_number', 'allpage_view', 'apply_end_time'];
        $data = Activity::find()->select($select)->where(['or', ['like', 'merchant_name', $keyword], ['like', 'activity_name', $keyword]])->andWhere(['status' => 1])->asArray()->all();
        if ($data) {
            $result = Activity::formatting($data);
            return $this->returnAjax(1, '成功', $result);
        }
        return $this->returnAjax(0, '该商家或活动已下线');
    }
    
    /**
     * 活动详情 并且增加浏览量
     * @return string
     */
    public function actionDetails()
    {
        if (!GetUserInfo::check()){
            return $this->returnAjax(0, '你被停封了!请联系管理员');
        }
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $activity_id = \Yii::$app->request->post('activity_id');
        $data = Activity::find()->where(['id' => $activity_id])->asArray()->one();
        if (!$data){
            return $this->returnAjax(0, '该活动已失效');
        }
        if ($data) {
            $row = Merchant::findOne(['id' => $data['merchant_id']]);
            // 返回查询的活动详情的结果
            $result = Activity::details($data);
            $result['logo'] = \Yii::$app->params['imgs'] . $row->logo;
            $result['merchant_label'] = $row->merchant_label;
            $result['collect_merchant'] = CollectMerchant::find()->where(['user_id' => GetUserInfo::GetUserId(), 'merchant_id' => $data['merchant_id']])->exists();
            $result['collect_activity'] = CollectActivity::find()->where(['user_id' => GetUserInfo::GetUserId(), 'activity_id' => $data['id']])->exists();
            // 增加活动的点击率
            $results = Activity::findOne(['id' => $activity_id]);
            $results->allpage_view = $results->allpage_view + 1;
            $results->save(false);
            return $this->returnAjax(1, '成功', $result);
        }
        return $this->returnAjax(0, '该活动已失效');
    }
    
    /**
     * 查询我的活动 (已支付|待支付)
     * @return mixed
     */
    public function actionMyActivity()
    {
        if (!GetUserInfo::check()){
            return $this->returnAjax(0, '你被停封了!请联系管理员');
        }
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        // type 0待支付  1已支付
        $type = \Yii::$app->request->post('type');
        //分页数据
        $pageSize = \Yii::$app->request->post('page');
        if (!isset($pageSize) || empty($pageSize)) {
            $page = 1;
        } else {
            $page = $pageSize;
        }
        //TODO::要改的size
        $size = \Yii::$app->params['size'];
        $limit = ($page - 1) * $size;
        if($type ==1){
            $count = Order::find()->where(['user_id' => GetUserInfo::GetUserId(), 'status' => [$type,4]])->count();
        }else{
            $count = Order::find()->where(['user_id' => GetUserInfo::GetUserId(), 'status' => $type])->count();
        }
        $totalPage = ceil($count / $size);
        $nowPage = $page;
        $pageInfo = ['totalPage' => $totalPage, 'nowPage' => $nowPage];
        if ($type ==1){
            $data = Order::find()->where(['user_id' => GetUserInfo::GetUserId(), 'status' => [$type,4]])
                ->orderBy('order_time DESC')
                ->asArray()
                ->limit($size)
                ->offset($limit)
                ->all();
        }else{
            $data = Order::find()->where(['user_id' => GetUserInfo::GetUserId(), 'status' => $type])
                ->orderBy('order_time DESC')
                ->asArray()
                ->limit($size)
                ->offset($limit)
                ->all();
        }
        if (!$data) {
            return $this->returnAjax(0, '没有活动订单');
        }
        //格式化订单时间,,
        foreach ($data as $key => &$value) {
            if ($row = Activity::findOne(['id' => $value['activity_id']])) {
                $value['activity_img'] = \Yii::$app->params['imgs'] . $row->activity_img;
            } else {
                $value['activity_img'] = '';
            }
            $value['order_time'] = date('Y年m月d日 H:i:s', $value['order_time']);
            //查询订到总的价格
        }
        $datas['data'] = $data;
        $datas['pageInfo'] = $pageInfo;
        return $this->returnAjax(1, '成功', $datas);
    }
    
    /**
     * 参加活动
     * @return mixed
     */
    public function actionJoinActivity()
    {
        if (!GetUserInfo::check()){
            return $this->returnAjax(0, '你被停封了!请联系管理员');
        }
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
            return $this->returnAjax(1, '该活动报名截止或已下线');
        }
        //处理图片
        $data['activity_img'] = \Yii::$app->params['imgs'] . $data['activity_img'];
        //查询票种
        $ticket = ActivityTicket::find()->select('id,price,title')->orderBy('price ASC')->where(['activity_id' => $activity_id])->asArray()->all();
        //合并活动和票种
        foreach ($ticket as &$value) {
            $value['num'] = 0;
        }
        $data['ticket'] = $ticket;
        return $this->returnAjax(1, '成功', $data);
        
    }
    
    /**
     * 收藏活动(如果存在就删除,如果不存在就添加)
     * @return mixed
     */
    public function actionCollectActivity()
    {
        if (!GetUserInfo::check()){
            return $this->returnAjax(0, '你被停封了!请联系管理员');
        }
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $model = new CollectActivity();
        //接收参数
        $model->load(\Yii::$app->request->post(), '');
        $model->user_id = GetUserInfo::GetUserId();
        if (!Activity::find()->where(['id' => $model->activity_id])->exists()) {
            return $this->returnAjax(0, '该活动不存在ID' . $model->activity_id);
        }
        
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $row = CollectActivity::findOne(['user_id' => $model->user_id, 'activity_id' => $model->activity_id]);
            $Activity = Activity::findOne(['id' => $model->activity_id]);
            $re = true;
            if ($row) {
                $row->delete();
                $Activity->collect_number = $Activity->collect_number - 1;
                $re = false;
            } else {
                //收藏活动
                $model->created_at = time();
                $re = true;
                if ($model->save() == false) throw new Exception('收藏活动失败');
                
                $Activity->collect_number = $Activity->collect_number + 1;
            }
            if ($Activity->save(false) == false) throw new Exception('更新活动收藏数失败');
            $transaction->commit();
            return $this->returnAjax(1, $re ? '收藏成功' : '取消成功', $re);
        } catch (Exception $e) {
            $transaction->rollBack();
            return $this->returnAjax(0, current($model->getFirstErrors()));
        }
        
    }
    
    /**
     * 收藏商家(如果收藏就删除,如果没有收藏就添加)
     * @return mixed
     */
    public function actionCollectMerchant()
    {
        if (!GetUserInfo::check()){
            return $this->returnAjax(0, '你被停封了!请联系管理员');
        }
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $model = new CollectMerchant();
        //接收参数
        $model->load(\Yii::$app->request->post(), '');
        $model->user_id = GetUserInfo::GetUserId();
        //查询商家是否存在
        if (!Merchant::find()->where(['id' => $model->merchant_id])->exists()) {
            return $this->returnAjax(0, '该商家不存在ID' . $model->merchant_id);
        }
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            //查询用户是否收藏该商家
            $re = true;
            $row = CollectMerchant::findOne(['user_id' => $model->user_id, 'merchant_id' => $model->merchant_id]);
            if ($row) {
                $row->delete();
                $re = false;
            } else {
                $model->created_at = time();
                if ($model->save() == false) throw new Exception('收藏商家失败');
                $re = true;
            }
            $transaction->commit();
            return $this->returnAjax(1, $re ? '收藏成功' : '取消成功', $re);
        } catch (Exception $e) {
            $transaction->rollBack();
            return $this->returnAjax(0, current($model->getFirstErrors()));
        }
        
    }
    
    
}
