<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveQuery;

/**
 * TransactionSearch represents the model behind the search form about `common\models\Transaction`.
 */
class TransactionQuery extends ActiveQuery {

    public function refills() {
        return $this->andWhere(['type' => Transaction::OPERATION_TYPE_REFILL]);
    }

}
