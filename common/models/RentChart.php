<?php

namespace common\models;

use Yii;


class RentChart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rent_chart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['rent_chart_id', 'rent_chart_an'], 'integer'],
            [['rent_chart_date'], 'safe'],
            [['rent_chart_dep'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rent_chart_id' => '',
            'rent_chart_an' => '',
            'rent_chart_date' => '',
            'rent_chart_dep' => 'Rent Chart Dep',
        ];
    }
}
