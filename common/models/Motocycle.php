<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "cars".
 *
 * @property string $id
 * @property integer $type_id
 * @property integer $marka_id
 * @property integer $model_id
 * @property integer $wheel_id
 * @property integer $privod_id
 * @property integer $transmission_id
 * @property integer $engine_id
 * @property double $engine_displacement
 * @property integer $color_id
 * @property integer $state_id
 * @property integer $region_id
 * @property string $price
 * @property string $issue_date
 * @property integer $run_length
 * @property string $description
 * @property string $premium_date
 * @property boolean $rent
 * @property string $rent_price
 * @property integer $created_by
 * @property integer $updated_by
 */
class Motocycle extends Car {

    public $model_name;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [
                [
                    'marka_id',
                    'model_id',
                    'privod_id',
                    'transmission_id',
                    'moto_type_id',
                    'engine_id',
                    'engine_displacement',
                    'color_id',
                    'state_id',
                    'region_id',
                    'issue_date',
                    'run_length',
                    'model_name',
                ], 'required'],
            [
                [
                    'issue_date',
                    'type_id',
                    'marka_id',
                    'model_id',
                    'privod_id',
                    'moto_type_id',
                    'transmission_id',
                    'engine_id',
                    'color_id',
                    'state_id',
                    'region_id',
                    'run_length'
                ], 'integer'],
            [
                [
                    'engine_displacement',
                    'price',
                    'rent_price'
                ], 'number'
            ],
            [['completeSets'], 'checkIsArray', 'skipOnEmpty' => false, 'skipOnError' => false],
            ['marka_id', 'in', 'range' => Marka::find()->motocycle()->select('id')->asArray()->column()],
            [
                [
                    'premium_date',
                    'completeSets',
                ], 'safe'],
            [['description'], 'string', 'max' => 500],
            [['model_name'], 'string', 'max' => 30],
            ['model_name', 'trim'],
            [['rent'], 'boolean'],
            [['images'],
                'file',
                'skipOnEmpty' => true,
                'extensions' => ['jpg', 'png', 'gif'],
//                'mimeTypes' => 'image/jpeg',
                'maxFiles' => 10,
                'tooMany' => \Yii::t('app','Too many pictures uploaded. No more than 10'),
                'maxSize' => 1024 * 1024 * 4,
                'tooBig'=> \Yii::t('app','Not more than 4MB'),
            ],
        ];
    }

    // custom validator to check value for array
    public function checkIsArray($attribute, $params) {
        if (!is_array($this->$attribute)) {
            $this->addError('completeSets', 'completeSets is not array!');
        }

        $this->existCompleteSet($attribute, $params);
    }

    public function existCompleteSet($attribute, $params) {
        $query = (new \yii\db\Query())
            ->select('count(*)')
            ->from('complete_sets')
            ->where(['id' => $this->$attribute])
            ->scalar();
        if (count($this->$attribute) != $query) {
            $this->addError('completeSets', Yii::t('app', 'completeSets not all values exists!'));
        }
    }

    public function beforeSave($insert) {
        $this->type_id = Car::CAR_TYPE_MOTOCYCLE;
        return parent::beforeSave($insert);
    }

    public function afterFind() {
        $this->type_id = Car::CAR_TYPE_MOTOCYCLE;
        $this->model_name = $this->carModel->name;
        return parent::afterFind();
    }

}
