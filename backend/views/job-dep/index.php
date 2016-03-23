<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\JobDepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Job Deps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-dep-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Job Dep', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'job_dep_id',
            'job_dep_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
