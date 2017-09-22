<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%member}}".
 *
 * @property string $id
 * @property string $name
 * @property string $sex
 * @property integer $phone
 * @property integer $last_time
 * @property integer $status
 * @property string $identification
 * @property string $openid
 * @property string $headimgurl
 * @property integer $order_num
 * @property integer $order_money
 */
class Member extends \yii\db\ActiveRecord
{
    public $message;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['phone'], 'required','on'=>'update'],
            [['phone', 'last_time', 'status', 'order_num', 'order_money','sex','created_at'], 'integer'],
            [['name', 'headimgurl'], 'string', 'max' => 255],
            [['identification'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '用户名',
            'sex' => '性别',
            'phone' => '电话',
            'last_time' => '最后登录时间',
            'status' => '状态',
            'identification' => '认证',
            'order_num' => '下单量',
            'order_money' => '下单总金额',
            'created_at' => '注册时间',
        ];
    }

    /**
     * 微信登录
     * @param $wechat_user
     * @param bool $update
     * @return bool
     */
    public function login($wechat_user, $update = false)
    {
        //检查用户的openid是否正确;
        if(!isset($wechat_user->id) || empty($wechat_user->id)){
            $this->message = '未正确拉取到微信数据';
            return false;
        }

        $user = self::findOne(['openid'=>$wechat_user->id]);
        $is_register = 0;
        if(!isset($user)){
            $is_register = 1;
            $user = new Member();
            $user->register($wechat_user);
        }

        if($update && $is_register === 0){
            $user = $this->updateMember($wechat_user);
        }

        if($user->status != 1){
            $this->message = '已被禁止登陆';
            return false;
        }
        $user->last_time =time();//更新用户最后登录时间
        $user->save(false);
        Yii::$app->session->set('member', [
            'id' => $user->id,
            'openid' => $user->openid,
            'name' => $user->name,
        ]);

        return true;
    }

    /**
     * 注册会员
     * @param $wechat_user
     * @return bool|Member
     */
    public function register($wechat_user)
    {
//        echo '<pre>';
//        print_r($wechat_user);die;
        $model = new Member();

        $model->name = $wechat_user->name;
        $model->sex = $wechat_user->original['sex'];
        $model->phone = '';
        $model->status = 1;
        $model->last_time = time(); //最后登录时间
        $model->created_at = time(); //最后登录时间
        $model->headimgurl = $wechat_user->avatar;
        $model->openid = $wechat_user->id;
        if(!$model->save()){
            // 添加用户数据
            \common\components\Count::create(1,6);
            return false;
        }
        return $model;
    }

    /**
     * 更新会员的资料
     * @param $wechat_user
     * @return bool|static
     */
    public function updateMember($wechat_user)
    {
        $user = self::findOne(['openid'=>$wechat_user->id]);
        $user->name = $wechat_user->name;
        $user->sex = $wechat_user->original['sex'];
        $user->headimgurl = $wechat_user->avatar;


        if(!$user->save()){
            return false;
        }
        return $user;
    }
    
    
    
    public function checkPhone(){
        //从session中获取用户数据
        $member = Yii::$app->session->get('member');
        $data = Member::findOne(['id'=>$member['id']]);
        //检查用户是否绑定手机号
        if (empty($data->phone)){
            return false;
        }
        return true;
    }

   
}
