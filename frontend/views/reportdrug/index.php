<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'รายงาน ห้องยา';
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">
    <h3>รายงานข้อมูลต่างๆของงานงานเภสัชกรรม</h3>
</div>
<div class="row">
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="list-group">
  
  <a href="<?= \yii\helpers\Url::to(['/reportdrug/cost']) ?>" class="list-group-item">สรุปค่าใช้จ่ายในการใช้ยา</a>
  <a href="<?= \yii\helpers\Url::to(['/reportdrug/sumopd']) ?>" class="list-group-item">20 อันดับจำนวนมูลค่ายา OPD</a>
  <a href="<?= \yii\helpers\Url::to(['/reportdrug/sumipd']) ?>" class="list-group-item">20 อันดับจำนวนมูลค่ายา IPD</a>
  
  
</div>
        </div>
    </div>
</div>