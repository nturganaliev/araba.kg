<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\EmployeeProfile;

/**
 * UserProfileQuery represents the model behind the search form about `backend\models\UserProfile`.
 */
class EmployeeProfileQuery extends EmployeeProfile {

    public $status = Employee::STATUS_ACTIVE;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'user_id', 'status', 'office_id', 'role'], 'integer'],
            [['fio', 'phone', 'email'], 'safe'],
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
        $query = EmployeeProfile::find();
//        $query = UserProfile::find()->with([
//            'user' => function($q) {
//                $q->status = $this->status;
//            },
//            'office'
//        ]);
        $query->joinWith(['user', 'office']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'office_id' => [
                        'asc' => ['offices.name' => SORT_ASC],
                        'desc' => ['offices.name' => SORT_DESC],
                    ],
                    'fio',
                    'status',
                    'phone',
                    'role',
                    'email' => [
                        'asc' => ['employees.email' => SORT_ASC],
                        'desc' => ['employees.email' => SORT_DESC],
                    ],
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'office_id' => $this->office_id,
            'role' => $this->role,
            'employees.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'employees.email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }

}
