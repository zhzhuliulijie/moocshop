<?php

namespace app\modules\controllers;

use app\models\Order;
use yii\data\Pagination;
use Yii;

class OrderController extends CommonController
{
    public function actionList()
    {
        $this->layout = 'layout';
        $model = Order::find();
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['order'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $data = $model->offset($pager->offset)
            ->limit($pager->limit)
            ->all();
        $zhstatus = Order::$status;
        return $this->render('list', ['pager' => $pager, 'orders' => $data, 'zhstatus'=>$zhstatus]);
    }

    public function actionDetail()
    {
        $this->layout = 'layout';
        $orderid = Yii::$app->request->get('orderid');
        if (empty($orderid)){
            return $this->redirect(['list']);
        }
        $order = Order::find()
            ->where('shop_order.orderid = :oid', [':oid'=> $orderid])
            ->joinWith('product')
            ->joinWith('addr')
            ->joinWith('user')
            ->one();
        $zhstatus = Order::$status;
        return $this->render('detail', ['order' => $order, 'zhstatus' => $zhstatus]);
    }

    public function actionSend()
    {
        $this->layout = 'layout';
        $orderid = Yii::$app->request->get('orderid');
        $model = Order::find()->where('orderid = :oid', [':oid'=>$orderid])->one();
        $model->scenario= 'send';
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $model->status = Order::SENDED;
//            $post['Order']['status'] = Order::SENDED;
//            var_dump($post); exit;
            if ($model->load($post) && $model->save()){
                Yii::$app->session->setFlash('info', '发货成功');
            }
        }
        return $this->render('send', ['model' => $model]);
    }

}
