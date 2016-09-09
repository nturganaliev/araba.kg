<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "mposts".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $lang
 * @property string $title
 * @property string $body
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Posts $post
 */
class Mpost extends \yii\db\ActiveRecord {

    const LANG_EN = 'en';
    const LANG_RU = 'ru';
    const LANG_KY = 'ky';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'mposts';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['post_id', 'lang'], 'required'],
            [['post_id'], 'integer'],
            [['lang', 'title'], 'string', 'max' => 255],
            [['body'], 'string', 'max' => 2000],
            [['post_id', 'lang'], 'unique', 'targetAttribute' => ['post_id', 'lang'], 'message' => 'The combination of Post ID and Lang has already been taken.']
        ];
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'post_id' => Yii::t('app', 'Post ID'),
            'lang' => Yii::t('app', 'Lang'),
            'title' => Yii::t('app', 'Title'),
            'body' => Yii::t('app', 'Body'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost() {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @inheritdoc
     * @return MpostQuery the active query used by this AR class.
     */
    public static function find() {
        return new MpostQuery(get_called_class());
    }

    public static function getLangOptions() {
        return [
            self::LANG_EN => Yii::t('app', 'English'),
            self::LANG_RU => Yii::t('app', 'Russian'),
            self::LANG_KY => Yii::t('app', 'Kyrgyz'),
        ];
    }

}
