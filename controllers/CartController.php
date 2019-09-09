<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Product;
use app\models\User;
use Yii;

class CartController extends CommonController
{
    public function actionIndex()
    {
        $this->layout = 'layout2';
        $userid = User::find()->where('username = :username', [':username' => Yii::$app->session['loginname']])->one()->userid;
        $carts = Cart::find()->where('userid = :uid', [':uid' => $userid])->joinWith('product')->all();
//        var_dump($carts); exit();
        return $this->render('index', ['carts' => $carts]);
    }

    public function actionAdd()
    {
        if (Yii::$app->session['isLogin'] != 1){
            return $this->redirect(['member/auth']);
        }
        $userid = User::find()->where('username = :username', [':username' => Yii::$app->session['loginname']])->one()->userid;
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $num = Yii::$app->request->post()['productnum'];
            $data['Cart'] = $post;
            $data['Cart']['userid'] = $userid;
        }
        if (Yii::$app->request->isGet){
            $productid = Yii::$app->request->get('productid');
            $model = Product::find()->where('productid = :pid', [':pid' => $productid])->one();
            $price = $model->issale ? $model-> saleprice : $model -> price;
            $num = 1;
            $data['Cart'] = [
                'productid' => $productid,
                'userid' => $userid,
                'price' => $price,
                'productnum' => $num,
            ];
        }
        // $model = Product::find()->where('productid = :pid and userid = :uid', [':pid' => $productid, ':uid' => $userid])->one();
        if (!$model = Cart::find()->where('productid = :pid and userid = :uid', [':pid'=>$data['Cart']['productid'], ':uid'=>$userid])->one()){
            $model = new Cart();
        } else {
            $data['Cart']['productnum'] = $model->productnum + $num;
        }
        $model->createtime = time();
        $model -> load($data);
        $model -> save();
        return $this->redirect(['cart/index']);
    }

    public function actionMod()
    {
        $cartid = Yii::$app->request->get('cartid');
        $productnum = Yii::$app->request->get('productnum');
        Cart::updateAll(['productnum' => $productnum], 'cartid = :id', [':id' => $cartid]);
    }

    public function actionDel()
    {
        $cartid = Yii::$app->request->get('cartid');
        if (empty($cartid)){
            return false;
        }
        if (Cart::deleteAll('cartid = :id', [':id' => $cartid])){
            Yii::$app->session->setFlash('info', '删除成功！');
            return $this->redirect(['index']);
        }
    }

}
