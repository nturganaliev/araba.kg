<?php

namespace common\models;

use Yii;
use dosamigos\taggable\Taggable;

/**
 * This is the model class for table "car_types".
 *
 * @property integer $id
 * @property string $name
 * @property integer $created_by
 * @property integer $updated_by
 */
class CarType extends \yii\db\ActiveRecord {

    public $tagColors;
    public $tagWheels;
    public $tagTransmissions;
    public $tagKuzovs;
    public $tagPrivods;
    public $tagCompleteSets;
    public $tagEngines;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'car_types';
    }

    public function behaviors() {
        return [
            'colorsTags' => [
                'class' => Taggable::className(),
                'name' => 'name',
                'attribute' => 'tagColors',
                'frequency' => 'frequency',
                'relation' => 'colors',
            ],
            'wheelsTags' => [
                'class' => Taggable::className(),
                'name' => 'name',
                'attribute' => 'tagWheels',
                'frequency' => 'frequency',
                'relation' => 'wheels',
            ],
            'transmissionsTags' => [
                'class' => Taggable::className(),
                'name' => 'name',
                'attribute' => 'tagTransmissions',
                'frequency' => 'frequency',
                'relation' => 'transmissions',
            ],
            'kuzovsTags' => [
                'class' => Taggable::className(),
                'name' => 'name',
                'attribute' => 'tagKuzovs',
                'frequency' => 'frequency',
                'relation' => 'kuzovs',
            ],
            'privodsTags' => [
                'class' => Taggable::className(),
                'name' => 'name',
                'attribute' => 'tagPrivods',
                'frequency' => 'frequency',
                'relation' => 'privods',
            ],
            'enginesTags' => [
                'class' => Taggable::className(),
                'name' => 'name',
                'attribute' => 'tagEngines',
                'frequency' => 'frequency',
                'relation' => 'engines',
            ],
            'completeSetsTags' => [
                'class' => Taggable::className(),
                'name' => 'name',
                'attribute' => 'tagCompleteSets',
                'frequency' => 'frequency',
                'relation' => 'completeSets',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'created_by', 'updated_by'], 'required'],
            [['created_by', 'updated_by'], 'integer'],
            [['tagColors'], 'safe'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    public function afterFind() {
        parent::afterFind();
        $this->tagColors = $this->getBehavior('colorsTags')->__get('name');
        $this->tagEngines = $this->getBehavior('enginesTags')->__get('name');
        $this->tagWheels = $this->getBehavior('wheelsTags')->__get('name');
        $this->tagKuzovs = $this->getBehavior('kuzovsTags')->__get('name');
        $this->tagPrivods = $this->getBehavior('privodsTags')->__get('name');
        $this->tagTransmissions = $this->getBehavior('transmissionsTags')->__get('name');
        $this->tagCompleteSets = $this->getBehavior('completeSetsTags')->__get('name');
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

    public function getColors() {
        return $this->hasMany(Color::className(), ['id' => 'color_id'])
                ->viaTable('colors_car_types', ['car_type_id' => 'id']);
    }

    public function getWheels() {
        return $this->hasMany(Wheel::className(), ['id' => 'wheel_id'])
                ->viaTable('wheels_car_types', ['car_type_id' => 'id']);
    }

    public function getKuzovs() {
        return $this->hasMany(Kuzov::className(), ['id' => 'kuzov_id'])
                ->viaTable('kuzovs_car_types', ['car_type_id' => 'id']);
    }

    public function getPrivods() {
        return $this->hasMany(Privod::className(), ['id' => 'privod_id'])
                ->viaTable('privods_car_types', ['car_type_id' => 'id']);
    }

    public function getEngines() {
        return $this->hasMany(Engine::className(), ['id' => 'engine_id'])
                ->viaTable('engines_car_types', ['car_type_id' => 'id']);
    }

    public function getTransmissions() {
        return $this->hasMany(Transmission::className(), ['id' => 'transmission_id'])
                ->viaTable('transmissions_car_types', ['car_type_id' => 'id']);
    }

    public function getCompleteSets() {
        return $this->hasMany(CompleteSet::className(), ['id' => 'complete_set_id'])
                ->viaTable('complete_sets_car_types', ['car_type_id' => 'id']);
    }

    public static function getColorsByType($carType = NULL) {
        if (isset($carType)) {
            return Color::find()
                    ->innerJoin('colors_car_types tmp', 'tmp.color_id=colors.id')
                    ->where('tmp.car_type_id=:carTypeId', [':carTypeId' => $carType])
                    ->all();
        } else {
            return null;
        }
    }

    public static function getCompleteSetsByType($carType = NULL) {
        if (isset($carType)) {
            $sets = CompleteSet::find()
                ->innerJoin('complete_sets_car_types tmp', 'tmp.complete_set_id=complete_sets.id')
                ->where('tmp.car_type_id=:carTypeId', [':carTypeId' => $carType])
                ->all();
            return $sets;
        } else {
            return null;
        }
    }

    public static function getTransmissionsByType($carType = NULL) {
        if (isset($carType)) {
            return Transmission::find()
                    ->innerJoin('transmissions_car_types tmp', 'tmp.transmission_id=transmissions.id')
                    ->where('tmp.car_type_id=:carTypeId', [':carTypeId' => $carType])
                    ->all();
        } else {
            return null;
        }
    }

    public static function getWheelsByType($carType = NULL) {
        if (isset($carType)) {
            return Wheel::find()
                    ->innerJoin('wheels_car_types tmp', 'tmp.wheel_id=wheels.id')
                    ->where('tmp.car_type_id=:carTypeId', [':carTypeId' => $carType])
                    ->all();
        } else {
            return null;
        }
    }

    public static function getPrivodsByType($carType = NULL) {
        if (isset($carType)) {
            return Privod::find()
                    ->innerJoin('privods_car_types tmp', 'tmp.privod_id=privods.id')
                    ->where('tmp.car_type_id=:carTypeId', [':carTypeId' => $carType])
                    ->all();
        } else {
            return null;
        }
    }

    public static function getKuzovsByType($carType = NULL) {
        if (isset($carType)) {
            return Kuzov::find()
                    ->innerJoin('kuzovs_car_types tmp', 'tmp.kuzov_id=kuzovs.id')
                    ->where('tmp.car_type_id=:carTypeId', [':carTypeId' => $carType])
                    ->all();
        } else {
            return null;
        }
    }

    public static function getEnginesByType($carType = NULL) {
        if (isset($carType)) {
            return Engine::find()
                    ->innerJoin('engines_car_types tmp', 'tmp.engine_id=engines.id')
                    ->where('tmp.car_type_id=:carTypeId', [':carTypeId' => $carType])
                    ->all();
        } else {
            return null;
        }
    }

}
