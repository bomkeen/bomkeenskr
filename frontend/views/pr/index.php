<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PrSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pr-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pr', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pr_id',
            'pr_desc',
            'pr_link',
            'status',
            'pr_date_insert',
            // 'pr_own',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
