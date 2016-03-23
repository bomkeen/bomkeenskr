<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\JobDep;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Job */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'job_dep_id')->dropDownList(
                    ArrayHelper::map(JobDep::find()->all(), 'job_dep_id', 'job_dep_name'), ['prompt' => 'เลือกหน่วยงาน']
            )
            ?>

    <?= $form->field($model, 'job_dep_desc')->textarea()->label('Description'); ?>
    <?= $form->field($model, 'job_date')->widget(DatePicker::ClassName(),
    [
    'name' => 'job_date', 
    'options' => ['placeholder' => 'เลือกวันที่'],
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true,
        'language'=>'th'
    ]
]);?>

    <?= $form->field($model, 'job_status')->radioList(array('Y'=>'Done','N'=>'Wait')); ?>

    <?= $form->field($model, 'job_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'job_done_date')->widget(DatePicker::ClassName(),
    [
    'name' => 'job_done_date', 
    'options' => ['placeholder' => 'เลือกวันที่'],
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true,
        'language'=>'Th'
    ]
]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
