<?php

namespace common\models;
use Yii;
use Flc\Alidayu\App;
use Flc\Alidayu\Client;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
/**
 * This is the model class for table "{{%message_code}}".
 *
 * @property string $id
 * @property string $phone
 * @property string $code
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class MessageCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message_code}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'code', 'created_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['phone', 'code'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Phone',
            'code' => 'Code',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    /*
     *  短信验证码请求
     */
    public function sms($phone)
    {
        if(!$this->checkCode($phone, 0)){
            return false;
        }
        // 生成验证码
        $code = rand(1000, 9999);
        // 存入数据
        $model = new MessageCode();
        $model->phone = $phone;
        $model->code = $code;
        $model->status = 0;
        $model->created_at = time();
        // 返回结果
        if (!$model->save()){
            return false;
        }
        if(!$this->SendSms($phone, $code, $model->id)){
            //发送失败，标记验证码状态
            $model->status = -1;
            $model->save();
            return false;
        }
        return true;
    }
    
    /**
     *   发送短信
     */
    public function SendSms($phone, $code, $id){
        // 配置信息
        $config = [
            'app_key'    => '*****',
            'app_secret' => '************',
           //'sandbox'    => true,  // 是否为沙箱环境，默认false
        ];
        // 使用方法一
        $client = new Client(new App($config));
        $req    = new AlibabaAliqinFcSmsNumSend();
        $req->setRecNum($phone)
            ->setSmsParam([
                'number' => $code
            ])
            ->setSmsFreeSignName('叶子坑')
            ->setSmsTemplateCode('SMS_15105357');
    
        $resp = $client->execute($req);
        // 返回结果
        print_r($resp);
        print_r($resp->result->model);
        
    }
    
    /**
     * 判断用户规定间隔时间内是否已经获取过一次验证码。未获取返回 ture 获取了 返回true
     * @param String $phone
     * @param Int $seconds
     * @return bool
     */
    protected function checkCode( $phone,  $seconds)
    {
        return !MessageCode::find()->andWhere(['>=', 'created_at', time()- $seconds])->andWhere(['phone'=>$phone])->andWhere(['!=', 'status', -1])->one();
    }


}
