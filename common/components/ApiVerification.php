<?php

/**
 * Created by PhpStorm.
 * User: gba12
 * Date: 2017/9/4
 * Time: 17:29
 */
class ApiVerification
{
    /**
     * 检查是否有权限执行代码
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return true;
    }
    
    /**
     * Api基本数据验证
     */
    public static function Verification($attribute,$message){
        if (!\Yii::$app->request->isPost) {
            return self::returnAjax(0, '请用POST请求方式');
        }
        $keyword = \Yii::$app->request->post($attribute);
        if (!$keyword) {
            return self::returnAjax(0, $message);
        }
        return $keyword;
    
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