<?php

namespace app\modules\controllers;

use app\modules\models\Admin;
use yii\data\Pagination;
use Yii;

class ManageController extends CommonController
{
    public function actionManagers()
    {
        $this->layout = 'layout';
        $model = Admin::find();
        $count = $model -> count();
        $pageSize = Yii::$app->params['pageSize']['manage'];
        $pager = new Pagination(['totalCount'=>$count, 'pageSize' => $pageSize]);
        $managers = $model -> offset($pager->offset) -> limit($pager->limit) -> all();
        return $this->render('managers', ['managers' => $managers, 'pager' => $pager]);
    }

    public function actionReg()
    {
        $this->layout = 'layout';
        $model = new Admin();
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if ($model->reg($post)){
                Yii::$app->session->setFlash('info', '添加成功！');
            } else {
                Yii::$app->session->setFlash('info', '添加失败！');
            }
        }
        $model->adminpass = '';
        $model->repass = '';
        return $this->render('reg', ['model' => $model]);
    }

    public function actionDel()
    {
        $adminid = (int)Yii::$app->request->get('adminid');
        if (empty($adminid)){
            $this->redirect(['manage/managers']);
        }
        $model = new Admin();
        if ($model -> deleteAll('adminid = :id', [':id' => $adminid]))
        {
            Yii::$app->session->setFlash('info', '删除成功！');
            $this->redirect(['manage/managers']);
        }
    }

    public function actionChangeemail()
    {
        $this->layout = 'layout';
        $model = Admin::find()->where('adminuser = :user', [':user' => Yii::$app->session['admin']['adminuser']])->one();
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if ($model -> changeEmail($post)){
                Yii::$app->session->setFlash('info', '修改成功！');
            } else {
                Yii::$app->session->setFlash('info', '修改失败！');
            }
        }
        $model -> adminpass = '';
        return $this->render('changeemail', ['model' => $model]);
    }

    public function actionChangepass()
    {
        $this->layout = 'layout';
        $model = Admin::find()->where('adminuser = :user', [':user' => Yii::$app->session['admin']['adminuser']])->one();
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if ($model -> changePass($post)){
                Yii::$app->session->setFlash('info', '修改成功！');
            } else {
                Yii::$app->session->setFlash('info', '修改失败！');
            }
        }
        $model -> adminpass = '';
        $model -> repass = '';
        return $this->render('changepass', ['model' => $model]);
    }

    public function actionMailchangepass()
    {
        $this->layout = false;
//        timestamp=1566041198&adminuser=admin&token=efb8e13f7239ab34c77108acde81cbd0
        $time = Yii::$app->request->get('timestamp');
        $adminuser = Yii::$app->request->get('adminuser');
        $token = Yii::$app->request->get('token');
        $model = new Admin();
        $myToken = $model->createToken($adminuser, $time);
        if ($token != $myToken){
            $this->redirect('public/login');
            Yii::$app->end();
        }
        if (time() - $time > 300){
            $this->redirect('/admin/public/login');
            Yii::$app->end();
        }
        $model -> adminuser = $adminuser;
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if ($model -> changePass($post)){
                Yii::$app->session->setFlash('info', '密码修改成功');
            }
        }
        return $this->render('mailchangepass', ['model' => $model]);
    }

}
