<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pr".
 *
 * @property integer $pr_id
 * @property string $pr_desc
 * @property string $pr_link
 * @property string $status
 * @property string $pr_date_insert
 * @property string $pr_own
 */
class Pr extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pr_date_insert'], 'safe'],
            [['pr_desc', 'pr_link', 'pr_own'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pr_id' => 'Pr ID',
            'pr_desc' => 'Pr Desc',
            'pr_link' => 'Pr Link',
            'status' => 'Status',
            'pr_date_insert' => 'Pr Date Insert',
            'pr_own' => 'Pr Own',
        ];
    }
}
