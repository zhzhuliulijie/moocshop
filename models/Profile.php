<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%profile}}".
 *
 * @property string $id 主键ID
 * @property string $truename 真实姓名
 * @property int $age 年龄
 * @property string $sex 性别
 * @property string $birthday 生日
 * @property string $nickname 昵称
 * @property string $company 公司
 * @property string $userid 用户的ID
 * @property int $createtime 创建时间
 */
class Profile extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%profile}}';
    }

//    /**
//     * {@inheritdoc}
//     */
//    public function rules()
//    {
//        return [
//            [['age', 'userid', 'createtime'], 'integer'],
//            [['sex'], 'string'],
//            [['birthday'], 'safe'],
//            [['truename', 'nickname'], 'string', 'max' => 32],
//            [['company'], 'string', 'max' => 100],
//            [['userid'], 'unique'],
//        ];
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function attributeLabels()
//    {
//        return [
//            'id' => 'ID',
//            'truename' => '真是姓名',
//            'age' => '年龄',
//            'sex' => '性别',
//            'birthday' => '生日',
//            'nickname' => '昵称',
//            'company' => '公司',
//            'userid' => '用户ID',
//            'createtime' => '创建时间',
//        ];
//    }
}
