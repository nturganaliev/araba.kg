<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "comments".
 *
 * @property string $id
 * @property string $car_id
 * @property integer $user_id
 * @property string $message
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class Comment extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['car_id', 'message', 'user_id'], 'required'],
            [['car_id', 'user_id'], 'integer'],
            [['message'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'car_id' => Yii::t('app', 'Car ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'message' => Yii::t('app', 'Сообщение'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ];
    }

    public function getOwner() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getCar() {
        return $this->hasOne(Car::className(), ['id' => 'car_id']);
    }

}
