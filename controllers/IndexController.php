<?php

namespace app\controllers;

use app\models\Product;

class IndexController extends CommonController
{
    public function actionIndex()
    {
        $this->layout = 'layout1';
        $where = "ison = '1'";
        $model = Product::find()->where($where);
        $all = $model->asArray()->limit(4)->all();
        $new = $model->asArray()->orderby('createtime desc')->limit(4)->all();
        $sale = $model->Where($where . ' and issale = \'1\'')->orderby('createtime desc')->limit(4)->asArray()->all();
        $tui = $model->Where($where . ' and istui = \'1\'')->orderby('createtime desc')->limit(15)->asArray()->all();
        $hot = $model->Where($where . ' and ishot = \'1\'')->orderby('createtime desc')->limit(6)->asArray()->all();
        return $this->render('index', [
            'all' => $all,
            'new' => $new,
            'tui' => $tui,
            'hot' => $hot,
            'sale' => $sale,
        ]);
    }

}
