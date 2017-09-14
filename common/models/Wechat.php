<?php
/**
 * User: harlen-angkemac
 * Date: 2017/9/14 - 上午9:53
 *
 */

namespace common\models;


use Yii;
use yii\base\Model;

class Wechat extends Model
{
    public $message = 'success';

    /**
     * 创建微信支付，并返回统一支付的数据
     * @param $orderData
     * @return array|bool
     */
    public function createWechatOrder($orderData, $openid)
    {
        $orderData = [
            'openid'       => $openid ,
            'trade_type'   => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'         => 'iPad mini 16G 白色',
            'detail'       => 'iPad mini 16G 白色',
            'out_trade_no' => '121775250120140703'. time(),
            'total_fee'    => 1, // 单位：分
            'notify_url'   => 'http://api.douyajishi.com/wechat/order-notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
        ];
        $order = new \EasyWeChat\Payment\Order($orderData);
        $payment = Yii::$app->wechat->payment;
        $prepayRequest = $payment->prepare($order);

        if ($prepayRequest->return_code = 'SUCCESS' && $prepayRequest->result_code == 'SUCCESS') {
            $prepayId = $prepayRequest->prepay_id;
        } else {
            //throw new yii\base\ErrorException('微信支付异常, 请稍后再试');
            $this->message = '微信支付异常, 请稍后再试';
            return false;
        }

        $jsApiConfig = $payment->configForPayment($prepayId);

        return [
            'jsApiConfig' => $jsApiConfig,
            'orderData'   => $orderData,
        ];
    }

    /**
     * 微信支付异步通知逻辑
     * @param $order
     */
    public function orderNotify($order)
    {

    }
}
