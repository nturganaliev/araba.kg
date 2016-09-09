<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Car;

/**
 * CarQuery represents the model behind the search form about `common\models\Car`.
 */
class CarQuery extends Car {

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
        $query = Car::find();


        $sort = new \yii\data\Sort([
            'attributes' => [
                'defaultOrder' => 'premium_date desc, created_at desc',
                'created_at' => [
                    'label' => Yii::t('app', 'Created at'),
                ],
                'price' => [
                    'label' => Yii::t('app', 'Price'),
                ],
                'issue_date' => [
                    'label' => Yii::t('app', 'Issue date'),
                ],
            ],
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $sort,
            'pagination' => [
                'pageSize' => 25,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type_id' => $this->type_id,
            'marka_id' => $this->marka_id,
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
//            'premium_date' => $this->premium_date,
            'rent' => $this->rent,
            'rent_price' => $this->rent_price,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

}
