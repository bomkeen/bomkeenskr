<?php
use kartik\grid\GridView;
$this->title = '20 อันดับจำนวนมูลค่ายา OPD';
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงานห้องยา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
include_once '../../inc/thaidate.php';
?>

<div class='row'>
         <div class="col-md-4">
            <h4> <div class="label label-info">รายงาน <?php echo $this->title; ?></div></h4>
        </div>
        
        <div class="col-md-8">
            <form class="form-inline" method="POST">
    
        <div class="form-group">
            <label for="date1">ระหว่าง :</label>
        <?php
        echo yii\jui\DatePicker::widget([
            'name' => 'date1',
            'value' => $date1,
            'language' => 'th',
            'id'=>'date1',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control'],
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ],
        ]);
        ?>
        </div>
        <div class="form-group">
            <label for="date2">ถึง:</label>
        
        <?php
        echo yii\jui\DatePicker::widget([
            'name' => 'date2',
            'value' => $date2,
            'language' => 'th',
            'id'=>'date2',
            'class'=>'form-control',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control'],
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ]
        ]);
        ?>
        </div>
        <button class='btn btn-danger'>ประมวลผล</button>
    </form>
</div>
</div>

<?php 
if(isset($dataProvider)) { ?>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'showPageSummary' => true,
    'panel'=>[
            'before' => 'ข้อมูลหระหว่างวันที่   '.thaidate($date1) .'    ถึง    '.thaidate($date2),
    ],
    'columns' => [
           [
    'class'=>'kartik\grid\SerialColumn',
    'contentOptions'=>['class'=>'kartik-sheet-style'],
    'width'=>'36px',
    'header'=>'',
    'headerOptions'=>['class'=>'kartik-sheet-style']
],
        [
            'attribute' => 'dname',
            'label' => 'ขนานยา',
            'pageSummary'=>'Total',
        ],
        [
            'attribute'=>'person',
            'label'=>'จำนวนคน',
            'pageSummary'=>true
        ],
        [
            'attribute'=>'rx',
            'label'=>'จำนวนครั้ง',
            'pageSummary'=>true
        ],
        [
            'attribute'=>'price',
            'label'=>'จำนวนเงิน',
            'pageSummary'=>true
        ]
     ],
]); ?>
    </div>
</div>

<?php }?>