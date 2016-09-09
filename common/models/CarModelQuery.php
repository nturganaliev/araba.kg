<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CarModel;

/**
 * CarModelQuery represents the model behind the search form about `common\models\CarModel`.
 */
class CarModelQuery extends CarModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'marka_id', 'seria', 'created_by', 'updated_by'], 'integer'],
            [['is_seria'], 'boolean'],
            [['name'], 'safe'],
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
        $query = CarModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'marka_id' => $this->marka_id,
            'seria' => $this->seria,
            'is_seria' => $this->is_seria,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
