<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pr */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pr-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pr_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pr_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pr_date_insert')->textInput() ?>

    <?= $form->field($model, 'pr_own')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
