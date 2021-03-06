<?php
/**
 * Created by PhpStorm.
 * User: gba12
 * Date: 2017/9/6
 * Time: 10:35
 */

namespace frontend\controllers;


use Behat\Gherkin\Loader\YamlFileLoader;
use common\models\Activity;
use common\models\Order;
use common\models\OrderRefund;
use frontend\models\GetUserInfo;
use PHPUnit\Framework\Constraint\IsFalse;

class RefundOrderController extends ObjectController
{
    /**
     * 查询我的退款订单
     * @return mixed
     */
    public function actionRefund()
    {
        if (!GetUserInfo::check()){
            return $this->returnAjax(0, '你被停封了!请联系管理员');
        }
        
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请使用POST方式');
        }
        $user_id = GetUserInfo::GetUserId();

        //分页数据
        $pageSize = \Yii::$app->request->post('page');
        if (!isset($pageSize) || empty($pageSize)) {
            $page = 1;
        } else {
            $page = $pageSize;
        }
        //TODO::要改的size
        $size = \Yii::$app->params['size'];
        $limit = ($page-1) * $size;
        $count = Order::find()->select(['order_number', 'activity_name', 'status', 'id','activity_id'])->where(['user_id' => $user_id, 'status' => [2, 3, 4]])->count();
        $totalPage = ceil($count / $size);
        $nowPage = $page;
        $pageInfo = ['totalPage'=>$totalPage, 'nowPage'=>$nowPage];

        //查询用户退款订单
        //TODO :  status    2:待处理   3:退款通过   4:拒绝退款
        $data = Order::find()->select(['order_number', 'activity_name', 'status', 'id','activity_id'])->where(['user_id' => $user_id, 'status' => [2, 3, 4]])
            ->asArray()
            ->limit($size)
            ->offset($limit)
            ->all();
        if (!$data) {
            return $this->returnAjax(0, '没有退款信息');
        }
        foreach ($data as $key => &$v) {
            if ($rows = Activity::findOne(['id'=>$v['activity_id']])){
                $v['activity_img'] =\Yii::$app->params['imgs'].$rows->activity_img;
            }
            if ($row = OrderRefund::findOne(['order_id' => $v['id']])) {
                $v['created_at'] = date('Y年m月d日', $row->created_at);
                $v['money'] = $row->money;
            }
        }
        $datas['data'] = $data;
        $datas['pageInfo'] = $pageInfo;
        return $this->returnAjax(1, '成功', $datas);
        
    }
    
    
    /**
     * 查询我的订单详情
     * @return mixed
     */
    public function actionRefundDetail()
    {
        if (!GetUserInfo::check()){
            return $this->returnAjax(0, '你被停封了!请联系管理员');
        }
        
        if (!\Yii::$app->request->isPost) {
            //return $this->returnAjax(0, '请使用POST方式');
        }
        $order_id = \Yii::$app->request->post('order_id');
        if (!$order_id) {
            return $this->returnAjax(0, '请传order_id参数或者user_id');
        }
        //查询用户退款订单
        //TODO :  status    2:待处理   3:退款通过   4:拒绝退款
        $data = Order::find()->select(['order_number', 'activity_name', 'status', 'id','sell_all'])->where(['id' => $order_id])->asArray()->one();
        if (!$data) {
            return $this->returnAjax(0, '查询到退款详情');
        }
        $data['shenqing_wenan'] = '您的退款已提交,请耐心等待工作人员审核';
        $row = OrderRefund::find()->where(['order_id' => $order_id])->asArray()->orderBy('created_at DESC')->all();
        $rows = OrderRefund::find()->where(['order_id' => $order_id])->asArray()->orderBy('created_at DESC')->one();
        $data['created_at'] =date('Y-m-d H:i:s',$rows['created_at']);
        
        $count = count($row);
        $i = 1;
       foreach ($row as $k => &$v) {
           $v['created_at'] = date('Y-m-d H:i:s',$v['created_at']);
           $v['updated_at'] = date('Y-m-d H:i:s',$v['updated_at']);
           if($i < $count){
               $v['flag'] = $data['status'];
           }else{
               $v['flag'] = 4;
           }
           unset($v['bank_card']);
           unset($v['money']);
           unset($v['opening_bank']);
           unset($v['opening_man']);
           unset($v['order_id']);
           unset($v['id']);
           unset($v['pass_reason']);
           $i++;
       }
        $data['flow'] = $row;
        
        return $this->returnAjax(1, '成功', $data);
        
    }
    
    
}