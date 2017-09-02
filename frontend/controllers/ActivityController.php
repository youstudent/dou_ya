<?php

namespace frontend\controllers;

use common\models\Activity;
use common\models\ActivityTicket;
use function GuzzleHttp\Psr7\str;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use PHPUnit\Framework\Constraint\IsFalse;

class ActivityController extends ObjectController
{
    /**
     * 活动列表(最新|最热)
     * @return string
     */
    public function actionNewesIndex()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $orderBy = \Yii::$app->request->post('type');
        if (!$orderBy) {
            return $this->returnAjax(0, '必须传参数!!type:created_at最新,type:allpage_view最热');
        }
        $select = ['id', 'merchant_name', 'activity_name',
                  'activity_img', 'start_time', 'end_time',
                  'collect_number', 'allpage_view'];
        $data = Activity::find()->select($select)->orderBy("$orderBy DESC")->asArray()->all();
        if ($data) {
            $result = Activity::formatting($data);
            return $this->returnAjax(1, '成功', $result);
        }
        return $this->returnAjax(0, '暂未活动');
    }
    
    /**
     * 搜索活动名,或者商家名
     * @return mixed
     */
    public function actionSearch()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $keyword = \Yii::$app->request->post('search');
        if (!$keyword) {
            return $this->returnAjax(0, '请传参数!!search:商家名或者活动名');
        }
        $select = ['id', 'merchant_name', 'activity_name',
                  'activity_img', 'start_time', 'end_time',
                  'collect_number', 'allpage_view'];
        $data = Activity::find()->select($select)->where(['or', ['like', 'merchant_name', $keyword], ['like', 'activity_name', $keyword]])->asArray()->all();
        if ($data) {
            $result = Activity::formatting($data);
            return $this->returnAjax(1, '成功', $result);
        }
        return $this->returnAjax(0, '未搜索到');
    }
    
    /**
     * 活动详情
     * @return string
     */
    public function actionDetails()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $id = \Yii::$app->request->post('id');
        if (!$id) {
            return $this->returnAjax(0, '请传ID参数');
        }
        $data = Activity::find()->where(['id' => $id])->asArray()->one();
        if ($data) {
            $result = Activity::details($data);
            return $this->returnAjax(1, '成功', $result);
        }
        return $this->returnAjax(0, '未找到活动详情ID为' . $id);
    }
    
    
    /**
     *  更新活动浏览量
     * @return mixed
     */
    public function actionAllpageView()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $id = \Yii::$app->request->post('id');
        if (!$id) {
            return $this->returnAjax(0, '请传ID参数');
        }
        if ($result = Activity::findOne(['id' => $id])) {
            $result->allpage_view = $result->allpage_view + 1;
            return $result->save(false) ? $this->returnAjax(1, '成功') : $this->returnAjax(0, '增加浏览量失败ID为' . $id);
        }
        
        return $this->returnAjax(0, '未查询活动数据ID'.$id);
    }
    
    
    public function actionCollect(){
    
    
    }
    
}
