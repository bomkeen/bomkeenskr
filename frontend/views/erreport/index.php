<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'รายงาน ER';
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">
    <h3>รายงานข้อมูลต่างๆของงาน ER</h3>
</div>
<div class="row">
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="list-group">
  
  <a href="<?= \yii\helpers\Url::to(['/erreport/top20']) ?>" class="list-group-item">รายงาน 20 อันดับโรค ER</a>
  <a href="<?= \yii\helpers\Url::to(['/reportipd/ipdratio']) ?>" class="list-group-item">รายงานสรุปผลการปฏิบัติงานห้อง ER</a>
  
</div>
        </div>
    </div>
</div>