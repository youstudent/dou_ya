<?php
/**
 * Created by PhpStorm.
 * User: gba12
 * Date: 2017/9/11
 * Time: 17:14
 */

namespace  frontend\models;


use common\models\Member;

class GetUserInfo
{
    
    /**
     * 获取session存的用户信息
     * @return int
     */
   public static function GetUserId()
   {
       //TODO:  从session获取用户ID
       $member =  \Yii::$app->session->get('member');
       return $member['id'];
      // return 1;
   }
   
   public static function check(){
       $member = \Yii::$app->session->get('member');
       if (Member::findOne(['id'=>$member['id']])->status !==1){
           return false;
       }
       return true;
   }
}