<?php

namespace frontend\modules\account\models;

use common\models\User;
use common\models\UserProfile;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class UserSetting extends Model {

    public $fio;
    public $companyName;
    public $mobilePhone;
    public $workPhone;
    public $email;
    public $type;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['fio', 'mobilePhone'], 'required'],
            [['fio', 'companyName', 'workPhone', 'mobilePhone'], 'required', 'on' => 'company'],
            [['companyName', 'workPhone', 'fio', 'mobilePhone'], 'filter', 'filter' => 'trim'],
            ['fio', 'string', 'min' => 4, 'max' => 100],
            ['companyName', 'string', 'min' => 4, 'max' => 150],
            ['mobilePhone', 'string', 'min' => 6, 'max' => 20],
            ['workPhone', 'string', 'min' => 5, 'max' => 20],
        ];
    }

    public function attributeLabels() {
        return [
            'fio' => yii::t('app', 'fio'),
            'companyName' => yii::t('app', 'companyName'),
            'email' => yii::t('app', 'email'),
            'mobilePhone' => yii::t('app', 'mobilePhone'),
            'workPhone' => yii::t('app', 'workPhone'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function save() {
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
