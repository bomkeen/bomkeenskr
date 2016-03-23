<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'รายงาน FP';
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">
    <h3>รายงานข้อมูลต่างๆของงานส่งเสริมสุขภาพ</h3>
</div>
<div class="row">
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="list-group">
  
  <a href="<?= \yii\helpers\Url::to(['/reportfp/vaccine']) ?>" class="list-group-item">สรุปข้อมูลกาให้บริการ vaccine</a>
  
  
</div>
        </div>
    </div>
</div>