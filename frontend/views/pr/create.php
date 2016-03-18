<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Pr */

$this->title = 'Create Pr';
$this->params['breadcrumbs'][] = ['label' => 'Prs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pr-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
