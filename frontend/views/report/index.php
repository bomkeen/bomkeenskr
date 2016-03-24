<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="row">
    <div class="container">
        <div class="col-md-3">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    OPD
                </div>
                <div class="panel-body">
                    <h4>จำนวนผู้ป่วยนอก </h4> 
                    <h5>วันที่ <?php echo $date; ?></h5>
                    <?php foreach ($rsbox1 as $box1)
                        ;
                    ?>
                    <h4> จำนวน <?php echo $box1['n']; ?> คน</h4>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-success glyphicon glyphicon-file" href="<?= \yii\helpers\Url::to(['/reportopd']) ?>"> ข้อมุลเพิ่มเติม</a>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    IPD
                </div>		
                <div class="panel-body">
                    <h4>ผู้ป่วยที่นอนในหอผู้ป่วย </h4>
                    <h5>วันที่ <?php echo $date; ?></h5>
                    <?php foreach ($rsbox2 as $box2)
                        ;
                    ?>
                    <h4> จำนวน <?php echo $box2['n']; ?> คน</h4>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-success glyphicon glyphicon-file" href="<?= \yii\helpers\Url::to(['/reportipd']) ?>"> ข้อมุลเพิ่มเติม</a>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    ระบบนัด
                </div>		
                <div class="panel-body">
                    <h4>จำนวนนัดผู้ป่วย </h4>
                    <h5>วันที่ <?php echo $date; ?></h5>
<?php foreach ($rsbox3 as $box3)
    ;
?>
                    <h4> จำนวน <?php echo $box3['n']; ?> คน</h4>
                </div>
                <div class="panel-footer">
                     <a class="btn btn-success glyphicon glyphicon-file" href="<?= \yii\helpers\Url::to(['/oapp']) ?>"> ข้อมุลเพิ่มเติม</a>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    ER
                </div>		
                <div class="panel-body">
                    <h4>ผู้ป่วยฉุกเฉิน </h4>
                    <h5>วันที่ <?php echo $date; ?></h5>
<?php foreach ($rsbox4 as $box4)
    ;
?>
                    <h4> จำนวน <?php echo $box4['n']; ?> คน</h4>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-success glyphicon glyphicon-file" href="<?= \yii\helpers\Url::to(['/erreport']) ?>"> ข้อมุลเพิ่มเติม</a>

                </div>
            </div>
        </div>

    </div>
</div>                
<!--/////////////-->

<div class="row"> 
    <div class="container">
        <div class="col-md-3">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    Dent
                </div>		
                <div class="panel-body">
                    <h4>งานทันตกรรม </h4>
                    <h5>วันที่ <?php echo $date; ?></h5>
<?php foreach ($rsbox5 as $box5)
    ;
?>
                    <h4> จำนวน <?php echo $box5['n']; ?> คน</h4>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-success glyphicon glyphicon-file" href="<?= \yii\helpers\Url::to(['/reportdent']) ?>"> ข้อมุลเพิ่มเติม</a>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    NCD
                </div>		
                <div class="panel-body">
                    <h4>งานโรคเรื้อรัง </h4>
                    <h5>วันที่ <?php echo $date; ?></h5>
<?php foreach ($rsbox6 as $box6)
    ; ?>
                    <h4> จำนวน <?php echo $box6['n']; ?> คน</h4>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-success glyphicon glyphicon-file" href="<?= \yii\helpers\Url::to(['/reportncd']) ?>"> ข้อมุลเพิ่มเติม</a>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    Drug
                </div>		
                <div class="panel-body">
                    <h4>ห้องยา </h4>
                    <h5>วันที่ <?php echo $date; ?></h5>

                    <h4> ข้อมูลระบบงานยา</h4>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-success glyphicon glyphicon-file" href="<?= \yii\helpers\Url::to(['/reportdrug']) ?>"> ข้อมูลเพิ่มเติม</a>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    Lab
                </div>		
                <div class="panel-body">
                    <h4>ห้องLab </h4>
                    <h5>วันที่ <?php echo $date; ?></h5>

                    <h4> ข้อมูลระบบงานLab</h4>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-success glyphicon glyphicon-file" href=""> ข้อมูลเพิ่มเติม</a>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="container">
        <div class="col-md-3">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    ส่งเสริมสุขภาพ
                </div>
                <div class="panel-body">
                    <h4>งานส่งเสริมสุขภาพ </h4>
                    <h5>วันที่ <?php echo $date; ?></h5>
                    <h4>------</h4>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-success glyphicon glyphicon-file" href="<?= \yii\helpers\Url::to(['/reportfp']) ?>"> ข้อมุลเพิ่มเติม</a>

                </div>
            </div>
        </div>
        
    </div>
    
</div>
