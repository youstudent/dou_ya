<?php
/**
 * Created by PhpStorm.
 * User: gba12
 * Date: 2017/9/6
 * Time: 11:46
 */

namespace frontend\controllers;


use Behat\Gherkin\Loader\YamlFileLoader;
use common\models\Activity;
use common\models\CollectActivity;
use common\models\CollectMerchant;
use common\models\Member;
use common\models\Merchant;
use common\models\MessageCode;
use common\models\User;
use frontend\models\GetUserInfo;
use yii\helpers\ArrayHelper;

class UserController extends ObjectController
{
    /**
     * 获取用户资料
     * @return mixed
     */
    public function actionGetUser()
    {
        if (!GetUserInfo::check()){
            return $this->returnAjax(0, '你被停封了!请联系管理员');
        }
        
        $data = Member::find()->select('name,sex,phone,headimgurl')->where(['id'=> GetUserInfo::GetUserId()])->one();
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
    
        if (!GetUserInfo::check()){
            return $this->returnAjax(0, '你被停封了!请联系管理员');
        }
        
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        //获取当前用户收藏活动的ID
        $Activity_id = CollectActivity::find()->orderBy('created_at ASC')->select('Activity_id')->where(['user_id'=>GetUserInfo::GetUserId()])->asArray()->all();
        if (!$Activity_id){
            return $this->returnAjax(0,'没有收藏活动');
        }
        $new_activity_id= ArrayHelper::map($Activity_id,'Activity_id','Activity_id');

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
        $count = Activity::find()->where(['id'=>$new_activity_id])->count();
        $totalPage = ceil($count / $size);
        $nowPage = $page;
        $pageInfo = ['totalPage'=>$totalPage, 'nowPage'=>$nowPage];

        //根据ID去查询活动
        $data = Activity::find()->where(['id'=>$new_activity_id])
            ->asArray()
            ->limit($size)
            ->offset($limit)
            ->all();
        $result = Activity::formatting($data);
        $datas ['data'] = $result;
        $datas ['pageInfo'] = $pageInfo;
        return $this->returnAjax(1,'成功',$datas);
        
    }
    
    
    /**
     * 获取我收藏的商家
     * @return mixed
     */
    public function actionMyMerchant()
    {
        if (!GetUserInfo::check()){
            return $this->returnAjax(0, '你被停封了!请联系管理员');
        }
        
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        
        //获取当前用户收藏商家的ID
        $merchant_id = CollectMerchant::find()->select('merchant_id')->where(['user_id' => GetUserInfo::GetUserId()])->asArray()->all();
        if (!$merchant_id) {
            return $this->returnAjax(0, '没有收藏商家');
        }
        $new_merchant_id = ArrayHelper::map($merchant_id, 'merchant_id', 'merchant_id');

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
        $count = Merchant::find()->where(['id' => $new_merchant_id])->count();
        $totalPage = ceil($count / $size);
        $nowPage = $page;
        $pageInfo = ['totalPage'=>$totalPage, 'nowPage'=>$nowPage];

        //根据ID去查询商家
        $data = Merchant::find()->where(['id' => $new_merchant_id])
            ->asArray()
            ->limit($size)
            ->offset($limit)
            ->all();
        foreach ($data as $key => &$value) {
            $value['in_activity'] = Merchant::getInActivity($value['id']);
            $value['logo'] = \Yii::$app->params['imgs'].$value['logo'];
            $value['history_activity'] = Merchant::getHistoryActivity($value['id']);
        }
        $datas['data'] = $data;
        $datas['pageInfo'] = $pageInfo;
        return $this->returnAjax(1, '成功', $datas);
        
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
        return $sms->sms($phone)? $this->returnAjax(1,'发送短信成功'):$this->returnAjax(0,'短信验证码30分钟内有效');
    }
    
    /**
     *   绑定手机号码
     * @return mixed
     */
    public function actionCheckCode(){
    
        if (!GetUserInfo::check()){
            return $this->returnAjax(0, '你被停封了!请联系管理员');
        }
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