<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "job_dep".
 *
 * @property integer $job_dep_id
 * @property string $job_dep_name
 */
class JobDep extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_dep';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_dep_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'job_dep_id' => 'Job Dep ID',
            'job_dep_name' => 'Job Dep Name',
        ];
    }
}
