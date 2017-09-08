<?php
/**
 * Created by PhpStorm.
 * User: gba12
 * Date: 2017/9/8
 * Time: 14:50
 */

namespace backend\controllers;

use EasyWeChat\Foundation\Application;
use maxwen\easywechat\Wechat;
use maxwen\easywechat\WechatUser;
use yii\base\Exception;
use yii\web\Controller;

class WechatLoginController extends Controller
{
    //微信登录
    public function actionLogin(){
        // 微信网页授权:
        if(\Yii::$app->wechat->isWechat && !\Yii::$app->wechat->isAuthorized()) {
            return \Yii::$app->wechat->authorizeRequired()->send();
        }
        /*$app = new Application(\Yii::$app->params['wechat']);
        $oauth = $app->oauth;
         // 未登录
        if (empty($_SESSION['wechat_user'])) {
            $_SESSION['target_url'] = 'wechat-login/accredit';
            return $oauth->redirect();
            // 这里不一定是return，如果你的框架action不是返回内容的话你就得使用
            // $oauth->redirect()->send();
        }
         // 已经登录过
        $user = $_SESSION['wechat_user'];
         // ...*/
    
    }
    
    /*public function actionPay(){
        // 微信支付(JsApi):
        $orderData = [
            'openid' => '.. '
            // ... etc.
        ];
        $order = new Wechat($orderData);
        $payment = \Yii::$app->wechat->payment;
        $prepayRequest = $payment->prepare($order);
        if($prepayRequest->return_code = 'SUCCESS' && $prepayRequest->result_code == 'SUCCESS') {
            $prepayId = $prepayRequest->prepay_id;
        }else{
            throw new Exception('微信支付异常, 请稍后再试');
        }
    
        $jsApiConfig = $payment->configForPayment($prepayId);
    
        return $this->render('wxpay', [
            'jsApiConfig' => $jsApiConfig,
            'orderData'   => $orderData
        ]);
    }*/
    
    /**
     *  微信授权
     */
    public function actionAccredit(){
        $app = new Application(\Yii::$app->params['wechat']);
        $response = $app->oauth->scopes(['snsapi_userinfo'])
        ->redirect();
        
        return $response;
    }
    
    public function actionGetopid(){
        $OP = new Wechat();
        var_dump($OP->get);
    }
    
}