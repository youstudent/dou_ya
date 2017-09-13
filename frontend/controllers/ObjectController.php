<?php
/**
 * @link http://www.lrdouble.com/
 * @copyright Copyright (c) 2017 Double Software LLC
 * @license http://www.lrdouble.com/license/
 */
namespace frontend\controllers;

use yii\web\Controller;
use yii\web\Response;
/**
 * Class ObjectController
 * @package backend\controllers
 */
class ObjectController extends Controller
{
    public $layout = false;

    public $login_member = [];
    /**
     * 检查是否有权限执行代码
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action)
    {
        $this->login_member = \Yii::$app->session->get('member');
        if(empty($this->login_member) && !\Yii::$app->wechat->isAuthorized()) {
        //if(!\Yii::$app->wechat->isAuthorized()) {
            return \Yii::$app->wechat->authorizeRequired()->send();
        }


        \Yii::$app->response->format = Response::FORMAT_JSON;
        return true;
    }

    /**
     * api 接口统一返回的数据
     * @param $code -2 -1 0 1 2 3
     * @param $message
     * @param $data
     * @param string $time
     * @return mixed
     */
    public function returnAjax($code, $message, $data = [], $time = '')
    {
        if ($time == ''){
            $time = date("Y-m-d H:i:s");
        }
        $datas['code'] = $code;
        $datas['message'] = $message;
        $datas['time'] = $time;
        $datas['data'] = $data;
        return $datas;
    }
}