<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\JobDep */

$this->title = $model->job_dep_id;
$this->params['breadcrumbs'][] = ['label' => 'Job Deps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-dep-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->job_dep_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->job_dep_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'job_dep_id',
            'job_dep_name',
        ],
    ]) ?>

</div>
