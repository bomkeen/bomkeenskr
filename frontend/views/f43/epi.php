<?php 
use kartik\grid\GridView;
include_once '../../inc/thaidate.php';
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงานข้อมูล 43 แฟ้ม', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'EPI', 'url' => ['f43/epi']];
?>

    <div class="row">
        <div class="col-md-6">
        <h2><p class="label label-info">EPI</p></h2>
        </div>
            <div class="col-md-4 col-md-offset-2">
                <form class="form form-inline" method="POST" >
                    <div class="row">
                    <select class="form-control" name="yymm" id="yymm">
                        <?php foreach ($d as $rsd){?>
                        <option value="<?php echo $rsd['v'];?>"> <?php echo thaimonth($rsd['label']);?></option>
                        <?php }?>
</select>
 <input class="btn btn-success" type="submit" name="Submit" value="แสดงข้อมูล" />
                    </div>
 </form>
            </div>
    </div>

<?php if(isset($dataProvider)) { ?>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'panel'=>[
            'before' => 'ข้อมูลของเดือน   '. thaimonth($rsd['label']) ,
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'vac',
            'label' => 'รายการ Vaccine'
        ],
        [
            'attribute'=>'n',
            'label'=>'จำนวน'
        ],
                           [
'label'=>'ช่วงเดือน',

'format' => 'raw',
'value'=>function ($data) {
        $strYear = date("Y",strtotime($data['fdate']))+543;
		$strMonth= date("n",strtotime($data['fdate']));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strMonthThai $strYear";
//return Yii::$app->thaiFormatter->asDate($data->today,'medium');


},
],
        
        
    
    ],
]); ?>
    </div>
</div>

<?php }?>