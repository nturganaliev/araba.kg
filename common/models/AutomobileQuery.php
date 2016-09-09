<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Automobile;

/**
 * AutomobileQuery represents the model behind the search form about `common\models\Automobile`.
 */
class AutomobileQuery extends Automobile {

    public $issueDateFrom;
    public $issueDateTo;
    public $priceFrom;
    public $priceTo;
    public $type_id = Car::CAR_TYPE_AUTOMOBILE;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'type_id', 'marka_id', 'model_id', 'wheel_id', 'kuzov_id', 'privod_id', 'transmission_id', 'engine_id', 'color_id', 'state_id', 'region_id', 'run_length', 'created_by', 'updated_by'], 'integer'],
            [['engine_displacement', 'price', 'rent_price'], 'number'],
            [['issue_date', 'description', 'premium_date'], 'safe'],
            [['rent'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $pageSize = 25;
        $query = Automobile::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                // Set the default sort by premium_date DESC.
                'defaultOrder' => [
                    'premium_date' => SORT_DESC,
                ]
            ],
            'pagination' => [
                'pageSize' => $pageSize,
            ],
        ]);

        $this->load($params);
        $this->issueDateFrom = isset($params['AutomobileQuery']['issueDateFrom']) ? $params['AutomobileQuery']['issueDateFrom'] : null;
        $this->issueDateTo = isset($params['AutomobileQuery']['issueDateTo']) ? $params['AutomobileQuery']['issueDateTo'] : null;
        $this->priceFrom = isset($params['AutomobileQuery']['priceFrom']) ? $params['AutomobileQuery']['priceFrom'] : null;
        $this->priceTo = isset($params['AutomobileQuery']['priceTo']) ? $params['AutomobileQuery']['priceTo'] : null;

        if (!$this->validate()) {
            return $dataProvider;
        }
        if ($this->model_id != NULL) {
            $carModel = CarModel::findOne($this->model_id);
            if ($carModel != NULL && $carModel->is_seria) {
                $seriaIds = $carModel->getChildModels()->select('id')->asArray();
                $query->andFilterWhere(['in', 'model_id', $seriaIds]);
            } else {
                $query->andFilterWhere(['model_id' => $this->model_id]);
            }
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type_id' => $this->type_id,
            'marka_id' => $this->marka_id,
            'wheel_id' => $this->wheel_id,
            'kuzov_id' => $this->kuzov_id,
            'privod_id' => $this->privod_id,
            'transmission_id' => $this->transmission_id,
            'engine_id' => $this->engine_id,
            'engine_displacement' => $this->engine_displacement,
            'color_id' => $this->color_id,
            'state_id' => $this->state_id,
            'region_id' => $this->region_id,
            'price' => $this->price,
            'issue_date' => $this->issue_date,
            'run_length' => $this->run_length,
            'rent' => $this->rent,
            'rent_price' => $this->rent_price,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);
        $query->andWhere(['>=', 'premium_date', date('Y-m-d H:i:s', strtotime('-14 days'))]);

        if ($this->issueDateFrom) {
            $query->andWhere('issue_date > '. $this->issueDateFrom);
        }
        if ($this->issueDateTo) {
            $query->andWhere('issue_date < '. $this->issueDateTo);
        }
        if ($this->priceFrom) {
            $query->andWhere('price > '. $this->priceFrom);
        }
        if ($this->priceTo) {
            $query->andWhere('price < '. $this->priceTo);
        }

//        if (($needed = $pageSize - $query->count()) && $needed > 0) {
//            $query2 = Automobile::find()
//                ->andWhere('(premium_date is null) OR (premium_date<CURRENT_TIMESTAMP)')
//                ->orderBy(['updated_at' => SORT_DESC]);
////                ->limit($needed);
//            $query->union($query2);
//
//            $query2->andFilterWhere([
//                'type_id' => $this->type_id,
//                'marka_id' => $this->marka_id,
//                'wheel_id' => $this->wheel_id,
//                'kuzov_id' => $this->kuzov_id,
//                'privod_id' => $this->privod_id,
//                'transmission_id' => $this->transmission_id,
//                'engine_id' => $this->engine_id,
//                'engine_displacement' => $this->engine_displacement,
//                'color_id' => $this->color_id,
//                'state_id' => $this->state_id,
//                'region_id' => $this->region_id,
//                'price' => $this->price,
//                'issue_date' => $this->issue_date,
//                'run_length' => $this->run_length,
//                'premium_date' => $this->premium_date,
//                'rent' => $this->rent,
//                'rent_price' => $this->rent_price,
//                'created_by' => $this->created_by,
//                'updated_by' => $this->updated_by,
//            ]);
//        }

        return $dataProvider;
    }

    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'type_id' => Yii::t('app', 'Type ID'),
            'issueDateFrom' => Yii::t('app', 'Year'),
            'issueDateTo' => Yii::t('app', 'Year to'),
            'priceFrom' => Yii::t('app', 'Price'),
            'priceTo' => Yii::t('app', 'Price to'),
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
            'price' => Yii::t('app', 'Price'),
            'issue_date' => Yii::t('app', 'Issue Date'),
            'run_length' => Yii::t('app', 'Run Length'),
            'description' => Yii::t('app', 'Description'),
            'premium_date' => Yii::t('app', 'Premium Date'),
            'rent' => Yii::t('app', 'Rent'),
            'rent_price' => Yii::t('app', 'Rent Price'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

}
