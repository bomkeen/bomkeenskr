<?php
use kartik\grid\GridView;
use yii\helpers\Html;
$this->title = 'จำนวนผู้ป่วยโรคเรื้อรังและโรคร่วม';
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน NCD', 'url' => ['index']];
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
                <div class="form-group">
                    <label for="export">ส่งออก PDF</label>
                    <input class="form-control" type="radio" id="export" name="export" value="pdf">
                </div>
                <div class="form-group">
        <button class='btn btn-danger'>ประมวลผล</button>
                </div>
    </form>
</div>
</div>
<br>
<?php if(isset($rsht)) { ?>
<div class="row">
    <div class="col-md-12 col-md-offset-0">
        <table class="table table-hover">
            <tr>
                <th colspan="5" class="bg-warning"><center>ผู้ป่วยโรคความดัน</center></th>
            </tr>
            <tr class="bg-warning">
                <th><center>ประเภทผู้ป่วย</center></th><th><center>จำนวนผู้ป่วย HT</center></th>
                <th><center>โรคหลอดเลือด</center></th><th><center>โรคหัวใจ</center></th>
                <th><center>โรคไต</center></th>
            </tr>
            <!--loop-->
            <?php foreach ($rsht as $ht){ ?>
            <tr>
                 <th><center><?php echo $ht['ipd']?></center></th><td><center><?php echo $ht['ht']?></center></td>
                <td><center><?php echo $ht['bt']?></center></td><td><center><?php echo $ht['heart']?></center></td>
                <td><center><?php echo $ht['N']?></center></td>
            </tr>
            <?php } ?>
            <!--end-->
        </table>
        <br>
        <table class="table table-hover">
            <tr>
                <th colspan="5" class="bg-success"><center>ผู้ป่วยโรคความเบาหวาน</center></th>
            </tr>
            <tr class="bg-success">
                <th><center>ประเภทผู้ป่วย</center></th><th><center>จำนวนผู้ป่วย DM</center></th>
                <th><center>โรคหลอดเลือด</center></th><th><center>โรคหัวใจ</center></th>
                <th><center>โรคไต</center></th>
            </tr>
            <!--loop-->
            <?php foreach ($rsdm as $dm){ ?>
            <tr>
                <th><center><?php echo $dm['ipd']?></center></th><td><center><?php echo $dm['dm']?></center></td>
                <td><center><?php echo $dm['t']?></center></td><td><center><?php echo $dm['eye']?></center></td>
                <td><center><?php echo $dm['hydro']?></center></td>
            </tr>
            <?php } ?>
            <!--end-->
        </table>
    </div>
</div>
<?php } ?>


