<?php
namespace backend\models;

use yii\base\Model;
use common\models\Adminuser;
use yii\helpers\VarDumper;

/**
 * Signup form
 */
class ResetpwdForm extends Model
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

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['password_repeat','compare','compareAttribute'=>'password','message' => '两次输入的密码必须一样'],

        ];
    }

    public function attributeLabels()
    {
        return [

            'password' => '密码',
            'password_repeat' => '重复密码',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function resetPassword($id)
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = Adminuser::findOne($id);
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

//        $user->save();VarDumper::dump($user->errors);exit(0);
        
        return $user->save() ? true : false;
    }
}
