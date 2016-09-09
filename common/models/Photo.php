<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "uploads".
 *
 * @property string $id
 * @property string $car_id
 * @property string $filename
 * @property string $extension
 */
class Photo extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['car_id', 'filename'], 'required'],
            [['car_id'], 'integer'],
            [['filename', 'extension'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'car_id' => Yii::t('app', 'Car ID'),
            'filename' => Yii::t('app', 'Filename'),
            'extension' => Yii::t('app', 'Extension'),
        ];
    }

    public function beforeDelete() {
        if (parent::beforeDelete()) {
            $filepath = \Yii::getAlias('@adv_upload_path') . "/{$this->filename}.{$this->extension}";
            unlink($filepath);
            return true;
        } else {
            return false;
        }
    }

    public function getFilePath() {
        return \Yii::getAlias('@adv_upload_url') . '/' . $this->fullFilename;
    }

    public function getFullFilename() {
        return "{$this->filename}.{$this->extension}";
    }

    public function getThumbFilePath() {
        return '/thumbs/' . $this->thumbFullFilename;
    }

    public function getThumbFullFilename() {
        return "{$this->filename}_thumb.{$this->extension}";
    }

    public function getLargeFilePath() {
        return '/thumbs/' . $this->largeFullFilename;
    }

    public function getLargeFullFilename() {
        return "{$this->filename}_large.{$this->extension}";
    }

    public function getMediumFilePath() {
        return '/thumbs/' . $this->mediumFullFilename;
    }

    public function getMediumFullFilename() {
        return "{$this->filename}_medium.{$this->extension}";
    }

}
