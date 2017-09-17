<?php
/**
 * Created by PhpStorm.
 * User: gba12
 * Date: 2017/9/11
 * Time: 14:52
 */

namespace frontend\controllers;


use backend\models\Search\Merchant;
use common\models\Activity;
use common\models\CollectMerchant;
use frontend\models\GetUserInfo;
use Monolog\Handler\GelfHandler;
use yii\web\Controller;

class MerchantController extends ObjectController
{
    /**
     * 查询商家正在进行的活动和历史活动
     * @return mixed
     */
    public function actionMerchantActivity()
    {
        
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $merchant_id = \Yii::$app->request->post('merchant_id');
        $type = \Yii::$app->request->post('type');
        if (!$type || !$merchant_id) {
            return $this->returnAjax(0, '请输入商家ID和type');
        }

        //分页信息one
        $pageSize = \Yii::$app->request->post('page');
        if (!isset($pageSize) || empty($pageSize)) {
            $page = 1;
        } else {
            $page = $pageSize;
        }
        //TODO::要改的size
        $size = \Yii::$app->params['size'];
        $limit = ($page-1) * $size;

        if ($type == 1) {
            $row = Activity::find()->andWhere(['>', 'end_time', time()])->andWhere(['merchant_id' => $merchant_id, 'status' => 1])
                ->asArray()
                ->limit($size)
                ->offset($limit)
                ->all();
            $count = Activity::find()->andWhere(['>', 'end_time', time()])->andWhere(['merchant_id' => $merchant_id, 'status' => 1])->count();
        } else {
            $row = Activity::find()->andWhere(['<', 'end_time', time()])->andWhere(['merchant_id' => $merchant_id])->orWhere(['or', ['status' => 0]])
                ->asArray()
                ->limit($size)
                ->offset($limit)
                ->all();
            $count = Activity::find()->andWhere(['<', 'end_time', time()])->andWhere(['merchant_id' => $merchant_id])->orWhere(['or', ['status' => 0]])->count();
        }

        // 分页信息two
        $totalPage = ceil($count / $size);
        $nowPage = $page;
        $pageInfo = ['totalPage'=>$totalPage, 'nowPage'=>$nowPage];

        if ($row) {
            $result = Activity::formatting($row);
            $datas['data']=$result;
            $datas['pageInfo'] = $pageInfo;
            return $this->returnAjax(1, '成功', $datas);
        }
        return $this->returnAjax(0, '没有查询到商家活动数据');
    }
    
    /**
     * 商家   头像,商家名,该商家是否被该用户收藏
     * @return mixed
     */
    public function actionMerchantDateil()
    {
        $user_id = GetUserInfo::GetUserId();
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $merchant_id = \Yii::$app->request->post('merchant_id');
        $data = Merchant::find()->select('name,logo')->andWhere(['id' => $merchant_id])->asArray()->one();
        if (!$data) {
            return $this->returnAjax(0, '未查询到数据');
        }
        $data['logo'] = \Yii::$app->params['img_domain'] . $data['logo'];
        $data['collect_merchant'] = CollectMerchant::find()->where(['user_id' =>$user_id, 'merchant_id' => $merchant_id])->exists();
        
        return $this->returnAjax(1, '成功', $data);
        
    }
    
}