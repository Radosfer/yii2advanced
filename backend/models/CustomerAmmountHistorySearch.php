<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CustomerAmmountHistory;

/**
 * CustomerAmmountHistorySearch represents the model behind the search form about `app\models\CustomerAmmountHistory`.
 */
class CustomerAmmountHistorySearch extends CustomerAmmountHistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'garden_id','operation',], 'integer'],
            [['admin'], 'safe'],
            [['operation_money'], 'number'],
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
        $query = CustomerAmmountHistory::find();

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
            'customer_id' => $this->customer_id,
            'garden_id' => $this->garden_id,
            'operation' => $this->operation,
            'operation_money' => $this->operation_money,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'admin', $this->admin]);

        return $dataProvider;
    }
}
