<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%cdc_service}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $principal
 * @property string $contact_phone
 * @property string $introduction
 * @property string $address
 * @property string $lat
 * @property string $lng
 * @property integer $level
 * @property integer $status
 * @property integer $open_at
 * @property integer $close_at
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 * @property integer $pid
 * @property integer $state
 * @property string $principal_phone
 * @property integer $type
 * @property integer $sid
 * @property integer $owner_id
 * @property string $owner_username
 */
class CdcService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cdc_service}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'principal', 'contact_phone', 'owner_id'], 'required'],
            [['introduction'], 'string'],
            [['level', 'status', 'open_at', 'close_at', 'created_at', 'updated_at', 'deleted_at', 'pid', 'state', 'type', 'sid', 'owner_id'], 'integer'],
            [['name', 'principal', 'contact_phone', 'address', 'lat', 'lng', 'principal_phone'], 'string', 'max' => 256],
            [['owner_username'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '服务商名称'),
            'principal' => Yii::t('app', '负责人'),
            'contact_phone' => Yii::t('app', '客服电话'),
            'introduction' => Yii::t('app', '简介'),
            'address' => Yii::t('app', '地址'),
            'lat' => Yii::t('app', '纬度'),
            'lng' => Yii::t('app', '经度'),
            'level' => Yii::t('app', '星级'),
            'status' => Yii::t('app', '0禁用;1启用'),
            'open_at' => Yii::t('app', '开业时间'),
            'close_at' => Yii::t('app', '停业时间'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '更新时间'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'pid' => Yii::t('app', '上级账户id'),
            'state' => Yii::t('app', '是否营业 1营业 0不营业'),
            'principal_phone' => Yii::t('app', '负责人电话'),
            'type' => Yii::t('app', '1服务商 2代理商'),
            'sid' => Yii::t('app', '平台销售经理id'),
            'owner_id' => Yii::t('app', '冗余adminuser id字段'),
            'owner_username' => Yii::t('app', '冗余adminuser 的用户名字段'),
        ];
    }
}
