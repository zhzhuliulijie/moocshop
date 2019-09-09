<?php


namespace app\models;

use Yii;

class Pay
{
    public static function alipay($orderid)
    {
        $amount = Order::find()->where('orderid = :oid', [':oid' => $orderid])->one()->amount;
        if (!empty($amount)){
            require_once dirname(__DIR__).'/vendor/alipay/pagepay/service/AlipayTradeService.php';
            require_once dirname(__DIR__).'/vendor/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php';
            $config = Yii::$app->params['alipay'];

            $giftname = "慕课商城";
            $data = OrderDetail::find()->where('orderid = :oid', [':oid' => $orderid])->all();
            $body = "";
            foreach($data as $pro) {
                $body .= Product::find()->where('productid = :pid', [':pid' => $pro['productid']])->one()->title . " - ";
            }
            $body .= "等商品";

            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = $orderid;

            //订单名称，必填
            $subject = $giftname;

            //付款金额，必填
            $total_amount = $amount;

            //构造参数
            $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
            $payRequestBuilder->setBody($body);
            $payRequestBuilder->setSubject($subject);
            $payRequestBuilder->setTotalAmount($total_amount);
            $payRequestBuilder->setOutTradeNo($out_trade_no);

            $aop = new \AlipayTradeService($config);

            /**
             * pagePay 电脑网站支付请求
             * @param $builder 业务参数，使用buildmodel中的对象生成。
             * @param $return_url 同步跳转地址，公网可以访问
             * @param $notify_url 异步通知地址，公网可以访问
             * @return $response 支付宝返回的信息
             */
            $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);

            //输出表单
            var_dump($response);
        }
    }

    public static function notify($data)
    {
        require_once dirname(__DIR__).'/vendor/alipay/pagepay/service/AlipayTradeService.php';
        $config = Yii::$app->params['alipay'];

        $arr=$data;
        $alipaySevice = new \AlipayTradeService($config);
        $alipaySevice->writeLog(var_export($data,true));
        $result = $alipaySevice->check($arr);
        if ($result){
            //商户订单号
            $out_trade_no = $data['out_trade_no'];
            //支付宝交易号
            $trade_no = $data['trade_no'];
            //交易状态
            $trade_status = $data['trade_status'];
            $status = Order::PAYFAILED;
            if ($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS'){
                $status = Order::PAYSUCCESS;
                $order_info = Order::find()->where('orderid = :oid', [':oid' => $out_trade_no])->one();
                if (!$order_info){
                    return false;
                }
                if ($order_info->status == Order::CHECKORDER){
                    Order::updateAll(['status'=>$status, 'tradeno' => $trade_no, 'tradeext' => json_encode($data)], 'orderid = :oid', [':oid' => $order_info->orderid]);
                } else {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }
}
