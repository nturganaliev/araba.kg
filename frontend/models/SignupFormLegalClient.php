<?php

namespace frontend\models;

use common\models\User;
use common\models\UserProfile;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupFormLegalClient extends Model {

    public $fio;
    public $companyName;
    public $mobilePhone;
    public $workPhone;
    public $email;
    public $password;
    public $password_repeat;
    public $using_rules = true;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['fio', 'companyName', 'workPhone', 'email', 'mobilePhone', 'password', 'password_repeat'], 'required'],
            [['companyName', 'workPhone', 'fio', 'email', 'mobilePhone', 'password'], 'filter', 'filter' => 'trim'],
            ['fio', 'string', 'min' => 4, 'max' => 30],
            ['companyName', 'string', 'min' => 4, 'max' => 30],
            ['mobilePhone', 'string', 'min' => 6, 'max' => 20],
            ['workPhone', 'string', 'min' => 5, 'max' => 20],
            ['email', 'string', 'max' => 30],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'string', 'min' => 6, 'max' => 30],
            ['password_repeat', 'safe'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['using_rules', 'required', 'requiredValue' => 1, 'message' => yii::t('app', 'I accept using conditions')]
        ];
    }

    public function attributeLabels() {
        return [
            'fio' => yii::t('app', 'fio'),
            'companyName' => yii::t('app', 'companyName'),
            'email' => yii::t('app', 'email'),
            'mobilePhone' => yii::t('app', 'mobilePhone'),
            'workPhone' => yii::t('app', 'workPhone'),
            'password' => yii::t('app', 'password'),
            'password_repeat' => yii::t('app', 'password_repeat'),
            'using_rules' => yii::t('app', 'using_rules'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup() {
        if ($this->validate()) {
            $user = new User();
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();

            $profile = new UserProfile();
            $profile->fio = $this->fio;
            $profile->company_name = $this->companyName;
            $profile->mobile_phone = $this->mobilePhone;
            $profile->work_phone = $this->workPhone;
            $profile->client_type = UserProfile::CLIENT_TYPE_LEG;

            if ($user->validate() && $profile->validate()) {
                $user->save();
                $profile->id = $user->id;
                $profile->save();
                return $user;
            }
        }

        return null;
    }

}
