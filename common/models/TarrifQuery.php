<?php

namespace common\models;

class TarrifQuery extends \yii\db\ActiveQuery {

    public function active() {
        $this->andWhere(['status' => Tarrif::STATUS_ACTIVE]);
        return $this;
    }

}
