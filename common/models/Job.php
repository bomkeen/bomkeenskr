<?php

namespace common\models;

use Yii;
use common\models\JobDep;
/**
 * This is the model class for table "job".
 *
 * @property integer $job_id
 * @property integer $job_dep_id
 * @property string $job_dep_desc
 * @property string $job_date
 * @property string $job_status
 * @property string $job_price
 * @property string $job_done_date
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job';
    }
/////////////////////////
    public function getJobdep()
{
    return $this->hasOne(JobDep::className(), ['job_dep_id' => 'job_dep_id']);
}
//////////////////////////////////
    public function rules()
    {
        return [
            [['job_dep_id'], 'integer'],
            [['job_date', 'job_done_date'], 'safe'],
            [['job_price'], 'number'],
            [['job_dep_desc'], 'string', 'max' => 255],
            [['job_status'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'job_id' => 'Job ID',
            'job_dep_id' => 'Job Dep ID',
            'job_dep_desc' => 'Job Dep Desc',
            'job_date' => 'Job Date',
            'job_status' => 'Job Status',
            'job_price' => 'Job Price',
            'job_done_date' => 'Job Done Date',
        ];
    }
}
