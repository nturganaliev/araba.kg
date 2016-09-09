<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "markas".
 *
 * @property integer $id
 * @property integer $car_type_id
 * @property string $name
 * @property integer $created_by
 * @property integer $updated_by
 */
class Marka extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'markas';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['car_type_id', 'name'], 'required'],
            [['car_type_id'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'car_type_id' => Yii::t('app', 'Car Type'),
            'name' => Yii::t('app', 'Name'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public function behaviors() {
        return [
            BlameableBehavior::className(),
        ];
    }

    public function getCarType() {
        return $this->hasOne(CarType::className(), ['id' => 'car_type_id']);
    }

    public static function find() {
        return new MarkaQuery(get_called_class());
    }

    public function getTname() {
        return Yii::t('value', $this->name);
    }

}
