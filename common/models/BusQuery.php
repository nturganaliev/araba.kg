<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Automobile;

/**
 * AutomobileQuery represents the model behind the search form about `common\models\Automobile`.
 */
class BusQuery extends Bus
{

    public $issueDateFrom;
    public $issueDateTo;
    public $priceFrom;
    public $priceTo;
    public $type_id = Car::CAR_TYPE_BUS;
    public $model_name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'marka_id', 'model_id', 'wheel_id', 'kuzov_id', 'privod_id', 'transmission_id', 'engine_id', 'color_id', 'state_id', 'region_id', 'run_length', 'created_by', 'updated_by'], 'integer'],
            [['engine_displacement', 'price', 'rent_price'], 'number'],
            ['model_name', 'string'],
            ['model_name', 'trim'],
            [['issue_date', 'description', 'premium_date'], 'safe'],
            [['rent'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Automobile::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        $this->issueDateFrom = isset($params['AutomobileQuery']['issueDateFrom']) ? $params['AutomobileQuery']['issueDateFrom'] : null;
        $this->issueDateTo = isset($params['AutomobileQuery']['issueDateTo']) ? $params['AutomobileQuery']['issueDateTo'] : null;
        $this->priceFrom = isset($params['AutomobileQuery']['priceFrom']) ? $params['AutomobileQuery']['priceFrom'] : null;
        $this->priceTo = isset($params['AutomobileQuery']['priceTo']) ? $params['AutomobileQuery']['priceTo'] : null;

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type_id' => $this->type_id,
            'cars.marka_id' => $this->marka_id,
            'model_id' => $this->model_id,
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
//            'model_name' =>$this->model_name
        ]);
        $query->andWhere(['>=', 'premium_date', date('Y-m-d H:i:s', strtotime('-14 days'))]);

        $query->andWhere('issue_date > '. ($this->issueDateFrom ?: 1945) .' AND issue_date < '. ($this->issueDateTo ?: (int)date("Y")));
        $query->andWhere('price > '. ($this->priceFrom ?: 100000).' AND price < '. ($this->priceTo ?: 40000000));

        $query->andFilterWhere(['like', 'description', $this->description]);
        $query->joinWith(['carModel' => function ($q) {
                $q->where(['like', 'car_models.name', $this->model_name]);
                $q->joinWith(['marka' => function($qi) {
                        $qi->where(['markas.car_type_id' => Car::CAR_TYPE_BUS]);
                    }
                        ], true, 'INNER JOIN');
                }], true, 'INNER JOIN');

        return $dataProvider;
    }

    public function attributeLabels()
    {
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
            'model_name' => Yii::t('app', 'Bus model'),
        ];
    }
}