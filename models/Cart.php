<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%cart}}".
 *
 * @property string $cartid
 * @property string $productid
 * @property int $productnum
 * @property string $price
 * @property string $userid
 * @property int $createtime
 */
class Cart extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cart}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['productid', 'productnum', 'userid', 'createtime'], 'integer'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cartid' => 'Cartid',
            'productid' => 'Productid',
            'productnum' => 'Productnum',
            'price' => 'Price',
            'userid' => 'Userid',
            'createtime' => 'Createtime',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['productid' => 'productid']);
    }
}
