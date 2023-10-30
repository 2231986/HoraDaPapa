<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Favorite;

/**
 * FavoriteSearch represents the model behind the search form of `app\models\Favorite`.
 */
class FavoriteSearch extends Favorite
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'plate_id', 'user_id'], 'integer'],
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
    public function search($params)
    {
        $query = Favorite::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'plate_id' => $this->plate_id,
            'date_time' => $this->date_time,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }
}
