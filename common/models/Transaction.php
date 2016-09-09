<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use backend\models\Employee;
use backend\models\EmployeeProfile;

/**
 * This is the model class for table "transactions".
 *
 * @property integer $id
 * @property integer $client_id
 * @property integer $employee_id
 * @property string $amount
 * @property boolean $type
 * @property string $description
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class Transaction extends \yii\db\ActiveRecord {

    const OPERATION_TYPE_PAYMENT = 0;
    const OPERATION_TYPE_REFILL = 1;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'transactions';
    }

    public static function find() {
        return new TransactionQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['client_id', 'employee_id', 'amount', 'type'], 'required'],
            [['client_id', 'employee_id'], 'integer'],
            ['amount', 'number', 'min' => 10],
            [
                'client_id',
                'exist',
                'targetClass' => User::className(),
                'targetAttribute' => 'id',
                'skipOnEmpty' => false,
                'skipOnError' => false
            ],
            [
                'employee_id',
                'exist',
                'targetClass' => Employee::className(),
                'targetAttribute' => 'id',
                'skipOnEmpty' => false,
                'skipOnError' => false
            ],
            ['type', 'in', 'range' => [self::OPERATION_TYPE_PAYMENT, self::OPERATION_TYPE_REFILL]],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'client_id' => Yii::t('app', 'Client ID'),
            'employee_id' => Yii::t('app', 'Employee ID'),
            'amount' => Yii::t('app', 'Amount'),
            'type' => Yii::t('app', 'Type'),
            'description' => Yii::t('app', 'Description'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className()
        ];
    }

    public static function getOperationOptions() {
        return [
            self::OPERATION_TYPE_PAYMENT => Yii::t('app', 'Payment for premium'),
            self::OPERATION_TYPE_REFILL => Yii::t('app', 'Refill the balance'),
        ];
    }

    public function getOperationText() {
        $operationOptions = self::getOperationOptions();
        return isset($operationOptions[$this->type]) ? $operationOptions[$this->type] : Yii::t('app', 'Unknown operation');
    }

    public function getClient() {
        return $this->hasOne(UserProfile::className(), ['id' => 'client_id']);
    }

    public function getCashier() {
        return $this->hasOne(EmployeeProfile::className(), ['user_id' => 'employee_id']);
    }

}
