<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Job;

/**
 * JobSearch represents the model behind the search form about `common\models\Job`.
 */
class JobSearch extends Job
{
    public $jobdep;
    public function rules()
    {
        return [
            [['job_id', 'job_dep_id'], 'integer'],
            [['job_dep_desc', 'job_date', 'job_status', 'job_done_date','jobdep'], 'safe'],
            [['job_price'], 'number'],
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
        $query = Job::find();

        //////////////////////////
        $query->joinWith('jobdep');
        ////////////////////////////
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
   //////////////////////////////////////////////
       $dataProvider->sort->attributes['jobdep'] = [
        'asc' => ['jobdep.job_dep_name' => SORT_ASC],
        'desc' => ['jobdep.job_dep_name' => SORT_DESC],
    ];
  ///////////////////////////////////////////////      
    if (!($this->load($params) && $this->validate())) {
        return $dataProvider;
    }
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'job_id' => $this->job_id,
            'job_dep_id' => $this->job_dep_id,
            'job_date' => $this->job_date,
            'job_price' => $this->job_price,
            'job_done_date' => $this->job_done_date,
        ])
/////////////////////////////////////////////////
      ->andFilterWhere(['like', 'tbl_jobdep.job_dep_name', $this->jobdep]);
    ///////////////////////////////////////////
        return $dataProvider;
    }
}
