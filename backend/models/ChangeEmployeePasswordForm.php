<?php

namespace backend\models;

use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class ChangeEmployeePasswordForm extends Model {

    public $newPassword;
    public $repeatPassword;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['newPassword', 'repeatPassword'], 'required'],
            [['newPassword', 'repeatPassword'], 'filter', 'filter' => 'trim'],
            ['newPassword', 'string', 'min' => 6, 'max' => 15],
            ['repeatPassword', 'safe'],
            ['repeatPassword', 'compare', 'compareAttribute' => 'newPassword'],
        ];
    }

    public function attributeLabels() {
        return [
            'newPassword' => yii::t('app', 'New Password'),
            'repeatPassword' => yii::t('app', 'Repeat Password'),
        ];
    }

}
