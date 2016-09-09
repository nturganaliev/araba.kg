<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $fio
 * @property integer $office_id
 * @property string $phone
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $updated_by
 */
class EmployeeProfile extends ActiveRecord {

    const ROLE_ADMINISTRATOR = 0;
    const ROLE_MAIN_CASHIER = 1;
    const ROLE_CASHIER = 2;

    public $email;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'employee_profiles';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className()
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['fio', 'phone', 'user_id', 'office_id', 'role'], 'required'],
            [['fio', 'phone'], 'filter', 'filter' => 'trim'],
            ['fio', 'string', 'min' => 4, 'max' => 100],
            ['phone', 'string', 'min' => 6, 'max' => 20],
//            ['user_id', 'unique', 'targetClass' => '\backend\models\User', 'message' => 'This email address has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    public static function getRolesOptions() {
        return [
            self::ROLE_ADMINISTRATOR => Yii::t('app', 'Administrator'),
            self::ROLE_MAIN_CASHIER => Yii::t('app', 'Main cashier'),
            self::ROLE_CASHIER => Yii::t('app', 'Cashier'),
        ];
    }

    public function getRoleText() {
        $roleOptions = self::getRolesOptions();
        return (isset($roleOptions[$this->role]) ? $roleOptions[$this->role] : Yii::t('app', 'Unknown role'));
    }

    public function getOffice() {
        // User has_one UserProfile via Customer.id -> customer_id
        return $this->hasOne(Office::className(), ['id' => 'office_id']);
    }

    public function getUser() {
        // User has_one UserProfile via Customer.id -> customer_id
        return $this->hasOne(Employee::className(), ['id' => 'id']);
    }

}
