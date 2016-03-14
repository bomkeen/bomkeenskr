<?php

$this->title = 'สรุปจำนวนผู้ป่วยนอก';
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน OPD', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
include_once '../../inc/thaidate.php';
?>
<div class='row'>
         <div class="col-md-4">
            <h4> <div class="label label-info">รายงาน สรุปจำนวนผู้ป่วยนอก</div></h4>
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
<?php if (isset($rsall)) { ?>
<br>
<div class="row">
    <p><h4><?php echo 'ข้อมูลระหว่างวันที่ '.thaidate($date1).' ถึง  '.thaidate($date2) ;?></h4></p>
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <table class="table table-hover">
               <?php foreach ($rsall as $all);?>
                <tr>
                    <th></th>
                    <th>จำนวนคน</th>
                    <th>จำนวนครั้ง</th>
                    <th>ในเวลา</th>
                    <th>นอกเวลา</th>
                </tr>
                <tr>
                    <td>จำนวนผู้รับบริการทั้งหมด</td>
                    <td><?php echo $all['dissum'];?></td>
                    <td><?php echo $all['cc'];?></td>
                    <td><?php echo $all['intime'];?></td>
                    <td><?php echo $all['outtime'];?></td>
                </tr>
                <tr>
                    <?php foreach ($rsopd_all as $opd_all);?>
                    <td>OPD ไม่นับรวมคนไข้ที่เข้าห้องฉุกเฉิน</td>
                    <td><?php echo $opd_all['dissum'];?></td>
                    <td><?php echo $opd_all['cc'];?></td>
                     <td><?php echo $opd_all['intime'];?></td>
                    <td><?php echo $opd_all['outtime'];?></td>
                </tr>
                <tr>
                    <?php foreach ($er as $er_all);?>
                    <td>ER</td>
                    <td><?php echo $er_all['dissum'];?></td>
                    <td><?php echo $er_all['cc'];?></td>
                     <td><?php echo $er_all['intime'];?></td>
                    <td><?php echo $er_all['outtime'];?></td>
                </tr>
                <tr>
                    <?php foreach ($rsdent as $dent);?>
                    <td>Dent</td>
                    <td><?php echo $dent['dissum'];?></td>
                    <td><?php echo $dent['cc'];?></td>
                     <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <?php foreach ($rsanc as $anc);?>
                    <td>ANC</td>
                    <td><?php echo $anc['dissum'];?></td>
                    <td><?php echo $anc['cc'];?></td>
                     <td>-</td>
                    <td>-</td>
                </tr>
                
            </table>
        </div>
    </div>
</div>
<?php }?>