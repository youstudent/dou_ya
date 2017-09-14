<?php
/**
 * Created by PhpStorm.
 * User: gba12
 * Date: 2017/9/6
 * Time: 11:46
 */

namespace frontend\controllers;


use Behat\Gherkin\Loader\YamlFileLoader;
use common\components\GetUserInfo;
use common\models\Activity;
use common\models\CollectActivity;
use common\models\CollectMerchant;
use common\models\Member;
use common\models\Merchant;
use common\models\MessageCode;
use common\models\User;
use yii\helpers\ArrayHelper;

class UserController extends ObjectController
{
    /**
     * 获取用户资料
     * @return mixed
     */
    public function actionGetUser()
    {
        $data = Member::find()->select('name,sex,phone,headimgurl')->where(['id'=>GetUserInfo::actionGetUserId()])->one();
        if ($data) {
            return $this->returnAjax(1, '成功', $data);
        }
        return $this->returnAjax(0, '未查询到用户资料');
        
    }
    
    /**
     * 获取我收藏的活动
     * @return mixed
     */
    public function actionMyActivity()
    {
        
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        //获取当前用户收藏活动的ID
        $Activity_id = CollectActivity::find()->orderBy('created_at ASC')->select('Activity_id')->where(['user_id'=>GetUserInfo::actionGetUserId()])->asArray()->all();
        if (!$Activity_id){
            return $this->returnAjax(0,'没有收藏活动');
        }
        $new_activity_id= ArrayHelper::map($Activity_id,'Activity_id','Activity_id');
        //根据ID去查询活动
        $data = Activity::find()->where(['id'=>$new_activity_id])->asArray()->all();
        $result = Activity::formatting($data);
        return $this->returnAjax(1,'成功',$result);
        
    }
    
    
    /**
     * 获取我收藏的商家
     * @return mixed
     */
    public function actionMyMerchant()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        
        //获取当前用户收藏商家的ID
        $merchant_id = CollectMerchant::find()->select('merchant_id')->where(['user_id' => GetUserInfo::actionGetUserId()])->asArray()->all();
        if (!$merchant_id) {
            return $this->returnAjax(0, '没有收藏商家');
        }
        $new_merchant_id = ArrayHelper::map($merchant_id, 'merchant_id', 'merchant_id');
        //根据ID去查询活动
        $data = Merchant::find()->where(['id' => $new_merchant_id])->asArray()->all();
        foreach ($data as $key => &$value) {
            $value['in_activity'] = Merchant::getInActivity($value['id']);
            $value['history_activity'] = Merchant::getHistoryActivity($value['id']);
        }
        return $this->returnAjax(1, '成功', $data);
        
    }
    
    /**
     * 发送短信验证码
     * @return mixed
     */
    public function actionSendSms(){
        if (!\Yii::$app->request->isPost){
            return $this->returnAjax(0,'请使用post');
        }
        $phone = \Yii::$app->request->post('phone');
        if (!$phone){
            return $this->returnAjax(0,'请输你要发送短信的手机号码');
        }
        $sms = new MessageCode();
        return $sms->sms($phone)? $this->returnAjax(1,'发送短信成功'):$this->returnAjax(0,'发送短信失败');
    }
    
    /**
     *   绑定手机号码
     * @return mixed
     */
    public function actionCheckCode(){
        if (!\Yii::$app->request->isPost){
            return $this->returnAjax(0,'请使用post');
        }
        $code = \Yii::$app->request->post('code');
        $phone = \Yii::$app->request->post('phone');
        if (!$code || !$phone){
            return $this->returnAjax(0,'请输入短信验证码或手机号码');
        }
        $model = new MessageCode();
        if ($model->Code($code,$phone)){
            return $this->returnAjax(1,'绑定手机成功');
        }
            return $this->returnAjax(0,'验证码错或者短信超过有效期');
    }
    
}