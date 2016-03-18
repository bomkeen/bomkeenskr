<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="../../img/logo.png" class="pull-left"/>โรงพยาบาลสมเด็จพระสังฆราช',
        
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'โปรแกรมระบบงาน','items'=>[
        ['label' => 'โปรแกรมบันทึกวันอบรม', 'url' => 'http://192.168.1.161/tm','linkOptions' => ['target' => '_blank']],
        ['label' => 'โปรแกรม Chronic Link', 'url' => 'http://203.157.126.45/ncd/chronic/index.php','linkOptions' => ['target' => '_blank']],
        ['label' => 'ต้น Chart', 'url' => ['/chart']],
            ['label' => 'แผนการจัดซื้อ', 'url' =>'http://192.168.1.253/office','linkOptions' => ['target' => '_blank']],
      ['label' => 'backend', 'url'=>\Yii::$app->urlManagerBackend->baseUrl],
Yii::$app->user->isGuest ?
['label' => 'ลงชื่อใช้งาน', 'url' => ['/user/security/login']] :
['label' => 'Account(' . Yii::$app->user->identity->username . ')', 'items'=>[
    ['label' => 'Profile', 'url' => ['/user/settings/profile']],
    ['label' => 'Account', 'url' => ['/user/settings/account']],
    ['label' => 'Logout', 'url' => ['/user/security/logout'],'linkOptions' => ['data-method' => 'post']],
]],
['label' => 'สมัครเข้าใช้งาน', 'url' => ['/user/registration/register'], 'visible' => Yii::$app->user->isGuest],
    
]],
        ['label' => 'ข้อมูล 43 แฟ้ม', 'url' => 'http://192.168.1.161/somdej/43_main.php','linkOptions' => ['target' => '_blank']],
        ['label' => 'GIS', 'url' => ['/gis']],
        ['label' => 'ระบบรายงาน', 'url' => ['/report']],
        ['label' => 'ระบบเอกสาร', 'url' =>'http://192.168.1.161/document_center','linkOptions' => ['target' => '_blank']],
        ['label' => 'ระบบความเสี่ยง', 'url' =>'http://192.168.1.161/risk','linkOptions' => ['target' => '_blank']],
       

    ];
   
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav  navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; โรงพยาบาลสมเด็จพระสังฆราช (นครหลวง) <?= date('Y') ?></p>

      
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
