<?php

namespace common\modules\restaurant\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\restaurant\models\FoodVs;

/**
 * FoodVsSearch represents the model behind the search form of `common\modules\restaurant\models\FoodVs`.
 */
class FoodVsSearch extends FoodVs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'first_likes', 'second_likes', 'lang'], 'integer'],
            [['first_food_name', 'second_food_name', 'first_food_description', 'second_food_description', 'lang_hash'], 'safe'],
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
        $query = FoodVs::find();

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
            'first_likes' => $this->first_likes,
            'second_likes' => $this->second_likes,
            'lang' => $this->lang,
        ]);

        $query->andFilterWhere(['like', 'first_food_name', $this->first_food_name])
            ->andFilterWhere(['like', 'second_food_name', $this->second_food_name])
            ->andFilterWhere(['like', 'first_food_description', $this->first_food_description])
            ->andFilterWhere(['like', 'second_food_description', $this->second_food_description])
            ->andFilterWhere(['like', 'lang_hash', $this->lang_hash]);

        return $dataProvider;
    }
}
