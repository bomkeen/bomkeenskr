<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JobDep */

$this->title = 'Update Job Dep: ' . ' ' . $model->job_dep_id;
$this->params['breadcrumbs'][] = ['label' => 'Job Deps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->job_dep_id, 'url' => ['view', 'id' => $model->job_dep_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="job-dep-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
