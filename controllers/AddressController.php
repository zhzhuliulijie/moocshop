<?php


namespace app\controllers;


use app\models\Address;
use app\models\User;
use yii\web\Controller;
use Yii;

class AddressController extends Controller
{
    public function actionAdd()
    {
        if (Yii::$app->session['isLogin'] != 1){
            return $this->redirect(['member/auth']);
        }
        $loginname = Yii::$app->session['loginname'];
        $userid = User::find()->where('username = :name or useremail = :email', [':name'=>$loginname, ':email' => $loginname])->one()->userid;
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $post['address'] = $post['address1'] . $post['address2'];
            $post['userid'] = $userid;
            $post['createtime'] = time();
            $data['Address'] = $post;
            try{
                $model = new Address();
                $model -> load($data);
                $model -> save();
            } catch (\Exception $e){
                return var_dump($e -> getMessage());
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDel()
    {
        if (Yii::$app->session['isLogin'] != 1){
            return $this->redirect(['member/auth']);
        }
        $userid = User::find()->where('username = :name or useremail = :email', [':name'=>$loginname, ':email' => $loginname])->one()->userid;
        $addressid = Yii::$app->request->get('addressid');
        if (!Address::find()->where('userid = :uid and addressid = :aid', [':uid' => $userid, ':aid' => $addressid])->one()){
            return $this->redirect(Yii::$app->request->referrer);
        }
        Address::deleteAll('addressid = :id', [':id'=>$addressid]);
        return $this->redirect(Yii::$app->request->referrer);
    }
}
