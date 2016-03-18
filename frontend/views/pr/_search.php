<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PrSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pr-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pr_id') ?>

    <?= $form->field($model, 'pr_desc') ?>

    <?= $form->field($model, 'pr_link') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'pr_date_insert') ?>

    <?php // echo $form->field($model, 'pr_own') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
