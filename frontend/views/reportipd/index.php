<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'รายงาน IPD';
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">
    <h3>รายงานข้อมูลต่างๆของงานผู้ป่วยใน</h3>
</div>
<div class="row">
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="list-group">
  
  <a href="<?= \yii\helpers\Url::to(['/reportipd/top20']) ?>" class="list-group-item">รายงาน 20 อันดับโรค IPD</a>
  <a href="<?= \yii\helpers\Url::to(['/reportipd/ipdratio']) ?>" class="list-group-item">รายงานสถิติผู้ป่วยใน (IPD Ratio)</a>
  
</div>
        </div>
    </div>
</div>