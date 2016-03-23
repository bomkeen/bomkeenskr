<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\JobSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'job_id') ?>

    <?= $form->field($model, 'job_dep_id') ?>

    <?= $form->field($model, 'job_dep_desc') ?>

    <?= $form->field($model, 'job_date') ?>

    <?= $form->field($model, 'job_status') ?>

    <?php // echo $form->field($model, 'job_price') ?>

    <?php // echo $form->field($model, 'job_done_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
