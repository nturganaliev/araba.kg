<?php

namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadForm extends Model {

    /**
     * @var UploadedFile file attribute
     */
    public $images;
    public $car_id;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            ['car_id', 'required'],
            ['car_id', 'integer'],
            ['car_id', 'exist', 'targetClass' => Car::className(), 'targetAttribute' => 'id', 'skipOnEmpty' => false, 'skipOnError' => false],
            [['images'],
                'file',
                'skipOnEmpty' => false,
                'extensions' => ['jpg', 'png', 'gif'],
//                'mimeTypes' => 'image/jpeg',
                'maxFiles' => 10,
                'tooMany' => \Yii::t('app','Too many pictures uploaded. No more than 10'),
                'maxSize' => 1024 * 1024 * 4,
                'tooBig'=> \Yii::t('app','Not more than 4MB')
            ],
        ];
    }

}
