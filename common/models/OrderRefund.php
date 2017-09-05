<?php

namespace common\models;

use Yii;
use yii\db\Exception;

/**
 * This is the model class for table "{{%order_refund}}".
 *
 * @property string $id
 * @property integer $order_id
 * @property integer $money
 * @property string $pass_reason
 * @property string $no_reason
 * @property string $bank_card
 * @property string $opening_bank
 * @property string $opening_man
 * @property integer $created_at
 * @property integer $updated_at
 */
class OrderRefund extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_refund}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id','money','pass_reason','bank_card','opening_bank','opening_man','no_reason'],'required'],
            [['order_id', 'money', 'created_at', 'updated_at'], 'integer'],
            [['pass_reason', 'no_reason'], 'string', 'max' => 255],
            [['bank_card', 'opening_bank', 'opening_man'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' =>'订单号',
            'money' => '退款金额',
            'pass_reason' => '退款原因',
            'no_reason' => '拒绝原因',
            'bank_card' => '银行卡号',
            'opening_bank' => '开户行',
            'opening_man' => '开户人',
            'created_at' => '申请时间',
            'updated_at' => '处理时间',
        ];
    }
    
    /**
     *  拒绝账号通过
     * @param $data
     * @return bool
     * @throws \Exception
     */
    public function UnPass($data){
        if ($this->load($data) && $this->validate()){
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $this->updated_at=time();
                if ($this->save()==false) throw new Exception('拒绝原因保存失败');
                $order = Order::findOne(['id'=>$this->order_id]);
                $order->status = 4;
                if ($order->save(false)== false) throw new Exception('订单状态变更失败');
                $transaction->commit();
                return true;
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
            
        }
        
    }
    
    /**
     * 获取订单的退款时间
     * @param $id
     * @return false|string
     */
    public static function getCreated_at($id){
        $data = OrderRefund::findOne(['order_id'=>$id]);
        if ($data){
            return date('Y-m-d H:i:s',$data->created_at);
        }
            return '数据异常';
        
        
    }
}
