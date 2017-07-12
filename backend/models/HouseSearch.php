<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\House;

/**
 * HouseSearch represents the model behind the search form about `app\models\House`.
 */
class HouseSearch extends House
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'street_id', 'group_id', 'testimony', 'start_value', 'last_indication', 'spent', 'garden_id'], 'integer'],
            [['title', 'fio', 'phone'], 'safe'],
            [['money'], 'number'],
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
        $query = House::find();

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
            'street_id' => $this->street_id,
            'group_id' => $this->group_id,
            'money' => $this->money,
            'testimony' => $this->testimony,
            'start_value' => $this->start_value,
            'last_indication' => $this->last_indication,
            'spent' => $this->spent,
            'garden_id' => $this->garden_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}
