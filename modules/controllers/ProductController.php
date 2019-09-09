<?php

namespace app\modules\controllers;

use app\models\Category;
use app\models\Product;
use crazyfd\qiniu\Qiniu;
use yii\data\Pagination;
use Yii;

class ProductController extends CommonController
{
    public function actionList()
    {
        $this->layout = 'layout';
        $model = Product::find()->joinWith('category');
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['product'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $products = $model->offset($pager->offset)
            ->limit($pager->limit)
            ->all();
        return $this->render('list', ['products' => $products, 'pager'=>$pager]);
    }

    public function actionAdd()
    {
        $this->layout = 'layout';
        $btnText = '创建';
        $cate = new Category();
        $list = $cate->getOptions();
//        array_shift($list);
        unset($list[0]);
        $model = new Product();
        if (Yii::$app->request->isPost) {
//            print_r($_FILES); exit;
            $post = Yii::$app->request->post();
            $pics = $this->upload();
//            var_dump($pics); exit;
            if (!$pics) {
                $model->addError('cover', '封面不能为空！');
            } else {
                $post['Product']['cover'] = $pics['cover'];
                $post['Product']['pics'] = $pics['pics'];
            }
            if ($pics && $model->add($post)) {
                Yii::$app->session->setFlash('info', '添加成功！');
            } else {
                Yii::$app->session->setFlash('info', '添加失败！');
            }
        }
        return $this->render('add', ['model' => $model, 'list' => $list, 'btnText' => $btnText]);
    }

    public function actionMod()
    {
        $this->layout = 'layout';
        $productid = Yii::$app->request->get('productid');
        $btnText = '修改';
        $cate = new Category();
        $list = $cate->getOptions();
//        array_shift($list);
        unset($list[0]);
        $model = Product::find()->where('productid = :id', [':id' => $productid])->one();
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $qn = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
            $post['Product']['cover'] = $model -> cover;
            if ($_FILES['Product']['error']['cover'] == 0){
                $key = uniqid();
                $qn -> uploadFile($_FILES['Product']['tmp_name']['cover'], $key);
                $post['Product']['cover'] = $qn -> getLink($key);
                $qn -> delete(basename($model->cover));
            }
            $pics = [];
            foreach ($_FILES['Product']['tmp_name']['pics'] as $k => $file){
                if ($_FILES['Product']['error']['pics'][$k] > 0){
                    continue;
                }
                $key = uniqid();
                $qn -> uploadFile($file, $key);
                $pics[$key] = $qn -> getLink($key);
            }
            $post['Product']['pics'] = json_encode(array_merge((array)json_decode($model->pics, true), $pics));
            if ($model->load($post) && $model->save()){
                Yii::$app->session->setFlash('info', '修改成功！');
            } else {
                Yii::$app->session->setFlash('info', '修改失败！');
            }
        }
        return $this->render('add', ['model'=>$model, 'list'=>$list, 'btnText' => $btnText]);
    }

    public function actionRemovepic()
    {
        $key = Yii::$app->request->get('key');
        $productid = Yii::$app->request->get('productid');
        $model = Product::find()->where('productid = :pid', [':pid' => $productid])->one();
        $qn = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
        $qn -> delete($key);
        $pics = json_decode($model->pics, true);
        unset($pics[$key]);
        $model->updateAll(['pics'=>json_encode($pics)], 'productid = :pid', [':pid' => $productid]);
        return $this->redirect(['mod', 'productid' => $productid]);
    }

    public function actionDel()
    {
        $productid = Yii::$app->request->get('productid');
        $model = Product::find()->where('productid = :pid', [':pid' => $productid])->one();
        $qn = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
        $key = basename($model->cover);
        $qn->delete($key);
        $pics = json_decode($model->pics, true);
        foreach ($pics as $key => $file){
            $qn -> delete($key);
        }
        $model->deleteAll('productid = :pid', [':pid' => $productid]);
        return $this->redirect(['list']);
    }

    public function actionOn()
    {
        $productid = Yii::$app->request->get('productid');
        Product::updateAll(['ison' => 1], 'productid = :pid', [':pid' => $productid]);
        return $this->redirect('list');
    }

    public function actionOff()
    {
        $productid = Yii::$app->request->get('productid');
        Product::updateAll(['ison' => 0], 'productid = :pid', [':pid' => $productid]);
        return $this->redirect('list');
    }

    public function upload()
    {
//        print_r($_FILES); exit;
        if ($_FILES['Product']['error']['cover'] > 0) {
            return false;
        }
        $qn = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
        $key = uniqid();
        $qn->uploadFile($_FILES['Product']['tmp_name']['cover'], $key);
        $cover = $qn->getLink($key);
        $pics = [];
        foreach ($_FILES['Product']['tmp_name']['pics'] as $k => $file) {
            if ($_FILES['Product']['error']['pics'][$k] > 0) {
                continue;
            }
            $key = uniqid();
            $qn->uploadFile($file, $key);
            $pics[$key] = $qn->getLink($key);
        }
        return ['cover' => $cover, 'pics' => json_encode($pics)];
    }

}
