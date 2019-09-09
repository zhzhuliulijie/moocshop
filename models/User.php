<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property string $userid 主键ID
 * @property string $username
 * @property string $userpass
 * @property string $useremail
 * @property int $createtime
 */
class User extends ActiveRecord
{
    public $repass;
    public $loginname;
    public $rememberMe = true;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['createtime'], 'integer'],
            [['username', 'userpass', 'openid'], 'string', 'max' => 32],
            [['uid'], 'integer'],
            [['useremail'], 'string', 'max' => 100],
            [['username', 'userpass'], 'unique', 'targetAttribute' => ['username', 'userpass']],
            [['useremail', 'userpass'], 'unique', 'targetAttribute' => ['useremail', 'userpass']],
            ['username', 'required', 'message' => '用户名不能为空', 'on' => ['reg', 'regbymail', 'qqreg', 'sinareg']],
            ['username', 'unique', 'message' => '用户名已经存在', 'on' => ['reg', 'regbymail', 'qqreg', 'sinareg']],
            ['openid', 'required', 'message' => 'openid不能为空', 'on' => ['qqreg']],
            ['openid', 'unique', 'message' => 'openid已经存在', 'on' => ['qqreg']],
            ['uid', 'required', 'message' => 'uid不能为空', 'on' => ['sinareg']],
            ['uid', 'unique', 'message' => 'uid已经存在', 'on' => ['sinareg']],
            ['useremail', 'required', 'message' => '邮箱不能为空', 'on' => ['reg', 'regbymail']],
            ['useremail', 'unique', 'message' => '该邮箱已经被注册', 'on' => ['reg', 'regbymail']],
            ['useremail', 'email', 'message' => '邮箱格式不正确', 'on' => ['reg', 'regbymail']],
            ['userpass', 'required', 'message' => '密码不能为空', 'on' => ['reg', 'login', 'regbymail', 'qqreg', 'sinareg']],
            ['repass', 'required', 'message' => '确认密码不能为空', 'on' => ['reg', 'qqreg', 'sinareg']],
            ['repass', 'compare', 'compareAttribute' => 'userpass', 'message' => '两次密码输入不一致', 'on' => ['reg', 'qqreg', 'sinareg']],
            ['loginname', 'required', 'message' => '账号不能为空', 'on' => ['login']],
            ['userpass', 'validatePass', 'on' => ['login']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'loginname' => '账号',
            'userid' => '用户ID',
            'username' => '用户名',
            'userpass' => '密码',
            'repass' => '确认密码',
            'useremail' => '邮箱',
            'createtime' => '创建时间',
        ];
    }

    public function validatePass()
    {
        if (!$this->hasErrors()){
            $loginname = 'username';
            if (preg_match('/@/', $this->$loginname)){
                $loginname = 'useremail';
            }
            $data = self::find()->where($loginname . ' = :username and userpass = :pass', [':username' => $this->loginname, ':pass' => md5($this->userpass)])->one();
            if (is_null($data)){
                $this->addError('userpass', '账号和密码不匹配！');
            }
        }
    }

    public function reg($data, $scenario='reg')
    {
        $this -> scenario = $scenario;
        if ($this->load($data) && $this->validate()){
            //
            $this->createtime = time();
            $this->userpass = md5($this->userpass);
            if ($this->save(false)){
                return true;
            }
            return false;
        }
        return false;
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['userid' => 'userid']);
    }

    public function login($data)
    {
        $this->scenario = 'login';
        if ($this->load($data) && $this->validate()){
            $session = Yii::$app->session;
            $session['loginname'] = $this->loginname;
            $session['isLogin'] = 1;
            return (bool)$session['isLogin'];
        }
        return false;
    }

    public function regByMail($data)
    {
        $this->scenario = 'regbymail';
        $data['User']['username'] = 'imooc_' . uniqid();
        $data['User']['userpass'] = uniqid();
        if ($this->load($data) && $this->validate()){
            $mailer = Yii::$app->mailer->compose('createuser', ['userpass' => $data['User']['userpass'], 'username' => $data['User']['username']]);
            $mailer->setFrom("yjhtjhso@126.com");
            $mailer->setTo($data['User']['useremail']);
            $mailer->setSubject("慕课商城-新建用户");
            if ($mailer->send() && $this->reg($data, 'regbymail')){
                return true;
            }
        }
        return false;
    }
}
