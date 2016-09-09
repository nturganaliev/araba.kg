<?php

namespace common\models;

use yii\db\ActiveQuery;
use common\models\Car;

/**
 * Description of MarkaQuery
 *
 * @author sanzhar
 */
class MarkaQuery extends ActiveQuery {

    public function automobile() {
        return $this->andWhere(['car_type_id' => Car::CAR_TYPE_AUTOMOBILE]);
    }

    public function lorry() {
        return $this->andWhere(['car_type_id' => Car::CAR_TYPE_LORRY]);
    }

    public function bus() {
        return $this->andWhere(['car_type_id' => Car::CAR_TYPE_BUS]);
    }

    public function motocycle() {
        return $this->andWhere(['car_type_id' => Car::CAR_TYPE_MOTOCYCLE]);
    }

    public function specialEquipment() {
        return $this->andWhere(['car_type_id' => Car::CAR_TYPE_SPECIAL_EQUIPMENT]);
    }

}
