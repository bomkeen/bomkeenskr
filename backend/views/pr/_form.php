<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Pr */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="col-md-8 col-md-offset-2">
<div class="pr-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'pr_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pr_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->radioList(array('Y'=>'Active','N'=>'None Active')); ?>

    <?= $form->field($model, 'pr_date_insert')->widget(DatePicker::ClassName(),
    [
    'name' => 'pr_date_insert', 
    'options' => ['placeholder' => 'เลือกวันที่'],
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true,
        'language'=>Yii::$app->language
    ]
]);?>

    <?= $form->field($model, 'pr_own')->textInput(['maxlength' => true]) ?>
   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
