<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property string $cateid
 * @property string $title
 * @property string $parentid
 * @property int $createtime
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parentid', 'createtime'], 'integer'],
            [['title'], 'string', 'max' => 32],
            ['title', 'required', 'message' => '分类名称不能为空', 'on' => ['add']],
            ['title', 'unique', 'message' => '分类名称已经存在', 'on' => ['add']],
            ['parentid', 'required', 'message' => '父级商品分类名称不能为空', 'on' => ['add']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cateid' => '商品分类ID',
            'title' => '商品分类名称',
            'parentid' => '父级商品分类名称',
            'createtime' => '创建时间',
        ];
    }

    public function addCategroy($data)
    {
        $this->scenario = 'add';
        $this->createtime = time();
        if ($this->load($data) && $this->save()) {
            return true;
        }
        return false;
    }

    public function getData()
    {
        $cates = self::find()->all();
        $cates = ArrayHelper::toArray($cates);
        return $cates;
    }

    public function getTree($cates, $pid = 0)
    {
        static $tree = [];
        foreach ($cates as $cate) {
            if ($cate['parentid'] == $pid) {
                $tree[] = $cate;
                $this->getTree($cates, $cate['cateid']);
            }
        }
        return $tree;
    }

    /*
     * @method setPrefix
     * */
    public function setPrefix($data, $p = '┠┄┄┄┄┄┄┄')
    {
        $tree = [];
        $num = 1;
        $prefix = [0 => 1];
        while ($val = current($data)) {
            $key = key($data);
            if ($key > 0) {
                if ($data[$key - 1]['parentid'] != $val['parentid']){
                    $num++;
                }
            }
            if (array_key_exists($val['parentid'], $prefix)){
                $num = $prefix[$val['parentid']];
            }
            $val['title'] = str_repeat($p, $num) . $val['title'];
            $prefix[$val['parentid']] = $num;
            $tree[] = $val;
            next($data);
        }
        return $tree;
    }

    public function getOptions()
    {
        $data = $this->getData();
        $tree = $this->getTree($data);
        $tree = $this->setPrefix($tree);
        $options = [0 => '顶级分类'];
        foreach ($tree as $cate){
            $options[$cate['cateid']] = $cate['title'];
        }
        return $options;
    }

    public function getTreeList()
    {
        $data = $this->getData();
        $tree = $this->getTree($data);
        $tree = $this->setPrefix($tree);
        return $tree;
    }

    public static function getMenu()
    {
        $top = Category::find()->where('parentid = :pid', [':pid' => '0'])->limit(11)->orderBy('createtime asc')->asArray()->all();
        $data = [];
        foreach ((array)$top as $k => $cate){
            $cate['children'] = Category::find()->where('parentid = :pid', [':pid' => $cate['cateid']])->limit(10)->asArray()->all();
            $data[$k] = $cate;
        }
        return $data;
    }
}
