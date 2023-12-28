<?php

namespace common\modules\restaurant\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\restaurant\models\Waiter;

/**
 * WaiterSearch represents the model behind the search form of `common\modules\restaurant\models\Waiter`.
 */
class WaiterSearch extends Waiter
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'restaurant_id', 'lang'], 'integer'],
            [['name', 'position', 'lang_hash'], 'safe'],
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
        $query = Waiter::find();

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
            'restaurant_id' => $this->restaurant_id,
            'lang' => $this->lang,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'lang_hash', $this->lang_hash]);

        return $dataProvider;
    }
}
