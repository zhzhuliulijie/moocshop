<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%order_detail}}".
 *
 * @property string $detailid
 * @property string $productid
 * @property string $price
 * @property int $productnum
 * @property string $orderid
 * @property int $createtime
 */
class OrderDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order_detail}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['productid', 'productnum', 'orderid', 'createtime'], 'integer'],
            [['price'], 'number'],
            [['productid', 'productnum', 'price', 'orderid', 'createtime'],'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'detailid' => 'Detailid',
            'productid' => 'Productid',
            'price' => 'Price',
            'productnum' => 'Productnum',
            'orderid' => 'Orderid',
            'createtime' => 'Createtime',
        ];
    }

    public function add($data){
        if ($this->load($data) && $this->save()){
            return true;
        }
        return false;
    }

    public function getProduct(){
        return $this->hasOne(Product::className(), ['productid' => 'productid']);
    }
}
