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
 * @property integer $kuzov_id
 * @property integer $privod_id
 * @property integer $transmission_id
 * @property integer $engine_id
 * @property double $engine_displacement
 * @property integer $color_id
 * @property integer $state_id
 * @property integer $region_id
 * @property integer $moto_type_id
 * @property integer $sq_category_id
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
class Car extends \yii\db\ActiveRecord {

    const CAR_TYPE_AUTOMOBILE = 1;
    const CAR_TYPE_LORRY = 2;
    const CAR_TYPE_BUS = 3;
    const CAR_TYPE_SPECIAL_EQUIPMENT = 4;
    const CAR_TYPE_MOTOCYCLE = 5;
    const CAR_TYPE_RENT = true;
    const CAR_TYPE_NOT_RENT = false;

    public $completeSets = [];
    public $_oldCompleteSets = [];
    public $images;
    public $hasImages;

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
            [['type_id', 'moto_type_id', 'sq_category_id', 'marka_id', 'model_id', 'wheel_id', 'privod_id', 'transmission_id', 'engine_id', 'engine_displacement', 'color_id', 'state_id', 'region_id', 'issue_date', 'run_length', 'price'], 'required'],
            [['issue_date', 'type_id', 'moto_type_id', 'sq_category_id', 'marka_id', 'model_id', 'wheel_id', 'kuzov_id', 'privod_id', 'transmission_id', 'engine_id', 'color_id', 'state_id', 'region_id', 'run_length'], 'integer'],
            [['engine_displacement', 'price', 'rent_price'], 'number'],
            [['premium_date'], 'safe'],
            [['description'], 'string'],
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
                'safe' => true
            ],
        ];
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
            'wheel_id' => Yii::t('app', 'Wheel ID'),
            'kuzov_id' => Yii::t('app', 'Kuzov ID'),
            'privod_id' => Yii::t('app', 'Privod ID'),
            'transmission_id' => Yii::t('app', 'Transmission ID'),
            'engine_id' => Yii::t('app', 'Engine ID'),
            'engine_displacement' => Yii::t('app', 'Engine Displacement'),
            'color_id' => Yii::t('app', 'Color ID'),
            'state_id' => Yii::t('app', 'State ID'),
            'region_id' => Yii::t('app', 'Region ID'),
            'moto_type_id' => Yii::t('app', 'Moto Type ID'),
            'sq_category_id' => Yii::t('app', 'SQ Category ID'),
            'price' => Yii::t('app', 'Price'),
            'issue_date' => Yii::t('app', 'Issue Date'),
            'run_length' => Yii::t('app', 'Run Length'),
            'description' => Yii::t('app', 'Description'),
            'premium_date' => Yii::t('app', 'Premium Date'),
            'loading_capacity' => Yii::t('app', 'Loading capacity'),
            'rent' => Yii::t('app', 'Rent'),
            'rent_price' => Yii::t('app', 'Rent Price'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'model_name' => Yii::t('app', 'Model ID'),
        ];
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ];
    }

    public function getFullName() {
        return mb_strtolower("{$this->issue_date}" . ($this->wheel ? ", ". $this->wheel->tname . " ". Yii::t('value', 'руль') : " " ) . ", {$this->transmission->tname}, {$this->engine->tname}, {$this->privod->tname}, {$this->color->tname}, " . ($this->kuzov ? $this->kuzov->tname . ", " : " " ) .
            Yii::t('value', 'condition') . " {$this->state->tname}", 'UTF-8');
    }

    public function getKuzov() {
        return $this->hasOne(Kuzov::className(), ['id' => 'kuzov_id']);
    }

    public function getWheel() {
        return $this->hasOne(Wheel::className(), ['id' => 'wheel_id']);
    }

    public function getEngine() {
        return $this->hasOne(Engine::className(), ['id' => 'engine_id']);
    }

    public function getColor() {
        return $this->hasOne(Color::className(), ['id' => 'color_id']);
    }

    public function getPrivod() {
        return $this->hasOne(Privod::className(), ['id' => 'privod_id']);
    }

    public function getState() {
        return $this->hasOne(State::className(), ['id' => 'state_id']);
    }

    public function getRegion() {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    public function getTransmission() {
        return $this->hasOne(Transmission::className(), ['id' => 'transmission_id']);
    }

    public function getMarka() {
        return $this->hasOne(Marka::className(), ['id' => 'marka_id']);
    }

    public function getSqCategory() {
        return $this->hasOne(SqCategory::className(), ['id' => 'sq_category_id']);
    }

    public function getMotoType() {
        return $this->hasOne(MotoType::className(), ['id' => 'moto_type_id']);
    }

    public function getCarModel() {
        return $this->hasOne(CarModel::className(), ['id' => 'model_id']);
    }

    public function getCarType() {
        return $this->hasOne(CarType::className(), ['id' => 'type_id']);
    }

    public function getOwner() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUploadedImages() {
        return $this->hasMany(Photo::className(), ['car_id' => 'id']);
    }

    public function getMainImagePath() {
        if ($image = Photo::find()->where(['car_id' => $this->id, 'is_main' => true])->one())
            return \Yii::getAlias('@adv_upload_url') . '/' . $image->fullFilename;;

        $images = $this->uploadedImages;
        if (count($images) > 0) {
            return \Yii::getAlias('@adv_upload_url') . '/' . $images[0]->fullFilename;
        } else {
            return \Yii::getAlias('@adv_upload_url') . '/' . 'default_dummy.gif';
        }
    }

    public function getMainImageUrl() {
        if ($image = Photo::find()->where(['car_id' => $this->id, 'is_main' => true])->one())
            return '/thumbs/' . $image->fullFilename;

        $images = $this->uploadedImages;
        if (count($images) > 0) {
            return '/thumbs/' . $images[0]->fullFilename;
        } else {
            return '/thumbs/' . 'default_dummy.gif';
        }
    }

    public function getDefaultImagePath() {
        return '/thumbs/default_dummy.gif';
    }

    public function getDefaultImageUrl() {
        return \Yii::getAlias('@adv_upload_url') . '/' . 'default_dummy.gif';
    }

    public function getMainImage() {
        return Photo::find()->where(['car_id' => $this->id, 'is_main' => true])->one();
    }

    public function getSets() {
        return $this->hasMany(CompleteSet::className(), ['id' => 'complete_set_id'])
                ->viaTable('cars_complete_sets', ['car_id' => 'id'])->orderBy('name ASC');
    }

    public function getOrderedSets() {
        $models = $this->hasMany(CompleteSet::className(), ['id' => 'complete_set_id'])
                ->viaTable('cars_complete_sets', ['car_id' => 'id'])->all();
        $result = [];
        foreach ($models as $model) {
            $result[$model->tname] = $model;
        }
        ksort($result);
        $models = [];
        foreach ($result as $key => $value) {
            $models[] = $value;
        }
        return $models;
    }

    public function afterFind() {
        foreach ($this->sets as $set) {
            $this->_oldCompleteSets[] = $set->id;
            $this->completeSets[] = $set->id;
        }
        parent::afterFind();
    }

    public function getPremiums() {
        return $this->hasMany(PremiumLog::className(), [
                'car_id' => 'id'
        ]);
    }

    public static function getYears($order = true) {
        if ($order) {
            $years = [];
            for ($i = 1945; $i <= 2015; $i++)
                $years[$i] = $i;
            return $years;
        } else {
            $years = [];
            for ($i = 2015; $i >= 1945; $i--)
                $years[$i] = $i;
            return $years;
        }
    }

    public function afterSave($insert, $changedAttributes) {
        if ($insert && !($this->completeSets != NULL && empty($this->completeSets))) {
            $sets = [];
            foreach ($this->completeSets as $value) {
                $sets[] = [$this->id, $value];
            }
            if (count($sets) > 0) {
                Yii::$app->db->createCommand()->batchInsert('cars_complete_sets', ['car_id', 'complete_set_id'], $sets)->execute();
            }
        } else {
            $sets = [];

            $newSets = array_diff($this->completeSets, $this->_oldCompleteSets);
            $oldSets = array_diff($this->_oldCompleteSets, $this->completeSets);

            foreach ($newSets as $value) {
                $sets[] = [$this->id, $value];
            }


            if (count($sets) > 0) {
                Yii::$app->db->createCommand()->batchInsert('cars_complete_sets', ['car_id', 'complete_set_id'], $sets)->execute();
            }

            if (count($oldSets) > 0) {
                Yii::$app->db
                    ->createCommand()
                    ->delete('cars_complete_sets', ['car_id' => $this->id, 'complete_set_id' => $oldSets])
                    ->execute();
            }
        }

        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeDelete() {
        Yii::$app->db->createCommand()
            ->delete('cars_complete_sets', ['car_id' => $this->id])
            ->execute();

        return parent::beforeDelete();
    }

    public static function getHighRated() {
        $query = Car::find()
            ->where(['>=', 'premium_date', date('Y-m-d H:i:s', strtotime('-14 days'))])
            ->orderBy(['premium_date' => SORT_DESC])
            ->limit(35);
        $firstResult = $query->all();
        return $firstResult;

//        $query = Car::find()
//            ->where('premium_date is not null and premium_date>CURRENT_TIMESTAMP', [])
//            ->limit(35);
//        $firstResult = $query->all();
//        if (count($firstResult) < 35) {
//            $query2 = Car::find()
//                ->where('(premium_date is null) OR (premium_date<CURRENT_TIMESTAMP)', [])
//                ->limit(35)
//                ->orderBy(['updated_at' => SORT_DESC]);
//            $secondResult = $query2->all();
//            $count = 35 - count($firstResult);
//            for ($i = 0; $i < $count && $i < count($secondResult); $i++) {
//                $firstResult[] = $secondResult[$i];
//            }
//        }
//        return $firstResult;
    }

    public function getName() {
        return "{$this->marka->name} {$this->carModel->name}";
    }

    public function getTname() {
        return "{$this->marka->tname} {$this->carModel->tname}";
    }

    public static function getPriceList() {
        $list = [];
        for ($i = 100000; $i <= 1000000; $i = $i + 100000) {
            $list[$i] = number_format($i);
        }
        for ($i = 1200000; $i <= 2000000; $i = $i + 200000) {
            $list[$i] = number_format($i);
        }
        for ($i = 2500000; $i <= 5000000; $i = $i + 500000) {
            $list[$i] = number_format($i);
        }
        for ($i = 6000000; $i <= 10000000; $i = $i + 1000000) {
            $list[$i] = number_format($i);
        }
        for ($i = 10000000; $i <= 40000000; $i = $i * 2) {
            $list[$i] = number_format($i);
        }
        return $list;
    }

    public function similar() {
        return Car::find()
                ->where(['model_id' => $this->model_id])
                ->andWhere(['<>', 'id', $this->id])
                ->orderBy(['premium_date' => 'desc'])
                ->limit(7)
                ->all();
    }

    public function isArchive() {
        $diff = time() - strtotime($this->premium_date);
        if ($diff > (60 * 60 * 24 * 14))
            return true;
        else
            return false;
    }

    public function isPremium() {
        if (strtotime($this->premium_date) >= time())
            return true;
        else
            return false;
    }

    public function getBeginAndEndDate() {
        $premiumLogs = $this->getPremiums()->all();
        $lastLog = $premiumLogs[count($premiumLogs) - 1];
        return date('d/m/Y h:i', strtotime($lastLog->premium_begin)) . ' - ' . date('d/m/Y h:i', strtotime($lastLog->premium_end));
    }

    public function getComments() {
        return $this->hasMany(Comment::className(), ['car_id' => 'id']);
    }

}
