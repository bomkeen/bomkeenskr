<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\JobDep */

$this->title = 'Create Job Dep';
$this->params['breadcrumbs'][] = ['label' => 'Job Deps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-dep-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
