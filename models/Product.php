<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property string $productid
 * @property string $cateid
 * @property string $title
 * @property string $descr
 * @property int $num
 * @property string $price
 * @property string $cover
 * @property string $pics
 * @property string $issale
 * @property string $ishot
 * @property string $istui
 * @property string $saleprice
 * @property string $ison
 * @property int $createtime
 */
class Product extends \yii\db\ActiveRecord
{
    const AK = 'f0EM6QVkXCgVPAhaDYKN3r9r-8UJWbMCrsRf5yuh';
    const SK = 'e_T9cs9SERdeB2MwuhCyqbZZM27YZ6vcuOMFHFLT';
    const DOMAIN = 'http://pwxb3m5ne.bkt.clouddn.com';
    const BUCKET = 'blognestimages';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cateid', 'num', 'createtime'], 'integer'],
            [['descr', 'pics', 'issale', 'ishot', 'istui', 'ison'], 'string'],
            [['price', 'saleprice'], 'number'],
            [['title', 'cover'], 'string', 'max' => 200],
            ['title', 'required', 'message'=>'标题不能为空'],
            ['descr', 'required', 'message'=>'描述不能为空'],
            ['cateid', 'required', 'message'=>'分类不能为空'],
            ['price', 'required', 'message'=>'价格不能为空'],
            [['price', 'saleprice'], 'number', 'min'=>'0.01', 'message'=>'价格必须大于0.01元'],
            ['num', 'integer', 'min' => 0, 'message'=>'库存必须为数字'],
            [['issale', 'ishot', 'pics', 'istui'], 'safe'],
            [['cover'], 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'productid' => '商品ID',
            'cateid' => '分类名称',
            'title' => '商品名称',
            'descr' => '商品描述',
            'num' => '库存',
            'price' => '商品价格',
            'cover' => '图片封面',
            'pics' => '商品图片',
            'issale' => '是否促销',
            'ishot' => '是否热卖',
            'istui' => '是否推荐',
            'saleprice' => '促销价格',
            'ison' => '是否上架',
            'createtime' => '创建时间',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['cateid' => 'cateid']);
    }

    public function add($data){
        if ($this->load($data) && $this->save()){
            return true;
        }
        return false;
    }
}
