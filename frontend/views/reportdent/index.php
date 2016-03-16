<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'รายงาน DENT';
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">
    <h3>รายงานข้อมูลต่างๆของงานทันตกรรม</h3>
</div>
<div class="row">
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="list-group">
  
  <a href="<?= \yii\helpers\Url::to(['/reportdent/detail']) ?>" class="list-group-item">สรุปข้อมูลทันตกรรมตามช่วงเวลา</a>
  <a href="<?= \yii\helpers\Url::to(['/reportdent/dttm']) ?>" class="list-group-item">รายงานสถิติผู้ป่วยใน (IPD Ratio)</a>
  
</div>
        </div>
    </div>
</div>