<?php

use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = 'รายงานการจ่ายยา ที่ระบุการแพ้ยา';
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
<br><br>
<?php if (isset($cost)) { ?>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table">
                <tr>
                    <th></th>
                </tr>
                
                
            </table>

        </div>
    </div>
<?php } ?>



