<?php

namespace common\models;
use frontend\models\GetUserInfo;
use Monolog\Handler\GelfHandler;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Yii;
use Flc\Alidayu\App;
use Flc\Alidayu\Client;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use yii\helpers\ArrayHelper;

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
            [['phone', 'code'], 'required'],
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
        if(!$this->checkCode($phone, 1800)){ //1800
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
        if (!$model->save(false)){
            return false;
        }
        if(!$this->SendSms($phone, $code, $model->id,'SMS_78595208')){
            //发送失败，标记验证码状态
            $model->status = -1;
            $model->save(false);
            return false;
        }
        return true;
    }
    
    /**
     *   发送短信  验证码和验票成功
     */
    public function SendSms($phone, $code, $id,$template){
        // 配置信息
        $config = [
            'app_key'    => '24558166',
            'app_secret' => '412f0a3698777944957ee48b96dc2863',
           //'sandbox'    => true,  // 是否为沙箱环境，默认false
        ];
        // 使用方法一
        $client = new Client(new App($config));
        $req    = new AlibabaAliqinFcSmsNumSend();
        $req->setRecNum($phone)
            ->setSmsParam([
                'code' => $code
            ])
            ->setSmsFreeSignName('豆芽集市')
            ->setSmsTemplateCode($template);
    
        $resp = $client->execute($req);
        return $resp->result->success;
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
    
    
    /**
     * 验证
     * @param $code
     * @param $phone
     * @return bool
     */
    public function Code($code,$phone){
        if (self::find()->where(['code'=>$code])->andWhere(['>=','created_at',time()-1800])->exists()){
            $data  = Member::findOne(['id'=>GetUserInfo::GetUserId()]);
            $data->phone=$phone;
            return $data->save(false);
        }
            return false;
    }
    
    /**
     *  验票成功发送短信
     * @param $code
     */
    public function send($order_id)
    {
        //根据订单查询活动
      $data  =   Order::findOne(['id' => $order_id]);
      $name =$data->sms_title;
     return  $this->SendSms($data->phone,$name,'','SMS_95475065');
    }
    
    
    /**
     * 订单支付成发送短信
     * @param $order
     */
    public function paySuccessSms($order){
       $this->SendMessage($order->phone,$order->sms_title,$order->order_number,'SMS_98235004');
       
    }
    
    /**
     *   发送支付后的短信
     */
    public function SendMessage($phone, $name, $content,$template){
       
        // 配置信息
        $config = [
            'app_key'    => '24558166',
            'app_secret' => '412f0a3698777944957ee48b96dc2863',
            //'sandbox'    => true,  // 是否为沙箱环境，默认false
        ];
        // 使用方法一
        $client = new Client(new App($config));
        $req    = new AlibabaAliqinFcSmsNumSend();
        $req->setRecNum($phone)
            ->setSmsParam([
                'name' => $name,
                'content' => $content,
            ])
            ->setSmsFreeSignName('豆芽集市')
            ->setSmsTemplateCode('SMS_98235004');
        $resp = $client->execute($req);
        return $resp->result->success;
    }
}
