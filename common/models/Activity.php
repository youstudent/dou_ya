<?php

namespace common\models;

use backend\components\ImgUrl;
use frontend\models\GetUserInfo;
use PHPUnit\Framework\Constraint\IsFalse;
use Symfony\Component\Debug\Tests\Fixtures\ClassAlias;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%activity}}".
 *
 * @property string $id
 * @property string $merchant_name
 * @property string $activity_name
 * @property string $activity_img
 * @property string $activity_address
 * @property integer $apply_end_time
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $phone
 * @property string $linkman
 * @property integer $purchase_limitation
 * @property integer $on_line
 * @property string $content
 * @property integer $created_at
 */
class Activity extends \yii\db\ActiveRecord
{
    public static $num=[0=>'无限制',1=>'有限制'];
    public $file;
    public $limitation_num;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%activity}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['merchant_name'],'validateName','skipOnEmpty' => false,'skipOnError' => false],
            [['activity_address','activity_name','merchant_name','apply_end_time','start_time','end_time','phone','on_line','linkman','content','limitation_num'], 'required'],
            [['phone', 'purchase_limitation','on_line','merchant_id'], 'integer'],
            [['content'], 'string'],
            [['merchant_name'], 'string', 'max' => 30],
            [['activity_name', 'linkman'], 'string', 'max' => 50],
            [['activity_address','activity_img'], 'string', 'max' => 100],
            [['allpage_view'],'safe'],
            [['file'], 'file','extensions' => 'png,jpg'],
            [['apply_end_time','start_time','end_time'],'time'],
            [['limitation_num'],'validateLimit']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'merchant_name' => '商家名',
            'activity_name' => '活动名字',
            'activity_img' => '活动封面',
            'activity_address' => '活动地址',
            'apply_end_time' => '报名截止时间',
            'start_time' => '活动开始时间',
            'end_time' => '活动结束时间',
            'phone' => '电话',
            'linkman' => '联系人',
            'purchase_limitation' => '单人限购量',
            'limitation_num' => '单人限购类型',
            'on_line' => '总参与上限',
            'content' => '内容',
            'created_at' => '创建时间',
            'file' => '封面上传',
            'total_clearing' => '总结算',
            'total_price' => '总售价',
            'status' => '状态',
            'merchant_id' => '商家ID',
        ];
    }
    
    
    /**
     * 验证限制人数
     * @param $attribute
     * @param $params
     */
    public function validateLimit($attribute,$params){
        if ($this->limitation_num ==1) {
            if (empty($this->purchase_limitation)){
                $this->addError('purchase_limitation','有限必须选择限制人数');
            }
        }
        
    }
    
    //验证商家名字
    public function validateName($attribute,$params){
        $row = Merchant::findOne(['name'=>$this->merchant_name]);
        if ($row){
            $this->merchant_id=$row->id;
        }else{
            $this->addError('merchant_name','商家名字不存在');
        }
        
    }
    
    //验证商家名字
    public function time($attribute,$params){
        if (($this->apply_end_time>$this->start_time) || ($this->apply_end_time>=$this->end_time) || $this->start_time>$this->end_time ){
            $this->addError('end_time','截止时间>开始时间>结束时间');
        }
        
    }
    
    /**
     * 验证日期
     * @param $attribute
     * @param $params
     */
    public function validateAfterNow($attribute, $params)
    {
        if(strtotime($this->apply_end_time) < time()) {
            $this->addError($attribute, '请选择正确的日期.');
        }
    }
    
    /**
     * 添加活动和票种
     * @return bool
     */
    public function add($data)
    {
        if ($this->validate()) {
            if (($this->apply_end_time>$this->start_time) || ($this->apply_end_time>=$this->end_time) || $this->start_time>$this->end_time ){
                return $this->addError('end_time','截止时间>开始时间>结束时间');
            }
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($this->file) {
                    $activityUrl = '/upload/activity/';
                    $Url = ImgUrl::Url($activityUrl);
                    $pre = rand(999, 9999) . time() . '.' . $this->file->extension;
                    if ($this->file->saveAs($Url.$pre) == false) throw new Exception('上传图片失败');
                    $this->activity_img = $activityUrl.$pre;
                }
                $this->apply_end_time = strtotime($this->apply_end_time);
                $this->start_time = strtotime($this->start_time);
                $this->end_time = strtotime($this->end_time);
                $this->total_price = 0;  //总售价
                $this->total_clearing = 0; //总结算价
                $this->created_at = time();
                if ($this->limitation_num==0){
                    $this->purchase_limitation='';
                }
                $this->status = 1;
                if ($this->save(false) == false) throw new Exception('保存活动失败');
                //添加活动数据
                $ActivityData = new ActivityData();
                $ActivityData->merchant_name = $this->merchant_name;
                $ActivityData->activity_name = $this->activity_name;
                $ActivityData->activity_id = $this->id;
                if ($ActivityData->save() ==false) throw new Exception('保存活动数据失败');
                $row = [];
                foreach ($data['title'] as $k => $v) {
                    $row[] = [
                        'title' => $v,
                        'price' => $data['price'][$k],
                        'settlement' => $data['settlement'][$k],
                    ];
                }
                foreach ($row as $value) {
                    $model = new  ActivityTicket();
                    $model->title = $value['title'];
                    $model->activity_id = $this->id;
                    $model->price = $value['price'];
                    if (!empty($value['title']) && !empty($value['price']) && !empty($value['settlement'])){
                        $model->return = (int)round(($value['price']-$value['settlement'])/$value['price']*100, 1);
                    }
                    $model->settlement = $value['settlement'];
                    if ($model->save(false) == false) throw new Exception('添加票种失败');
                }
                ActivityTicket::deleteAll(['return'=>000]);
                if(\common\components\Count::create(1,2)==false) throw new Exception('统计活动数据失败');
                $transaction->commit();
                return true;
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
            
        }
        
    }
    
    
    /**
     * 修改活动
     * @return bool
     */
    public function edit($data){
        if ($this->validate()){
            if (($this->apply_end_time>$this->start_time) || ($this->apply_end_time>=$this->end_time) || $this->start_time>$this->end_time ){
              return  $this->addError('end_time','截止时间>开始时间>结束时间');
            }
            $row = [];
            foreach ($data['title'] as $k => $v) {
                $row[] = [
                    'title' => $v,
                    'price' => $data['price'][$k],
                    'settlement' => $data['settlement'][$k],
                ];
            }
            foreach ($row as $value) {
                if (empty($value['title']) || empty($value['price'])|| empty($value['settlement'])){
                   return false;
                }
            }
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($this->file) {
                    $activityUrl = '/upload/activity/';
                    $Url = ImgUrl::Url($activityUrl);
                    $pre = rand(999, 9999) . time() . '.' . $this->file->extension;
                    if ($this->file->saveAs($Url.$pre) == false) throw new Exception('上传图片失败');
                    $this->activity_img = $activityUrl.$pre;
                }
                $this->apply_end_time = strtotime($this->apply_end_time);
                $this->end_time = strtotime($this->end_time);
                $this->start_time=strtotime($this->start_time);
                if ($this->limitation_num==0){
                    $this->purchase_limitation='';
                }
                $this->status = 1;
                if ($this->save(false) == false) throw new Exception('保存活动失败');
                $row = [];
                $activity = ActivityData::findOne(['activity_id'=>$this->id]);
                $activity->activity_name =$this->activity_name;
                $activity->merchant_name = $this->merchant_name;
                if ($this->save(false) ==false) throw new Exception('修改活动数据失败');
                foreach ($data['title'] as $k => $v) {
                    $row[] = [
                        'title' => $v,
                        'price' => $data['price'][$k],
                        'settlement' => $data['settlement'][$k],
                    ];
                }
                /**
                 *  删除该活动之前添加的票种,按修改的票种为准
                 */
                ActivityTicket::deleteAll(['activity_id'=>$this->id]);
                foreach ($row as $value) {
                    $model = new  ActivityTicket();
                    $model->title = $value['title'];
                    $model->activity_id = $this->id;
                    $model->price = $value['price'];
                    if (!empty($value['title']) && !empty($value['price']) && !empty($value['settlement'])){
                        $model->return = (int)round(($value['price']-$value['settlement'])/$value['price']*100, 1);
                    }
                    //$model->return = (int)round(($value['price']-$value['settlement'])/$value['price']*100, 1);
                    $model->settlement = $value['settlement'];
                    if ($model->save(false) == false) throw new Exception('添加票种失败');
                }
                ActivityTicket::deleteAll(['return'=>000]);
                $transaction->commit();
                return true;
            } catch (\Exception $e) {
                $transaction->rollBack();
            }
        }
    }
    
    /**
     * 处理活动
     * @param $data
     * @return mixed
     */
    public static function formatting($data){
        foreach ($data as $key => &$value) {
            $value['apply_end_time'] = date('m月d日', $value['apply_end_time']);
            $value['start_time'] = date('m月d日', $value['start_time']);
            $value['end_time'] = date('m月d日', $value['end_time']);
            if ($value['activity_img']){
                $value['activity_img'] = \Yii::$app->params['imgs'] . $value['activity_img'];
            }
            //$value['activity_img'] = \Yii::$app->params['img_domain'] . $value['activity_img'];
            //查询票种
            $value['price'] = '0';
            if ($row = ActivityTicket::find()->select('price')->where(['activity_id' => $value['id']])->orderBy('price ASC')->one()) {
                $value['price'] = $row->price;
            }
        }
        return $data;
    }
    
    /**
     * 处理活动详情
     * @param $data
     * @return mixed
     */
    public static function details($data){
            $data['start_time'] = date('Y年m月d日 H:i:s', $data['start_time']);
            $data['apply_end_time'] = date('Y年m月d日 H:i:s', $data['apply_end_time']);
            $data['end_time'] = date('Y年m月d日 H:i:s', $data['end_time']);
            $data['activity_img'] = \Yii::$app->params['imgs'] . $data['activity_img'];
            //查询票种
            $data['price'] = '0';
            if ($row = ActivityTicket::find()->select('price')->where(['activity_id' => $data['id']])->orderBy('price ASC')->one()) {
                $data['price'] = $row->price;
            }
        return $data;
        
    }
    
    public function getMyactivity(){
    
      return $this->hasMany(CollectActivity::className(),['activity_id'=>'id']);
    
    }
    
    /**
     * 参加活动前检查该用户是否超过活动限购数
     * @param $activity_id
     * @return bool
     */
    public function checkNum($activity_id)
    {
        $member_id = GetUserInfo::GetUserId();
        
        $data = Order::find()->where(['activity_id' => $activity_id, 'user_id' => $member_id])->asArray()->all();
        if (!$data) {
            return true;
        }
        $num = 0;
        foreach ($data as $key => $value) {
            $num += OrderTicket::find()->where(['order_id' => $value['id']])->count();
        }
        $activity = Activity::findOne(['id' => $activity_id]);
        if ($num >= $activity->purchase_limitation) {
            return false;
        }
        return true;
        
    }
    
    
    /**
     * 用户参加活动前未超过限制,但进入下单选择数量后检查是否超过限制
     * @param $data
     * @return bool
     */
    public function checkOrderNum($data)
    {
        // 获取用户信息
        $member_id = GetUserInfo::GetUserId();
        //循环用户提交,票种的总数量
        $nums = 0;
        foreach ($data['ticket'] as $key => $value) {
            $nums += $value['num'];
        }
        //用户下单检查是否可以进行下单
        $activity = Activity::findOne(['id' => $data['activity_id']]);
        if ($nums > $activity->purchase_limitation) {
            return false;
        }
        // 查询该用户操作活动的订单,订单不存在说明该用户没有下过单
        $order = Order::find()->where(['activity_id' => $data['activity_id'], 'user_id' => $member_id])->asArray()->all();
        if (!$order) {
            return true;
        }
        // 循环查找每个订单的票种数量,加起来就是该用户该活动的总票种数
        $num = 0;
        foreach ($order as $key => $value) {
            $num += OrderTicket::find()->where(['order_id' => $value['id']])->count();
        }
        // 用户可以进行下单,加上即将要下单的数量,是否大于限制数据
        if ($num + $nums > $activity->purchase_limitation) {
            return false;
        }
        return true;
    }
    
    /**
     * 更新 活动的数据
     * @param $order
     */
    public function updated($order){
        $activity_id = $order['activity_id'];
        $data = self::findOne(['id'=>$activity_id]);
        if ($data){
            $data->total_clearing=$data->total_clearing+$order['sell_all'];
            $data->total_price=$data->total_price+$order['clearing_all'];
        }
        //更新用户的数据
        $member =  Member::findOne(['id'=>$order['user_id']]);
        $member->order_num = $member->order_num+1;
        $member->order_money = $member->order_money+$order['sell_all'];
        $member->save(false);
        //更新统计表订单的数量
        \common\components\Count::create(1,1); //订单的数量
        //更新统计表流水的数据(已支付|总售卖额)
        \common\components\Count::create($order['sell_all'],3);
        //更新统计表流水的数据(已支付|结算总额)
        \common\components\Count::create($order['clearing_all'],4);
    
        //更新统计表流水的数据(已支付|利润)
        $row  = $order['sell_all']-$order['clearing_all'];
        \common\components\Count::create($row,5);
    }
    
    /**
     * 查询票数量是否 在上线
     * @param $data
     * @return bool]
     */
    public function check($data){
        $activity = Activity::findOne(['id'=>$data['activity_id']]);
        //找出所有的订单号
        $order = Order::find()->select('id')->andWhere(['activity_id'=>$activity->id])->asArray()->all();
        $ids = ArrayHelper::map($order,'id','id');
        $num = OrderTicket::find()->where(['order_id'=>$ids,'status'=>[0,1,10]])->count();
        if ($activity){
            if ($num>=$activity->on_line){
               return false;
            }
        }
        return true;
      
    }
    
}
