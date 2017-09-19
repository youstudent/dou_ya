<?php
/**
 * User: harlen-angkemac
 * Date: 2017/9/14 - 上午9:50
 *
 */

namespace frontend\controllers;


use common\models\Member;
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
            // 你的逻辑
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