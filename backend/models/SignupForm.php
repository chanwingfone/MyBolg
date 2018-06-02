<?php
namespace backend\models;

use yii\base\Model;
use common\models\Adminuser;
use yii\helpers\VarDumper;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $profile;
    public $nickname;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '用户名已存在'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '邮箱地址已存在'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['password_repeat','compare','compareAttribute'=>'password','message' => '两次输入的密码必须一样'],

            ['nickname', 'required'],
            ['nickname', 'string', 'min' => 2, 'max' => 128],

            ['profile', 'string',],

        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'nickname' => 'Nickname',
            'password' => '密码',
            'password_repeat' => '重复密码',
            'email' => '邮箱',
            'profile' => '简介',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new Adminuser();
        $user->username = $this->username;
        $user->nickname = $this->nickname;
        $user->email = $this->email;
        $user->profile = $this->profile;
        $user->password = '*';
//        $user->password_reset_token = null;
        $user->setPassword($this->password);
        $user->generateAuthKey();

//        $user->save();VarDumper::dump($user->errors);exit(0);
        
        return $user->save() ? $user : null;
    }
}
