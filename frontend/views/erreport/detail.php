<?php 
$this->title = 'สรุปการปฏิบัติงานห้อง ER';
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน ER', 'url' => ['index']];
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


<br>

<?php if(isset($rs)) { ?>




<div class="row">
    <div class="container">
        <div class="col-md-12">
            <table class="table table-striped">
                <tr>
                    <th rowspan="2"><center>เวลาปฏิบัติงาน</center></th>
                    <th class="bg-success" colspan="4"><center>จำนวนผู้รับบริการตามประเภทผู้ป่วย</center></th>
                    <th class="bg-danger" colspan="5"><center>จำนวนผู้รับบริการตามความเร่งด่วน</center></th>
            <th class="bg-info" colspan="6"><center>จำนวนผู้รับบริการตามการจำหน่าย</center></th>
<th rowspan="2"><center>All Visit</center></th>
            <th rowspan="2"><center>รวมค่าบริการ</center></th>
                </tr>
                <tr>
                    <th class="bg-warning">ฉุกเฉิน</th><th class="bg-warning">อุบัติเหตุ</th><th class="bg-warning">ตรวจโรคทั่วไป</th><th class="bg-warning">หัตถการ</th>
                    <th class="bg-warning">Life Threatening</th><th class="bg-warning">Emer-gency</th><th class="bg-warning">Urgency</th><th class="bg-warning">Less-Urgency</th><th class="bg-warning">None-Urgency</th>
                    <th class="bg-warning">กลับบ้าน</th><th class="bg-warning">ส่งต่อที่อื่น</th><th class="bg-warning">Admit</th><th class="bg-warning">เสียชีวิต</th><th class="bg-warning">สังเกตุอาการ</th><th class="bg-warning">ส่งต่อ</th>
                </tr>
<!--                Loob-->
               <?php  foreach ($rs as $s){ ?>
                <tr>
                    <th><?php echo $s['name'];?></th>
                    <td><?php echo $s['Pt_1'];?></td><td><?php echo $s['Pt_2'];?></td><td><?php echo $s['Pt_3'];?></td><td><?php echo $s['Pt_4'];?></td>
                <td><?php echo $s['Emer_1'];?></td><td><?php echo $s['Emer_2'];?></td><td><?php echo $s['Emer_3'];?></td><td><?php echo $s['Emer_4'];?></td><td><?php echo $s['Emer_5'];?></td>
                <td><?php echo $s['Dch_1'];?></td><td><?php echo $s['Dch_2'];?></td><td><?php echo $s['Dch_3'];?></td><td><?php echo $s['Dch_4'];?></td><td><?php echo $s['Dch_5'];?></td><td><?php echo $s['Dch_6'];?></td>
                <td><?php echo $s['VisitTotal'];?></td>
                <td><?php echo $s['MoneyTotal'];?></td>
                </tr>

               <?php } ?>
<!--end-->
            </table>
            
<?php } ?>
        </div>
    </div>

</div>