<?php

namespace frontend\controllers;

use common\models\Member;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends ObjectController
{


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->returnAjax(1, '成功');
    }

    public function actionLogin()
    {

        if (!isset(Yii::$app->wechat) || empty(Yii::$app->wechat->getUser())) {
            return $this->returnAjax(0, '未正确拉取到用户信息', []);
        }
        //自动登录逻辑
        $user = Yii::$app->wechat->getUser();
        $model = new Member();
        if (!$model->login($user, true)) {
            return $this->returnAjax(0, '微信登录失败', []);
        }

        $this->goBack();
    }

    public function actionPay()
    {
        $orderData = [
            'openid'       => $this->login_member['id'],
            'trade_type'   => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'         => 'iPad mini 16G 白色',
            'detail'       => 'iPad mini 16G 白色',
            'out_trade_no' => '1217752501201407033233368018',
            'total_fee'    => 1, // 单位：分
            'notify_url'   => 'http://xxx.com/order-notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
        ];
        $order = new \EasyWeChat\Payment\Order($orderData);
        $payment = Yii::$app->wechat->payment;
        $prepayRequest = $payment->prepare($order);

        if ($prepayRequest->return_code = 'SUCCESS' && $prepayRequest->result_code == 'SUCCESS') {
            $prepayId = $prepayRequest->prepay_id;
        } else {
            throw new yii\base\ErrorException('微信支付异常, 请稍后再试');
        }

        $jsApiConfig = $payment->configForPayment($prepayId);

        return $this->render('wxpay', [
            'jsApiConfig' => $jsApiConfig,
            'orderData'   => $orderData,
        ]);
    }
}
