<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pr;

/**
 * PrSearch represents the model behind the search form about `common\models\Pr`.
 */
class PrSearch extends Pr
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pr_id'], 'integer'],
            [['pr_desc', 'pr_link', 'status', 'pr_date_insert', 'pr_own'], 'safe'],
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
        $query = Pr::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'pr_id' => $this->pr_id,
            'pr_date_insert' => $this->pr_date_insert,
        ]);

        $query->andFilterWhere(['like', 'pr_desc', $this->pr_desc])
            ->andFilterWhere(['like', 'pr_link', $this->pr_link])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'pr_own', $this->pr_own]);

        return $dataProvider;
    }
}
