<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "transmissions".
 *
 * @property integer $id
 * @property string $name
 * @property integer $created_by
 * @property integer $updated_by
 */
class Transmission extends \yii\db\ActiveRecord {

    public function behaviors() {
        return [
            BlameableBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'transmissions';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            ['frequency', 'safe'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public function getTname() {
        return Yii::t('value', $this->name);
    }

    public function getCarTypes() {
        return $this->hasMany(CarType::className(), ['id' => 'car_type_id'])
                ->viaTable('transmissions_car_types', ['transmission_id' => 'id']);
    }

    public static function getByCarType($type = null) {
        if ($type === null) {
            return Transmission::find()->all();
        } else {
            return Transmission::find()
                    ->joinWith('carTypes')
                    ->where(['car_types.id' => $type])
                    ->all();
        }
    }

}
