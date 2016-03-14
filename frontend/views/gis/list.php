<?php

use yii\helpers\Html;
use yii\grid\GridView;

include_once '../../inc/thaidate.php';
$this->title = 'รายชื่อผู้เกิดอุบัติเหตุ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='well'>
    <form method="POST">
        ระหว่าง:
        <?php
        echo yii\jui\DatePicker::widget([
            'name' => 'date1',
            'value' => $date1,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ],
        ]);
        ?>
        ถึง:
        <?php
        echo yii\jui\DatePicker::widget([
            'name' => 'date2',
            'value' => $date2,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ]
        ]);
        ?>
        <button class='btn btn-danger'>ประมวลผล</button>
    </form>
</div>
<div class="pr-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'hn',
            [
                            'label' => 'วันที่รับบริการ',
                            'format' => 'raw',
                            'value' => function ($model) {
                                $strYear = date("Y", strtotime($model['date'])) + 543;
                                $strMonth = date("n", strtotime($model['date']));
                                $strDay = date("j", strtotime($model['date']));
                                $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
                                $strMonthThai = $strMonthCut[$strMonth];
                                return "$strDay $strMonthThai $strYear";
                            },
                                ],
            //'pname',
[
'label'=>'ส่งหาหมอ',

'format' => 'raw',
'value'=>function ($data) {
return Html::a('บันทึกพิกัด',['gis/pin','vn'=>$data['vn']]);
},
],          
           //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
