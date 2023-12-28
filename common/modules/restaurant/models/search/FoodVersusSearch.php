<?php

namespace common\modules\restaurant\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\restaurant\models\FoodVersus;

/**
 * FoodVersusSearch represents the model behind the search form of `common\modules\restaurant\models\FoodVersus`.
 */
class FoodVersusSearch extends FoodVersus
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'first_likes', 'second_likes'], 'integer'],
            [['first_food_id', 'second_food_id'], 'safe'],
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
        $query = FoodVersus::find();

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

        $query->andFilterWhere(['like', 'first_food_id', $this->first_food_id])
            ->andFilterWhere(['like', 'second_food_id', $this->second_food_id]);

        return $dataProvider;
    }
}
