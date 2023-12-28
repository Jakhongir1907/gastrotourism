<?php

namespace common\modules\event\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\event\models\EventRegistration;

/**
 * EventRegistrationSearch represents the model behind the search form of `common\modules\event\models\EventRegistration`.
 */
class EventRegistrationSearch extends EventRegistration
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'experience', 'created_at', 'updated_at', 'status'], 'integer'],
            [['fullname', 'birth_date', 'address', 'work', 'position', 'phone_number', 'telegram_number'], 'safe'],
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
        $query = EventRegistration::find();

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
            'experience' => $this->experience,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'birth_date', $this->birth_date])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'work', $this->work])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'telegram_number', $this->telegram_number]);

        return $dataProvider;
    }
}
