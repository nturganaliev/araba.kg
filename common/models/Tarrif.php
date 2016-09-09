<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tarrifs".
 *
 * @property integer $id
 * @property string $title
 * @property integer $day_count
 * @property string $price
 * @property string $description
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class Tarrif extends \yii\db\ActiveRecord {

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tarrifs';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'day_count', 'price', 'status'], 'required'],
            [['day_count', 'status'], 'integer'],
            [['price'], 'number'],
            ['status', 'in', 'range' => [self::STATUS_DELETED, self::STATUS_ACTIVE]],
            [['title', 'description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'day_count' => Yii::t('app', 'Day Count'),
            'price' => Yii::t('app', 'Price'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public static function find() {
        return new TarrifQuery(get_called_class());
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className()
        ];
    }

    public static function getStatusOptions() {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'Active'),
            self::STATUS_DELETED => Yii::t('app', 'Inactive'),
        ];
    }

    public function getStatusText() {
        $statusOptions = self::getStatusOptions();
        return (isset($statusOptions[$this->status]) ? $statusOptions[$this->status] : Yii::t('app', 'Unknown status'));
    }

}
