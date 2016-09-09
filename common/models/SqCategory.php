<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sq_categories".
 *
 * @property integer $id
 * @property string $name
 * @property integer $created_by
 * @property integer $updated_by
 */
class SqCategory extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'sq_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 32]
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
            'name' => Yii::t('app', 'Name'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public function getTname() {
        return Yii::t('value', $this->name);
    }

}
