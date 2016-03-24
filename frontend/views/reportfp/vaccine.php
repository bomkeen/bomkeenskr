<?php

use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = 'สรุปข้อมูลกาให้บริการ vaccine';
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน FP', 'url' => ['index']];
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
                    'id' => 'date1',
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
                    'id' => 'date2',
                    'class' => 'form-control',
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
<?php if (isset($vac_in)) { ?>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table">
                <tr class="bg-success">
                <th><center>รายการ</center></th>
                <th><center>ครั้ง</center></th>
                </tr>
                <tr>
                    <th colspan="2"><center>Vaccine ในแผน</center></th>
                </tr>
                  <?php foreach ($vac_in as $vac_in_rs){ ?>
                <tr>
               <td><?php echo $vac_in_rs['name']; ?></td>
                <td><center><?php echo $vac_in_rs['n']; ?></center></td>
                </tr>
                  <?php } ?>
                <tr>
                    <th colspan="2"><center>Vaccine นอกแผน</center></th>
                </tr>
                <?php foreach ($vac_out as $vac_out_rs){ ?>
                <tr>
               <td><?php echo $vac_out_rs['name']; ?></td>
                <td><center><?php echo $vac_out_rs['n']; ?></center></td>
                </tr>
                  <?php } ?>
            </table>

        </div>
    </div>
<?php } ?>



