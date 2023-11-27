<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Meal;

/**
 * MealSearch represents the model behind the search form of `app\models\Meal`.
 */
class MealSearch extends Meal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'dinner_table_id', 'checkout'], 'integer'],
            [['date_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function search($params, $query)
    {
        if ($query == null)
        {
            $query = Meal::find();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate())
        {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'dinner_table_id' => $this->dinner_table_id,
            'checkout' => $this->checkout,
            'date_time' => $this->date_time,
        ]);

        return $dataProvider;
    }
}
