<?php


namespace app\controllers;

use app\models\Cart;
use app\models\Product;
use app\models\User;
use Yii;
use app\models\Category;
use yii\web\Controller;

class CommonController extends Controller
{
    public function init()
    {
        if (Yii::$app->session['isLogin'] == 1){
            $user = User::find()->where('username = :name', [':name' => Yii::$app->session['loginname']])->one();
            if (!empty($user)){
                $userid = $user -> userid;
                //购物车
                $cart = Cart::find()->where('userid = :uid', [':uid' => $userid])->orderBy('createtime asc')->joinWith('product')->asArray()->all();
                $total = 0;
                $data = [];
                foreach ($cart as $k => $item){
                    $total += $item['price'] * $item['productnum'];
                }
                $data['total'] = $total;
                $data['cart'] = $cart;
//        var_dump($data); exit;
                $this->view->params['cart'] = $data;
            }

        }
        $menu = Category::getMenu();
        $this->view->params['menu'] = $menu;
        $where = "ison = '1'";
        $model = Product::find()->where($where);
        $sale = $model->Where($where . ' and issale = \'1\'')->orderby('createtime desc')->limit(4)->asArray()->all();
        $tui = $model->Where($where . ' and istui = \'1\'')->orderby('createtime desc')->limit(4)->asArray()->all();
        $hot = $model->Where($where . ' and ishot = \'1\'')->orderby('createtime desc')->limit(4)->asArray()->all();
        $this->view->params['sale'] = $sale;
        $this->view->params['tui'] = $tui;
        $this->view->params['hot'] = $hot;
    }

}
