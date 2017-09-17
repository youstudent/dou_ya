<?php

namespace common\models;

use backend\components\ImgUrl;
use rmrevin\yii\fontawesome\FA;
use spec\Prophecy\Doubler\ClassPatch\ReflectionClassNewInstancePatchSpec;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%banner}}".
 *
 * @property string $id
 * @property string $title
 */
class Banner extends \yii\db\ActiveRecord
{
    public $banner;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%banner}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'],'required'],
            [['title'], 'string', 'max' => 20],
            [['banner'], 'file','extensions' => 'png,jpg', 'maxFiles' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'banner' => '图片',
        ];
    }
    
    /**
     * 图片上传
     * @return bool
     */
    public function upload()
    {
        if ($this->validate()) {
            $this->created_at = time();
            if ($this->save()){
                if ($this->banner){
                    // 上传图片路径并创建文件目录
                    $bannerUrl = '/upload/banner/';
                    $directory  = ImgUrl::Url($bannerUrl);
                    foreach ($this->banner as $file) {
                        $img = new BannerImg();
                        $pre = rand(999,9999).time().'.'.$file->extension;
                        $file->saveAs($directory.$pre);
                        $img->banner_id=$this->id;
                        $img->img= $bannerUrl.$pre;
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
     * 图片修改
     * @return bool
     */
    public function uploads()
    {
        if ($this->validate()) {
            //查询图片张数
            
            if ($this->save()){
                if ($this->banner){
                    $num = count($this->banner);
                    if (BannerImg::find()->where(['banner_id'=>$this->id])->count()+$num >4){
                        $this->addError('banner','已经有四张图片,请删除在上传');
                        return false;
                    }
                    // 上传图片路径并创建文件目录
                    $bannerUrl = '/upload/banner/';
                    $directory  = ImgUrl::Url($bannerUrl);
                    foreach ($this->banner as $file) {
                        $img = new BannerImg();
                        $pre = rand(999,9999).time().'.'.$file->extension;
                        $file->saveAs($directory.$pre);
                        $img->banner_id=$this->id;
                        $img->img=$bannerUrl.$pre;
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
     * 和图片建立一对一关系
     * @return \yii\db\ActiveQuery
     */
    public function getImg(){
        
        return $this->hasMany(BannerImg::className(),['banner_id'=>'id']);
    }
}
