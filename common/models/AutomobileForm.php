<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cars".
 *
 * @property string $id
 * @property integer $type_id
 * @property integer $marka_id
 * @property integer $model_id
 * @property integer $wheel_id
 * @property integer $kuzov_id
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
class AutomobileForm extends \yii\db\ActiveRecord {

    const CAR_TYPE_AUTOMOBILE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'cars';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['marka_id', 'model_id', 'wheel_id', 'kuzov_id', 'privod_id', 'transmission_id', 'engine_id', 'engine_displacement', 'color_id', 'state_id', 'region_id', 'issue_date', 'run_length', 'created_by', 'updated_by'], 'required'],
            [['type_id', 'marka_id', 'model_id', 'wheel_id', 'kuzov_id', 'privod_id', 'transmission_id', 'engine_id', 'color_id', 'state_id', 'region_id', 'run_length', 'created_by', 'updated_by'], 'integer'],
            [['engine_displacement', 'price', 'rent_price'], 'number'],
            [['issue_date', 'premium_date'], 'safe'],
            [['description'], 'string'],
            [['rent'], 'boolean']
        ];
    }

    public function beforeValidate() {
        $this->type_id = Automobile::CAR_TYPE_AUTOMOBILE;
        parent::beforeValidate();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'type_id' => Yii::t('app', 'Type ID'),
            'marka_id' => Yii::t('app', 'Marka ID'),
            'model_id' => Yii::t('app', 'Model ID'),
            'model_name' => Yii::t('app', 'Model'),
            'wheel_id' => Yii::t('app', 'Wheel ID'),
            'kuzov_id' => Yii::t('app', 'Kuzov ID'),
            'privod_id' => Yii::t('app', 'Privod ID'),
            'transmission_id' => Yii::t('app', 'Transmission ID'),
            'engine_id' => Yii::t('app', 'Engine ID'),
            'engine_displacement' => Yii::t('app', 'Engine Displacement'),
            'color_id' => Yii::t('app', 'Color ID'),
            'state_id' => Yii::t('app', 'State ID'),
            'region_id' => Yii::t('app', 'Region ID'),
            'price' => Yii::t('app', 'Price'),
            'issue_date' => Yii::t('app', 'Issue Date'),
            'run_length' => Yii::t('app', 'Run Length'),
            'description' => Yii::t('app', 'Description'),
            'premium_date' => Yii::t('app', 'Premium Date'),
            'rent' => Yii::t('app', 'Rent'),
            'rent_price' => Yii::t('app', 'Rent Price'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

}
