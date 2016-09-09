<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $fio
 * @property string $company_name
 * @property string $mobile_phone
 * @property string $work_phone
 * @property integer $client_type
 * @property float $balance
 * @property integer $created_at
 * @property integer $updated_at
 */
class UserProfile extends ActiveRecord {

    const CLIENT_TYPE_IND = 0;
    const CLIENT_TYPE_LEG = 1;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'users_profiles';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     *  @property string $fio
     * @property string $company_name
     * @property string $mobile_phone
     * @property string $work_phone
     */
    public function rules() {
        return [
            ['client_type', 'in', 'range' => [self::CLIENT_TYPE_IND, self::CLIENT_TYPE_LEG]],
            [['fio', 'company_name', 'mobile_phone', 'work_phone'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }

    public static function getTypeOptions() {
        return [
            self::CLIENT_TYPE_IND => Yii::t('app', 'Individual'),
            self::CLIENT_TYPE_LEG => Yii::t('app', 'Company'),
        ];
    }

    public function getTypeText() {
        $typeOptions = self::getTypeOptions();
        return isset($typeOptions[$this->client_type]) ? $typeOptions[$this->client_type] : Yii::t('app', 'Unknown client type');
    }

}
