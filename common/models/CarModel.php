<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "car_models".
 *
 * @property integer $id
 * @property integer $marka_id
 * @property integer $seria
 * @property boolean $is_seria
 * @property string $name
 * @property integer $created_by
 * @property integer $updated_by
 */
class CarModel extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'car_models';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['marka_id', 'name'], 'required'],
            [['marka_id', 'seria'], 'integer'],
            [['is_seria'], 'boolean'],
            [['name'], 'string', 'max' => 30]
        ];
    }

    public function behaviors() {
        return [
            \yii\behaviors\BlameableBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'marka_id' => Yii::t('app', 'Marka ID'),
            'seria' => Yii::t('app', 'Seria'),
            'is_seria' => Yii::t('app', 'Is Seria'),
            'name' => Yii::t('app', 'Name'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public static function findAllMarkasSeries($markaId) {
        return CarModel::find()
                ->where(['is_seria' => true, 'marka_id' => $markaId])
                ->asArray()
                ->all();
    }

    public function getMarka() {
        return $this->hasOne(Marka::className(), ['id' => 'marka_id']);
    }

    public function getSeriarelation() {
        return $this->hasOne(CarModel::className(), ['id' => 'seria']);
    }

    public function getSeriaName() {
        if ($this->seria == NULL)
            return '';
        else
            return $this->seriarelation->name;
    }

    public static function findMergedNames($marka = NULL) {
        $result = [];

        $models = CarModel::find()
            ->where(['seria' => NULL])
            ->orderBy('name')
            ->all();

        if ($marka !== null) {
            $models = CarModel::find()
                ->where(['seria' => NULL, 'marka_id' => $marka])
                ->orderBy('name')
                ->all();
        }

        foreach ($models as $model) {
            $result[] = ['id' => $model->id, 'name' => $model->getTname()];
            if ($model->is_seria) {
                $childs = $model->childModels;
                foreach ($childs as $child) {
                    $result[] = ['id' => $child->id, 'name' => "-   $child->name"];
                }
            }
        }

        return $result;
    }

    public function getChildModels() {
        return $this->hasMany(CarModel::className(), ['seria' => 'id']);
    }

    public function getTname() {
        return Yii::t('value', trim($this->name));
    }

}
