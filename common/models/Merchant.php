<?php

namespace common\models;

use backend\components\ImgUrl;
use backend\models\Salesman;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%merchant}}".
 *
 * @property string $id
 * @property string $name
 * @property string $phone
 * @property string $address
 * @property string $seleaman
 * @property integer $created_at
 * @property string $logo
 * @property string $merchant_label
 * @property string $linkman
 * @property string $contract_number
 */
class Merchant extends \yii\db\ActiveRecord
{
    public $file;
    public $imgs;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%merchant}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','phone','address','merchant_label','linkman','contract_number'],'required'],
            [['phone'],'match','pattern'=>'/^((13[0-9])|(15[^4])|(18[0,2,3,5-9])|(17[0-8])|(147))\\d{8}$/'],
            [['created_at'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['phone'], 'string', 'max' => 11],
            [['address', 'logo', 'merchant_label'], 'string', 'max' => 255],
            [['seleaman', 'linkman'], 'string', 'max' => 20],
            [['contract_number'], 'string', 'max' => 50],
            [['file'], 'file','extensions' => 'png,jpg', 'maxFiles' => 1],
            [['imgs'], 'file','extensions' => 'png,jpg', 'maxFiles' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商家名字',
            'phone' => '电话',
            'address' => '地址',
            'seleaman' => '业务员',
            'created_at' => 'Created At',
            'logo' => '封面',
            'merchant_label' => '标签',
            'linkman' => '联系人',
            'contract_number' => '合同号',
            'file' => '封面',
            'imgs' => '合同图片上传',
        ];
    }
    
    /**
     * 获取业务员
     * @return array
     */
    public static function getSalesman(){
        $data  = Salesman::find()->all();
        return ArrayHelper::map($data,'name','name');
    }
    
    
    /**
     * 图片上传
     * @return bool
     */
    public function upload()
    {
        if ($this->validate()) {
            $this->created_at = time();
            //上传封面
            if ($this->file){
                $activityUrl = '/upload/merchant/';
                $Url = ImgUrl::Url($activityUrl);
                $pre = rand(999,9999).time().'.'.$this->file->extension;
                if ($this->file->saveAs($Url.$pre)){
                    $this->logo=$activityUrl.$pre;
                }
            }
            if ($this->save(false)){
                //上传合同图片
                if ($this->imgs){
                    foreach ($this->imgs as $file) {
                        $activityUrl = '/upload/merchant/';
                        $Url = ImgUrl::Url($activityUrl);
                        $pre = rand(999,9999).time().'.'.$file->extension;
                        $img = new MerchantImg();
                        $file->saveAs($Url.$pre);
                        $img->merchant_id=$this->id;
                        $img->img=$activityUrl.$pre;
                        $img->save();
                    }
                }
            }
    
            $data = Salesman::findOne(['name'=>$this->seleaman]);
            $data->bound_merchant=$data->bound_merchant+1;
            $data->save(false);
            if(\common\components\Count::create(1,7)==false) throw new Exception('统计活动数据失败');
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 获取合同图片
     * @return \yii\db\ActiveQuery
     */
    public function getImg(){
        return $this->hasMany(MerchantImg::className(),['merchant_id'=>'id']);
    }
    
    /**
     * 查询商家正在进行的活动
     * @param $id
     * @return int|string
     */
    public static function  getInActivity($id){
       return Activity::find()->where(['merchant_id'=>$id,'status'=>1])->andWhere(['and',['<','start_time',time()],['>','end_time',time()]])->count();
    }
    
    
    /**
     * 获取商家历史活动
     * @param $id
     * @return int|string
     */
    public static function  getHistoryActivity($id){
        return Activity::find()->where(['merchant_id'=>$id])->andWhere(['<','end_time',time()])->count();
    }
}
