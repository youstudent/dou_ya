<?php
/**
 * User: harlen-angkemac
 * Date: 2017/9/14 - 上午9:50
 *
 */

namespace frontend\controllers;


use common\models\ActivityData;
use common\models\Member;
use common\models\Order;
use common\models\Wechat;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class WechatController extends ObjectController
{
    /**
     * 微信登录
     * @return mixed
     */
    public function actionLogin()
    {
        if (\Yii::$app->wechat->isWechat && !\Yii::$app->wechat->isAuthorized()) {
            return \Yii::$app->wechat->authorizeRequired()->send();
        }

        if (!isset(\Yii::$app->wechat) || empty(\Yii::$app->wechat->getUser())) {
            return $this->returnAjax(0, '未正确拉取到用户信息', []);
        }
        //自动登录逻辑
        
        $user = \Yii::$app->wechat->getUser();
        $model = new Member();
        if ($model->login($user, true)) {
            $params = \Yii::$app->request->getQueryParams();
            $target_url = ArrayHelper::getValue($params, 'nowUrl', \Yii::$app->params['wechat_domain']);
            return \Yii::$app->getResponse()->redirect($target_url);
        }
        \Yii::$app->response->format = Response::FORMAT_HTML;
        $this->render('login_warning', [
            'message' => $model->message,
        ]);
    }

    /**
     * 测试用，微信支付
     * @return mixed
     */
    public function actionPay()
    {
        $model = new Wechat();
        //TODO:: 这里传入或生成订单的数据
        $data = $model->createWechatOrder([], $this->login_member['openid']);
        if ($data === false) {
            return $this->returnAjax(0, $model->message);
        }
        return $this->returnAjax(1, $model->message, $data);
    }

    /**
     * 微信支付通知
     */
    public function actionOrderNotify()
    {
        $response = \Yii::$app->wechat->payment->handleNotify(function ($notify, $successful) {
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            $order =Order::findOne(['order_num'=>$notify->out_trade_no]);
            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->status==1) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }
            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                $order->pay_time = time(); // 更新支付时间为当前时间
                $order->status = 1;
            } else { // 用户支付失败
                $order->status = 0;
            }
            if ($order->save(false)){
                //更新该订单的所属活动的数据
                $ActivityData = new ActivityData();
                $res = $ActivityData->edit($order);
                
            } // 保存订单
            return true; // 或者错误消息
        });
        $response->send();
    }

    /**
     * 获取微信js-sdk的配置文件
     * @return mixed
     */
    public function actionWechatConfig()
    {
        $js = Yii::$app->wechat->js;
        $js->setUrl("http://www.douyajishi.com/");
        $apis = ['onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareWeibo', 'onMenuShareQZone', 'chooseWXPay'];
        $config = $js->config($apis, $debug = true, $beta = false, $json = false);
        
        return $this->returnAjax(1, 'success', compact('config'));
    }
    
}