<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "temp_hn".
 *
 * @property string $hn
 */
class TempHn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'temp_hn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hn'], 'string', 'min' => 7]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hn' => 'Hn',
        ];
    }
}
