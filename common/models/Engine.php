<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "engines".
 *
 * @property integer $id
 * @property integer $name
 * @property integer $created_by
 * @property integer $updated_by
 */
class Engine extends \yii\db\ActiveRecord {

    public function behaviors() {
        return [
            BlameableBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'engines';
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
                ->viaTable('engines_car_types', ['engine_id' => 'id']);
    }

    public static function getByCarType($type = null) {
        if ($type === null) {
            return Engine::find()->all();
        } else {
            return Engine::find()
                    ->joinWith('carTypes')
                    ->where(['car_types.id' => $type])
                    ->all();
        }
    }

}
