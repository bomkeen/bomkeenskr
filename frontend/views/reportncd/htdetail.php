<?php

use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = 'ภาพรวมการให้บริการคลินิคความดันโลหิตสูง HT Deatil';
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
<?php if (isset($lab)) { ?>
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <table class="table table-hover">
                <tr class="bg-success">
                <th><center>รายการ</center></th>
                <th><center>คน</center></th><th><center>ครั้ง</center></th>
                </tr>
                  <?php foreach ($lab as $lab_rs){ ?>
                <tr>
               <td><?php echo $lab_rs['name']; ?></td>
                <td><center><?php echo $lab_rs['man']; ?></center></td><td><center><?php echo $lab_rs['n']; ?></center></td>
                </tr>
                  <?php } ?>
                <tr>
                    <th colspan="3"><center>ผู้ป่วยความดันโลหิต ที่ได้รับการคัดกรองการทำงานของไต (eGFR)</center></th>
                </tr>
                 <?php foreach ($egfr as $egfr_rs){ ?>
                <tr>
               <td><?php echo $egfr_rs['name']; ?></td>
                <td><center>-</center></td><td><center><?php echo $egfr_rs['n']; ?></center></td>
                </tr>
                  <?php } ?>
                <tr>
                    <th colspan="3"><center>งานติดตามดูแลผู้ป่วยความดันโลหิตสูง ตามปิงปอง 7 สี</center></th>
                </tr>
                <?php foreach ($ping as $ping_rs){ ?>
                <tr>
               <td><?php echo $ping_rs['name']; ?></td>
                <td><center><?php echo $ping_rs['man']; ?></center></td><td><center><?php echo $ping_rs['n']; ?></center></td>
                </tr>
                  <?php } ?>
            </table>

        </div>
    </div>
<?php } ?>


