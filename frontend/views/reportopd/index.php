<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'รายงาน OPD';
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">
    <h3>รายงานข้อมูลต่างๆของงานผู้ป่วยนอก</h3>
</div>
<div class="row">
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="list-group">
  
  <a href="<?= \yii\helpers\Url::to(['/reportopd/sumopd']) ?>" class="list-group-item">รายงานสรุปผู้ป่วยนอก</a>
  <a href="<?= \yii\helpers\Url::to(['/reportopd/top20']) ?>" class="list-group-item">รายงาน 20 โรค OPD</a>
  
</div>
        </div>
    </div>
</div>