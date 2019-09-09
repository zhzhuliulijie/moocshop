<?php

namespace app\controllers;

use app\models\User;
use Yii;

class MemberController extends CommonController
{
    public function actionAuth()
    {
        $this->layout = 'layout2';
        $model = new User();
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if ($model->login($post)){
                return $this->goBack(Yii::$app->request->referrer);
            }
        }
        return $this->render('auth', ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::$app->session->remove('loginname');
        Yii::$app->session->remove('isLogin');
        if (!Yii::$app->session['isLogin']){
            return $this->goBack(Yii::$app->request->referrer);
        }
    }

    public function actionReg()
    {
        $this->layout = 'layout2';
        $model = new User();
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if ($model->regByMail($post)){
                Yii::$app->session->setFlash('info', '电子邮件发送成功！');
            }
        }
        return $this->render('auth', ['model' => $model]);
    }

    public function actionQqlogin()
    {
        require_once dirname(__DIR__) . '/vendor/qqlogin/qqConnectAPI.php';
        $qc = new \QC();
        $qc -> qq_login();
    }

    public function actionQqcallback()
    {
        require_once dirname(__DIR__) . '/vendor/qqlogin/qqConnectAPI.php';
        $auth = new \Oauth();
        $accessToken = $auth -> qq_callback();
        $openid = $auth -> get_openid();
        $qc = new \QC($accessToken, $openid);
        $userinfo = $qc -> get_user_info();
        $session = Yii::$app->session;
        $session['userinfo'] = $userinfo;
        $session['openid'] = $openid;
        if (User::find()->where('openid = :openid', [':openid' => $openid])->one()){
            $session['loginname'] = $userinfo['nickname'];
            $session['isLogin'] = 1;
            return $this->redirect(['index/index']);
        }
        return $this->redirect(['member/qqreg']);
    }

    public function actionQqreg()
    {
        $this -> layout = 'layout2';
        $model = new User();
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $session = Yii::$app->session;
            $post['User']['openid'] = $session['openid'];
            if ($model -> reg($post, 'qqreg')){
                $session['loginname'] = $session['userinfo']['nickname'];
                $session['isLogin'] = 1;
                return $this->redirect(['index/index']);
            }
        }
        return $this->render('qqreg', ['model' => $model]);
    }

    public function actionSinalogin()
    {
        require_once dirname(__DIR__) . '/vendor/sinalogin/config.php';
        require_once dirname(__DIR__) . '/vendor/sinalogin/saetv2.ex.class.php';
        $o = new \SaeTOAuthV2( WB_AKEY , WB_SKEY );
        $code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );
        header('location:' . $code_url);
    }

    public function actionSinacallback()
    {
        require_once dirname(__DIR__) . '/vendor/sinalogin/config.php';
        require_once dirname(__DIR__) . '/vendor/sinalogin/saetv2.ex.class.php';
        $o = new \SaeTOAuthV2( WB_AKEY , WB_SKEY );
        if (Yii::$app->request->get('code')) {
            $keys = array();
            $keys['code'] = Yii::$app->request->get('code');
            $keys['redirect_uri'] = WB_CALLBACK_URL;
            try {
                $token = $o->getAccessToken( 'code', $keys ) ;
                $c = new \SaeTClientV2( WB_AKEY , WB_SKEY , $token['access_token']);
                $ms  = $c->home_timeline(); // done
                $uid_get = $c->get_uid();
                $uid = $uid_get['uid'];
                $user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
                $session = Yii::$app->session;
                $session['userinfo'] = $user_message;
                $session['uid'] = $uid;
                if (User::find()->where('uid = :uid', [':uid' => $uid])->one()){
                    $session['loginname'] = $session['userinfo']['screen_name'];
                    $session['isLogin'] = 1;
                    return $this->redirect(['index/index']);
                }
                return $this->redirect(['member/sinareg']);
            } catch (OAuthException $e) {
            }
        }
    }

    public function actionSinareg()
    {
        $this->layout = 'layout2';
        $model = new User;
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $session = Yii::$app->session;
            $post['User']['uid'] = $session['uid'];
            if ($model -> reg($post, 'sinareg')){
                $session['loginname'] = $session['userinfo']['screen_name'];
                $session['isLogin'] = 1;
                return $this->redirect(['index/index']);
            }
        }
        return $this->render('sinareg', ['model' => $model]);
    }

}
