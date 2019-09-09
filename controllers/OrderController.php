<?php

namespace app\controllers;

use app\models\Address;
use app\models\Cart;
use app\models\Order;
use app\models\OrderDetail;
use app\models\Pay;
use app\models\Product;
use app\models\User;
use dzer\express\Express;
use Yii;
use yii\data\Pagination;

class OrderController extends CommonController
{
    public function actionIndex()
    {
        $this->layout = 'layout2';
        if (Yii::$app->session['isLogin'] != 1) {
            return $this->redirect(['member/auth']);
        }
        $loginname = Yii::$app->session['loginname'];
        $userid = User::find()->where('username = :name or useremail = :email', [':name' => $loginname, ':email' => $loginname])->one()->userid;
        $model = Order::find()
            ->where('shop_order.userid = :uid', [':uid' => $userid])
            ->joinWith('product')
            ->joinWith('addr');
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['order'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $orders = $model->offset($pager->offset)
            ->limit($pager->limit)
            ->asArray()
            ->all();
        $zhstatus = Order::$status;
        return $this->render('index', [
            'pager' => $pager,
            'orders' => $orders,
            'zhstatus' => $zhstatus,
        ]);
    }

    public function actionCheck()
    {
        if (Yii::$app->session['isLogin'] != 1) {
            return $this->redirect(['member/auth']);
        }
        $this->layout = 'layout1';
        $orderid = Yii::$app->request->get('orderid');
        $status = Order::find()->where('orderid = :oid', [':oid' => $orderid])->one()->status;
        if ($status != Order::CREATEORDER && $status != Order::CHECKORDER) {
            return $this->redirect(['index']);
        }
        if (empty($orderid)) {
            return false;
        }
        $loginname = Yii::$app->session['loginname'];
        $userid = User::find()->where('username = :name or useremail = :email', [':name' => $loginname, ':email' => $loginname])->one()->userid;
        $addresses = Address::find()->where('userid = :uid', [':uid' => $userid])->all();
        $details = OrderDetail::find()->where('orderid=:oid', [':oid' => $orderid])->asArray()->joinWith('product')->all();
        $express = Yii::$app->params['express'];
        $expressPrice = Yii::$app->params['expressPrice'];
        return $this->render('check', [
            'addresses' => $addresses,
            'details' => $details,
            'express' => $express,
            'expressPrice' => $expressPrice,
        ]);
    }

    public function actionAdd()
    {
        if (Yii::$app->session['isLogin'] != 1) {
            return $this->redirect(['member/auth']);
        }
        $this->layout = 'layout2';
        $trans = Yii::$app->db->beginTransaction();
        try {
            if (Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                $ordermodel = new Order();
                $ordermodel->scenario = 'add';
                $loginname = Yii::$app->session['loginname'];
                $usermodel = User::find()->where('username = :name or useremail = :email', [':name' => $loginname, ':email' => $loginname])->one();
                if (!$usermodel) {
                    throw new \Exception();
                }
                $ordermodel->userid = $usermodel->userid;
                $ordermodel->status = Order::CREATEORDER;
                $ordermodel->createtime = time();
                if (!$ordermodel->save()) {
                    throw new \Exception();
                }
                $orderid = $ordermodel->getPrimaryKey();
                foreach ($post['OrderDetail'] as $product) {
                    $model = new OrderDetail();
                    $product['orderid'] = $orderid;
                    $product['createtime'] = time();
                    $data['OrderDetail'] = $product;
                    if (!$model->add($data)) {
                        throw new \Exception();
                    }
                    Cart::deleteAll('productid = :pid', [':pid' => $product['productid']]);
                    Product::updateAllCounters(['num' => (int)(-$product['productnum'])], 'productid = :pid', [':pid' => $product['productid']]);
                }
            }
            $trans->commit();
        } catch (\Exception $e) {
            $trans->rollBack();
            Yii::$app->session->setFlash('info', $e->getMessage());
            return $this->redirect(['cart/index']);
        }
        return $this->redirect(['order/check', 'orderid' => $orderid]);
    }

    public function actionConfirm()
    {
        //addressid, expressid, status, amount(orderid,userid)
//        var_dump(Yii::$app->request->post()); exit;
        try {
            if (Yii::$app->session['isLogin'] != 1) {
                return $this->redirect(['member/auth']);
            }
            if (!Yii::$app->request->isPost) {
                throw new \Exception();
            }
            $post = Yii::$app->request->post();
            if (!isset($post['addressid']) || empty($post['addressid'])) {
                throw new \Exception('请选择收获地址');
            }
            $loginname = Yii::$app->session['loginname'];
            $usermodel = User::find()->where('username = :name or useremail = :email', [':name' => $loginname, ':email' => $loginname])->one();
            if (empty($usermodel)) {
                throw new \Exception();
            }
            $userid = $usermodel->userid;
            $model = Order::find()->where('orderid = :oid and userid = :uid', [':oid' => $post['orderid'], ':uid' => $userid])->one();
            if (empty($model)) {
                throw new \Exception();
            }
            $post['status'] = Order::CHECKORDER;
            $details = OrderDetail::find()->where('orderid = :oid', [':oid' => $post['orderid']])->all();
            $amount = 0;
            foreach ($details as $detail) {
                $amount += $detail->productnum * $detail->price;
            }
            if ($amount <= 0) {
                throw new \Exception();
            }
            $express = Yii::$app->params['expressPrice'][$post['expressid']];
            if ($express <= 0) {
                throw new \Exception();
            }
            $amount += $express;
            $post['amount'] = $amount;
            $data['Order'] = $post;
            $model->scenario = 'update';
            if ($model->load($data) && $model->save()) {
//                var_dump($data); exit;
                return $this->redirect(['pay', 'orderid' => $post['orderid'], 'paymethod' => $post['paymethod']]);
            }

        } catch (\Exception $e) {
            Yii::$app->session->setFlash('info', $e->getMessage());
            return $this->redirect(['check', 'orderid' => $post['orderid']]);
        }
    }

    public function actionPay()
    {
        try {
            if (Yii::$app->session['isLogin'] != 1) {
                return $this->redirect(['member/auth']);
            }
            $orderid = Yii::$app->request->get('orderid');
            $paymethod = Yii::$app->request->get('paymethod');
            if (empty($orderid) || empty($paymethod)) {
                throw new \Exception();
            }
            if ($paymethod == 'alipay') {
                return Pay::alipay($orderid);
            }
        } catch (\Exception $e) {
        }
        return $this->redirect(['order/index']);
    }

    public function actionGetexpress()
    {
        $expressno = Yii::$app->request->get('expressno');
        $data = Express::search($expressno);
        echo $data;
        exit;
    }

    public function actionReceived()
    {
        $orderid = Yii::$app->request->get('orderid');
        $order = Order::find()->where('orderid = :oid', [':oid' => $orderid])->one();
        if (!empty($order) && $order->status == Order::SENDED) {
            $order->status = Order::RECEIVID;
            $order->save();
        }
        return $this->redirect(['order/index']);
    }

}
