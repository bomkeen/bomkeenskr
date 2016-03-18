<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'รายงาน NCD';
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">
    <h3>รายงานข้อมูลต่างๆของงานโรคเริ้อรัง</h3>
</div>
<div class="row">
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="list-group">
  
  <a href="<?= \yii\helpers\Url::to(['/reportncd/htdmdiag']) ?>" class="list-group-item">จำนวนผู้ป่วยโรคเรื้อรังและโรคร่วม</a>
  <a href="<?= \yii\helpers\Url::to(['/reportncd/htdetail']) ?>" class="list-group-item">ภาพรวมการให้บริการคลินิคความดันโลหิตสูง HT Deatil</a>
  
</div>
        </div>
    </div>
</div>