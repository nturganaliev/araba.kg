<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "banners".
 *
 * @property string $id
 * @property string $page
 * @property integer $image
 * @property string $url
 * @property integer $position
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class Banner extends ActiveRecord {

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const PAGE_MAIN = 0;
    const PAGE_SEARCH_RESULT = 1;
    const PAGE_CAR_VIEW = 2;
    const PAGE_ENTER_REGISTER = 3;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'banners';
    }

    public static function find() {
        return new BannerActiveQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['page', 'status'], 'required'],
            [['page', 'status'], 'integer'],
            ['position', 'default', 'value' => function() {
                    $max = Banner::find()
                        ->where('page = :page', [':page' => $this->page])
                        ->max('position');
                    return $max + 1;
                }],
                [['url'], 'string', 'max' => 255],
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

        public function behaviors() {
            return [
                TimestampBehavior::className(),
                BlameableBehavior::className(),
            ];
        }

        public static function getStatusOptions() {
            return [
                self::STATUS_ACTIVE => 'Активный',
                self::STATUS_INACTIVE => 'Неактивный'
            ];
        }

        public function getStatusText() {
            $statusOptions = self::getStatusOptions();
            return (isset($statusOptions[$this->status]) ? $statusOptions[$this->status] : 'Неизвестный статус');
        }

        public static function getPageOptions() {
            return [
                self::PAGE_MAIN => 'Главная страница',
                self::PAGE_SEARCH_RESULT => 'Страница результата поиска',
                self::PAGE_CAR_VIEW => 'Страница объявления',
                self::PAGE_ENTER_REGISTER => 'Страница входа в систему',
            ];
        }

        public function getPageText() {
            $pageOptions = self::getPageOptions();
            return (isset($pageOptions[$this->page]) ? $pageOptions[$this->page] : 'Неизвестный статус');
        }

        public function getFilePath() {
            return '/uploads/' . $this->image;
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
            return [
                'id' => Yii::t('app', 'ID'),
                'page' => Yii::t('app', 'Page'),
                'image' => Yii::t('app', 'Image'),
                'url' => Yii::t('app', 'Url'),
                'order' => Yii::t('app', 'Order'),
                'status' => Yii::t('app', 'Status'),
                'created_by' => Yii::t('app', 'Created By'),
                'updated_by' => Yii::t('app', 'Updated By'),
                'created_at' => Yii::t('app', 'Created At'),
                'updated_at' => Yii::t('app', 'Updated At'),
            ];
        }

    }
