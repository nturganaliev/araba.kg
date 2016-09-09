<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "regions".
 *
 * @property integer $id
 * @property integer $name
 * @property integer $created_by
 * @property integer $updated_by
 */
class Region extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'regions';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'created_by', 'updated_by'], 'required'],
            [['name', 'created_by', 'updated_by'], 'integer']
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

}
