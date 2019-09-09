<?php

namespace app\modules\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "shop_admin".
 *
 * @property int $adminid 主键ID
 * @property string $adminuser 管理员账号
 * @property string $adminpass 管理员密码
 * @property string $adminemail 管理员电子邮箱
 * @property int $logintime 登录时间
 * @property int $loginip 登录IP
 * @property int $createtime 创建时间
 */
class Admin extends ActiveRecord
{
    public $rememberMe = true;
    public $repass;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['logintime', 'loginip', 'createtime'], 'integer'],
            [['adminuser', 'adminpass'], 'string', 'max' => 32],
            [['adminemail'], 'string', 'max' => 50],
//            [['adminuser', 'adminpass'], 'unique', 'targetAttribute' => ['adminuser', 'adminpass']],
//            [['adminuser', 'adminemail'], 'unique', 'targetAttribute' => ['adminuser', 'adminemail']],
            ['adminuser', 'required', 'message' => '管理员账号不能为空', 'on' => ['login', 'seekpass', 'changepass', 'reg', 'changeemail']],
            ['adminuser', 'unique', 'message' => '管理员账号已经存在', 'on' => ['reg']],
            ['adminpass', 'required', 'message' => '管理员密码不能为空', 'on' => ['login', 'changepass', 'reg', 'changeemail']],
            ['rememberMe', 'boolean', 'on' => 'login'],
            ['adminpass', 'validatePass', 'on' => ['login', 'changeemail']],
            ['adminemail', 'required', 'message' => '管理员电子邮箱不能为空', 'on' => ['seekpass', 'reg', 'changeemail']],
            ['adminemail', 'email', 'message' => '管理员电子邮箱格式不正确', 'on' => ['seekpass', 'reg', 'changeemail']],
            ['adminemail', 'unique', 'message' => '管理员邮箱已经存在', 'on' => ['reg', 'changeemail']],
            ['adminemail', 'validateEmail', 'on' => 'seekpass'],
            ['repass', 'required', 'message'=>'确认密码不能为空', 'on' => ['changepass', 'reg']],
            ['repass', 'compare', 'compareAttribute'=>'adminpass', 'message' => '两次密码输入不一致', 'on' => ['changepass', 'reg']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'adminid' => '管理员ID',
            'adminuser' => '管理员账号',
            'adminpass' => '密码',
            'repass' => '确认密码',
            'adminemail' => '管理员邮箱',
            'logintime' => '最后登录时间',
            'loginip' => '最后登录IP',
            'createtime' => '创建时间',
        ];
    }

    public function validatePass()
    {
        if (!$this->hasErrors()) {
            $data = self::find()->where('adminuser = :user and adminpass = :pass', [':user' => $this->adminuser, ':pass' => md5($this->adminpass)])->one();
            if (is_null($data)) {
                $this->addError('adminpass', '管理员账号和密码不匹配');
            }
        }
    }

    public function validateEmail()
    {
        if (!$this->hasErrors()) {
            $data = self::find()->where('adminuser = :user and adminemail = :email', [':user' => $this->adminuser, ':email' => $this->adminemail])->one();
            if (is_null($data)) {
                $this->addError('adminemail', '账号和邮箱不匹配');
            }
        }
    }

    public function login($data)
    {
        $this->scenario = 'login';
        if ($this->load($data) && $this->validate()) {
            // do something
//            $lifetime = $this->rememberMe ? 24 * 3600 : 0;
            $session = Yii::$app->session;
//            session_set_cookie_params($lifetime);
            $session['admin'] = [
                'adminuser' => $this->adminuser,
                'isLogin' => 1,
            ];
            $this->updateall(['logintime' => time(), 'loginip' => ip2long(Yii::$app->request->userIP)], 'adminuser = :user', [':user' => $this->adminuser]);
            return (bool)$session['admin']['isLogin'];
        }
        return false;
    }

    public function seekPass($data)
    {
        $this->scenario = 'seekpass';
        if ($this->load($data) && $this->validate()) {
            //做点有意义的事
            $time = time();
            $token = $this->createToken($data['Admin']['adminuser'], $time);
            $mailer = Yii::$app->mailer->compose('seekpass', ['adminuser' => $data['Admin']['adminuser'], 'time' => $time, 'token' => $token]);
            $mailer->setFrom("yjhtjhso@126.com");
            $mailer->setTo($data['Admin']['adminemail']);
            $mailer->setSubject("慕课商城-找回密码");
            if ($mailer->send()) {
                return true;
            }
        }
        return false;
    }

    public function createToken($adminuser, $time)
    {
        return md5(md5($adminuser) . base64_encode(Yii::$app->request->userIP) . md5($time));
    }

    public function changePass($data)
    {
        $this->scenario = 'changepass';
        if ($this->load($data) && $this->validate()) {
            return (bool)$this->updateAll(['adminpass' => md5($this->adminpass)], 'adminuser = :user', [':user'=>$this->adminuser]);
        }
        return false;
    }

    public function reg($data)
    {
        $this->scenario = 'reg';
        if ($this->load($data) && $this->validate()){
            $this->adminpass = md5($this->adminpass);
            $this->repass = md5($this->repass);
            $this->createtime = time();
            if ($this->save(false)){
                return true;
            }
            return false;
        }
        return false;
    }

    public function changeEmail($data)
    {
        $this->scenario = 'changeemail';
        if ($this->load($data) && $this->validate()){
            return (bool)$this->updateAll(['adminemail' => $this->adminemail], 'adminuser = :user', [':user' => $this->adminuser]);
        }
        return false;
    }

}
