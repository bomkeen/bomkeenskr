<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'ตรวจสอบ 43 แฟ้ม';
//$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">
    <h3>ตรวจสอบ 43 แฟ้ม</h3>
</div>
<div class="row">
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="list-group">
  
  <a href="<?= \yii\helpers\Url::to(['/f43/labfu']) ?>"
  class="list-group-item">LABFU</a>
  <a href="<?= \yii\helpers\Url::to(['/f43/chronicfu']) ?>"
  class="list-group-item">Chronicfu</a>
  <a href="<?= \yii\helpers\Url::to(['/f43/epi']) ?>"
  class="list-group-item">EPI</a>
  <a href="<?= \yii\helpers\Url::to(['/f43/fp']) ?>"
  class="list-group-item">ส่งเสริมสุขภาพ</a>
  <a href="<?= \yii\helpers\Url::to(['/f43/dent']) ?>"
  class="list-group-item">ตรวจสุขภาพฟัน</a>
  
  
</div>
        </div>
    </div>
</div>