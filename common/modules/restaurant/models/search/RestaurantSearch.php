<?php

namespace common\modules\restaurant\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\restaurant\models\Restaurant;

/**
 * RestaurantSearch represents the model behind the search form of `common\modules\restaurant\models\Restaurant`.
 */
class RestaurantSearch extends Restaurant
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'delivery', 'region_id', 'top', 'lang'], 'integer'],
            [['name', 'description', 'address', 'phone', 'work_time_start', 'work_time_end', 'slug', 'lang_hash'], 'safe'],
            [['lat', 'lng'], 'number'],
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
        $query = Restaurant::find();

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
            'delivery' => $this->delivery,
            'region_id' => $this->region_id,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'top' => $this->top,
            'lang' => $this->lang,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'work_time_start', $this->work_time_start])
            ->andFilterWhere(['like', 'work_time_end', $this->work_time_end])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'lang_hash', $this->lang_hash]);

        return $dataProvider;
    }
}
