<?php

namespace frontend\modules\account\models;

use common\models\User;
use common\models\UserProfile;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class ChangePasswordForm extends Model {

    public $oldPassword;
    public $newPassword;
    public $repeatPassword;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['oldPassword', 'newPassword', 'repeatPassword'], 'required'],
            [['oldPassword', 'newPassword', 'repeatPassword'], 'filter', 'filter' => 'trim'],
            ['oldPassword', 'string', 'min' => 6, 'max' => 15],
            ['newPassword', 'string', 'min' => 6, 'max' => 15],
            ['repeatPassword', 'safe'],
            ['repeatPassword', 'compare', 'compareAttribute' => 'newPassword'],
        ];
    }

    public function attributeLabels() {
        return [
            'oldPassword' => yii::t('app', 'Old Password'),
            'newPassword' => yii::t('app', 'New Password'),
            'repeatPassword' => yii::t('app', 'Repeat Password'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function save() {
        if ($this->validate()) {
            $user = \yii::$app->user->identity;
            $user->setPassword($this->newPassword);
            if ($user->save())
                return true;
        }
        return false;
    }

}
