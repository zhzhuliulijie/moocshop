<?php


namespace app\controllers;

use app\models\Order;
use app\models\Pay;
use Yii;

class PayController extends CommonController
{
    public $enableCsrfValidation = false;
    public function actionNotify()
    {
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if (Pay::notify($post)){
                echo 'success';
                exit;
            }
            echo 'fail';
            exit;
        }
    }

    public function actionReturn()
    {
        require_once dirname(__DIR__) . '/vendor/alipay/pagepay/service/AlipayTradeService.php';
        $this->layout = 'layout1';
        $config = Yii::$app->params['alipay'];
        $arr=$_GET;
        $alipaySevice = new \AlipayTradeService($config);
        $result = $alipaySevice->check($arr);
        if ($result){
            //商户订单号
            $out_trade_no = htmlspecialchars($_GET['out_trade_no']);

            //支付宝交易号
//            $trade_no = htmlspecialchars($_GET['trade_no']);

            //支付宝交总金额
//            $total_amount = htmlspecialchars($_GET['total_amount']);

            $order_info = Order::find()->where('orderid = :oid', [':oid' => $out_trade_no])->one();
            if ($order_info->status == Order::PAYSUCCESS){
                $s = 'ok';
            } else {
                $s = 'no';
            }
        } else {
            $s = 'no';
        }
        return $this->render("status", ['status' => $s]);
    }

}
