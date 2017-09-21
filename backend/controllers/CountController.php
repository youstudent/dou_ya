<?php
/**
 * Created by PhpStorm.
 * User: gba12
 * Date: 2017/9/5
 * Time: 11:48
 */

namespace backend\controllers;



use backend\models\search\CountSearch;
use common\models\Count;
use yii\web\Controller;

class CountController extends Controller
{
    public function actionIndex(){
        //统计所有数据
        $model = new Count();
        $row = $model->count();
        //统计区间数据
        $search = new CountSearch();
        $rows = $search->search();
        return $this->render('index2',['search'=>$search,'row'=>$row,'rows'=>$rows]);
    }
    
}