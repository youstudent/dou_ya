<?php

namespace common\models;

use backend\models\Salesman;
use Yii;
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
            [['name','phone','address','merchant_label','linkman','contract_number'], 'required'],
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
            'name' => '商家名',
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
                $pre = 'uploads/merchant/'.rand(999,9999).time().'.'.$this->file->extension;
                if ($this->file->saveAs($pre)){
                    $this->logo=$pre;
                }
            }
            if ($this->save(false)){
                //上传合同图片
                if ($this->imgs){
                    foreach ($this->imgs as $file) {
                        $img = new MerchantImg();
                        $pre = 'uploads/merchant/'.rand(999,9999).time().'.'.$file->extension;
                        $file->saveAs($pre);
                        $img->merchant_id=$this->id;
                        $img->img=$pre;
                        $img->save();
                    }
                }
            }
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
}
