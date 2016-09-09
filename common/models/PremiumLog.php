<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "premiums_logs".
 *
 * @property integer $id
 * @property string $car_id
 * @property integer $tarrif_id
 * @property string $premium_begin
 * @property string $premium_end
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class PremiumLog extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'premiums_logs';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['car_id', 'tarrif_id', 'premium_begin', 'premium_end'], 'required'],
            [['car_id', 'tarrif_id'], 'integer'],
            [['premium_begin', 'premium_end'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'car_id' => Yii::t('app', 'Car ID'),
            'tarrif_id' => Yii::t('app', 'Tarrif ID'),
            'premium_begin' => Yii::t('app', 'Premium Begin'),
            'premium_end' => Yii::t('app', 'Premium End'),
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

    /**
     * @inheritdoc
     * @return PremiumLogQuery the active query used by this AR class.
     */
    public static function find() {
        return new PremiumLogQuery(get_called_class());
    }

}
