<?php

namespace app\modules\controllers;

use Yii;

class CategoryController extends CommonController
{
    public function actionList()
    {
        $this->layout = "layout";
        $model = new Category();
        $cates = $model->getTreeList();
        return $this->render('list', ['cates' => $cates]);
    }

    public function actionAdd()
    {
        $this->layout = "layout";
        $btnText = '添加';
        $model = new Category();
        $list = $model->getOptions();
        if (\Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post();
            if ($model->addCategroy($post)) {
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
        $btnText = '修改';
        $cateid = Yii::$app->request->get('cateid');
        $model = Category::find()->where('cateid = :id', [':id' => $cateid])->one();
        $list = $model->getOptions();
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if ($model->load($post) && $model->save()){
                Yii::$app->session->setFlash('info', '修改成功！');
            } else {
                Yii::$app->session->setFlash('info', '修改失败！');
            }
        }
        return $this->render('add', ['model' => $model, 'list' => $list, 'btnText' => $btnText]);
    }

    public function actionDel()
    {
        try{
            $cateid = Yii::$app->request->get('cateid');
            if (empty($cateid)){
                throw new \Exception('参数错误');
            }
            $data = Category::find()->where('parentid = :pid', [':pid' => $cateid])->one();
            if ($data){
                throw new \Exception('该分类下存在子类，不允许删除！');
            }
            if (!Category::deleteAll('cateid = :id', [':id' => $cateid])){
                throw new \Exception('删除失败');
            }
        }catch (\Exception $e){
            Yii::$app->session->setFlash('info', $e->getMessage());
        }
        return $this->redirect('list');
    }

}
