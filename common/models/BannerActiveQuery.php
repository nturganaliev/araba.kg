<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Banner;
use yii\db\ActiveQuery;

/**
 * BannerQuery represents the model behind the search form about `common\models\Banner`.
 */
class BannerActiveQuery extends ActiveQuery {

    public function active($state = Banner::STATUS_ACTIVE) {
        return $this->andWhere(['status' => $state]);
    }

    public function mainPage() {
        return $this->andWhere(['page' => Banner::PAGE_MAIN]);
    }

}
