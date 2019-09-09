<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property string $orderid
 * @property string $userid
 * @property string $addressid
 * @property string $amount
 * @property int $status
 * @property int $expressid
 * @property string $expressno
 * @property string $tradeno
 * @property string $tradeext
 * @property int $createtime
 * @property string $updatetime
 */
class Order extends \yii\db\ActiveRecord
{
    const CREATEORDER = 0;
    const CHECKORDER = 100;
    const PAYFAILED = 201;
    const PAYSUCCESS = 202;
    const SENDED = 220;
    const RECEIVID = 260;

    public static $status = [
        self::CREATEORDER => '初始化订单',
        self::CHECKORDER => '待支付',
        self::PAYFAILED => '支付失败',
        self::PAYSUCCESS => '支付成功',
        self::SENDED => '已发货',
        self::RECEIVID => '订单完成',
    ];

    public $products;
    public $zhstatus;
    public $username;
    public $address;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userid', 'addressid', 'status', 'expressid', 'createtime'], 'integer'],
            [['amount'], 'number'],
            [['tradeext'], 'string'],
            [['updatetime'], 'safe'],
            [['expressno'], 'string', 'max' => 50],
            [['tradeno'], 'string', 'max' => 100],
            [['userid', 'status'], 'required', 'on' => ['add']],
            [['addressid', 'expressid', 'amount', 'status'], 'required', 'on' => ['update']],
            ['expressno', 'required', 'message' => '请输入快递单号', 'on' => 'send'],
            ['createtime', 'safe', 'on' => ['add']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'orderid' => 'Orderid',
            'userid' => 'Userid',
            'addressid' => 'Addressid',
            'amount' => 'Amount',
            'status' => 'Status',
            'expressid' => 'Expressid',
            'expressno' => '快递单号',
            'tradeno' => 'Tradeno',
            'tradeext' => 'Tradeext',
            'createtime' => 'Createtime',
            'updatetime' => 'Updatetime',
        ];
    }

    public function getDetail()
    {
        return $this->hasMany(OrderDetail::className(), ['orderid' => 'orderid']);
    }

    public function getProduct()
    {
        return $this->hasMany(Product::className(), ['productid'=>'productid'])->joinWith('category')->via('detail');
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['userid' => 'userid']);
    }

    public function getAddr()
    {
        return $this->hasOne(Address::className(), ['addressid' => 'addressid']);
    }

//    public static function getDetail($orders)
//    {
//        foreach($orders as $order){
//            $order = self::getData($order);
//        }
//        return $orders;
//    }
//
//    public static function getData($order)
//    {
//        $details = OrderDetail::find()->where('orderid = :oid', [':oid' => $order->orderid])->all();
//        $products = [];
//        foreach($details as $detail) {
//            $product = Product::find()->where('productid = :pid', [':pid' => $detail->productid])->one();
//            if (empty($product)) {
//                continue;
//            }
//            $product->num = $detail->productnum;
//            $products[] = $product;
//        }
//        $order->products = $products;
//        $user = User::find()->where('userid = :uid', [':uid' => $order->userid])->one();
//        if (!empty($user)) {
//            $order->username = $user->username;
//        }
//        $order->address = Address::find()->where('addressid = :aid', [':aid' => $order->addressid])->one();
//        if (empty($order->address)) {
//            $order->address = "";
//        } else {
//            $order->address = $order->address->address;
//        }
//        $order->zhstatus = self::$status[$order->status];
//        return $order;
//    }
//
//    public static function getProducts($userid)
//    {
//        $orders = self::find()->where('status > 0 and userid = :uid', [':uid' => $userid])->orderBy('createtime desc')->all();
//        foreach($orders as $order) {
//            $details = OrderDetail::find()->where('orderid = :oid', [':oid' => $order->orderid])->all();
//            $products = [];
//            foreach($details as $detail) {
//                $product = Product::find()->where('productid = :pid', [':pid' => $detail->productid])->one();
//                if (empty($product)) {
//                    continue;
//                }
//                $product->num = $detail->productnum;
//                $product->price = $detail->price;
//                $product->cate = Category::find()->where('cateid = :cid', [':cid' => $product->cateid])->one()->title;
//                $products[] = $product;
//            }
//            $order->zhstatus = self::$status[$order->status];
//            $order->products = $products;
//        }
//        return $orders;
//    }
}
