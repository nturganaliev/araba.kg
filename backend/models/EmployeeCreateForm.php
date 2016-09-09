<?php

namespace backend\models;

use backend\models\Employee;
use backend\models\EmployeeProfile;
use backend\models\Office;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class EmployeeCreateForm extends Model {

    public $fio;
    public $office;
    public $email;
    public $phone;
    public $password;
    public $password_repeat;
    public $role;
    public $status;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['fio', 'email', 'phone', 'password', 'office', 'role', 'status'], 'required'],
            [['fio', 'email', 'phone', 'password'], 'filter', 'filter' => 'trim'],
            ['fio', 'string', 'min' => 4, 'max' => 100],
            ['phone', 'string', 'min' => 6, 'max' => 20],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\backend\models\Employee', 'message' => 'This email address has already been taken.'],
            ['password', 'string', 'min' => 6, 'max' => 15],
            ['password_repeat', 'safe'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['status', 'in', 'range' => [
                    Employee::STATUS_DELETED,
                    Employee::STATUS_ACTIVE,
                ]],
            ['role', 'in', 'range' => [
                    EmployeeProfile::ROLE_ADMINISTRATOR,
                    EmployeeProfile::ROLE_CASHIER,
                    EmployeeProfile::ROLE_MAIN_CASHIER,
                ]],
            ['office', 'exist', 'targetClass' => Office::className(), 'targetAttribute' => 'id'],
        ];
    }

    public function attributeLabels() {
        return [
            'fio' => yii::t('app', 'Fio'),
            'email' => yii::t('app', 'Email'),
            'phone' => yii::t('app', 'Phone'),
            'password' => yii::t('app', 'Password'),
            'password_repeat' => yii::t('app', 'Password_repeat'),
            'role' => yii::t('app', 'Role'),
            'status' => yii::t('app', 'Status'),
            'office' => yii::t('app', 'Office'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return Employee|null the saved model or null if saving fails
     */
    public function create() {
        if ($this->validate()) {
            $user = new Employee();
            $user->email = $this->email;
            $user->status = $this->status;
            $user->setPassword($this->password);
            $user->generateAuthKey();

            $profile = new EmployeeProfile();
            $profile->fio = $this->fio;
            $profile->phone = $this->phone;
            $profile->role = $this->role;
            $profile->office_id = $this->office;

            if ($user->validate()) {
                $user->save();
                $profile->id = $user->id;
                $profile->save();
                return $user;
            }
        }

        return null;
    }

}
