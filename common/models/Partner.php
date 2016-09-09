<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "partners".
 *
 * @property integer $id
 * @property string $title
 * @property integer $image
 * @property string $url
 * @property string $description
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class Partner extends \yii\db\ActiveRecord {

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'partners';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'url', 'status'], 'required'],
            [['status'], 'integer'],
            [['title', 'url', 'description'], 'string', 'max' => 255],
            [['image'],
                'file',
                'skipOnEmpty' => false,
                'on' => 'create'
//                'extensions' => 'jpg',
//                'mimeTypes' => 'image/jpeg',
//                'maxFiles' => 10
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'image' => Yii::t('app', 'Image'),
            'url' => Yii::t('app', 'Url'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className()
        ];
    }

    public function getFilePath() {
        return '/uploads/' . $this->image;
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
