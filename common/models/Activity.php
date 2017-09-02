<?php

namespace common\models;

use PHPUnit\Framework\Constraint\IsFalse;
use Yii;

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
            [['activity_address','activity_name','merchant_name','apply_end_time','start_time','end_time','purchase_limitation','phone','on_line','linkman','content'], 'required'],
            [['phone', 'purchase_limitation','on_line',], 'integer'],
            [['content'], 'string'],
            [['merchant_name'], 'string', 'max' => 30],
            [['activity_name', 'linkman'], 'string', 'max' => 20],
            [['activity_address','activity_img'], 'string', 'max' => 100],
            [['file'], 'file','extensions' => 'png,jpg'],
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
            'on_line' => '总参与上限',
            'content' => '内容',
            'created_at' => '创建时间',
            'file' => '封面上传',
            'total_clearing' => '总结算',
            'total_price' => '总售价',
            'status' => '状态',
        ];
    }
    
    public function validateAfterNow($attribute, $params)
    {
        if(strtotime($this->apply_end_time) < time()) {
            $this->addError($attribute, '请选择正确的日期.');
        }
    }
    
    /**
     * 添加活动
     * @return bool
     */
    public function add(){
       if ($this->validate()){
           if ($this->file){
               $pre = 'uploads/activity/'.rand(999,9999).time().'.'.$this->file->extension;
               if ($this->file->saveAs($pre)){
                   $this->activity_img= $pre;
               }
           }
           /**
            * 格式化时间保存
            */
           $this->apply_end_time=strtotime($this->apply_end_time);
           $this->start_time=strtotime($this->start_time);
           $this->end_time=strtotime($this->end_time);
           $this->created_at=time();
           $this->status=1;
           return  $this->save(false)?$this->id:false;
       }
        
    }
    
    
    /**
     * 修改活动
     * @return bool
     */
    public function edit(){
        if ($this->validate()){
            if ($this->file){
                $pre = 'uploads/activity/'.rand(999,9999).time().'.'.$this->file->extension;
                if ($this->file->saveAs($pre)){
                    $this->activity_img= $pre;
                }
            }
            //格式化时间
            $this->apply_end_time=strtotime($this->apply_end_time);
            $this->start_time=strtotime($this->start_time);
            $this->end_time=strtotime($this->end_time);
            return  $this->save(false);
        }
    }
    
    /**
     * 处理
     * @param $data
     * @return mixed
     */
    public static function formatting($data){
        foreach ($data as $key => &$value) {
            $value['start_time'] = date('m月d日', $value['start_time']);
            $value['end_time'] = date('m月d日', $value['end_time']);
            $value['activity_img'] = \Yii::$app->params['img_domain'] . $value['activity_img'];
            //查询票种
            $value['price'] = '未票价';
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
        foreach ($data as $key => &$value) {
            $value['start_time'] = date('Y年m月d日 H', $value['start_time']);
            $value['end_time'] = date('Y年m月d日 H', $value['end_time']);
            $value['activity_img'] = \Yii::$app->params['img_domain'] . $value['activity_img'];
            //查询票种
            $value['price'] = '未票价';
            if ($row = ActivityTicket::find()->select('price')->where(['activity_id' => $value['id']])->orderBy('price ASC')->one()) {
                $value['price'] = $row->price;
            }
        }
        return $data;
        
    }
}
