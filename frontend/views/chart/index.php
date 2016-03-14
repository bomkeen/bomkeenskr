<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
$daterent=  date('Y-m-d');


?>

<?php if(Yii::$app->session->hasFlash('alert')):?>
    <?= \yii\bootstrap\Alert::widget([
    'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
    'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
    ])?>
<?php endif; ?>

<?php if(Yii::$app->session->hasFlash('none_an')):?>
    <?= \yii\bootstrap\Alert::widget([
    'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('none_an'), 'body'),
    'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('none_an'), 'options'),
    ])?>
<?php endif; ?>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'search']); ?>

                <?= $form->field($model, 'hn')->textInput(['autofocus' => true]) ?>
               <div class="form-group">
                    <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary', 'name' => 'search']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
<div class="row">
    <?php if (isset($chart)) { ?>
    <?php foreach ($chart as $c) ?>
    <div class="col-md-10 col-md-offset-1">
        <p><h4>รายการ Admit ล่าสุด</h4></p>
        <table class="table table-bordered">
            <tr>
            <th>
                AN
            </th>
            <th>
                DCH Date
            </th>
            <th>
                Dch Doctor
            </th>
            </tr>
            <tr>
                <td>
                    <?php echo $c['an']; ?>
                </td>
                <td>
                   <?php 
                   function thaidate($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
                   echo thaidate($c['dchdate']); 
             ?>
                </td>
                <td>
                   <?php echo $c['dchname'];?> 
                </td>
             </tr>
        </table>
    <?php if($c['checkin']=='N'){ ?>
    <p><h4><label class="label label-danger">รายการยืม Chart</label></h4></p>
        <table class="table table-bordered">
            <tr>
                <th>
                    วันที่ยืม
                </th>
                <th>
                    Comment
                </th>
                <th>
                    แพทย์ผู้ยืม
                </th>
            </tr>
            <tr>
                <td>
                    <?php echo thaidate($c['rent_date']) ;?>
                </td>
                <td>
                    <?php echo $c['comment'];?>
                </td>
                <td>
                    <?php echo $c['rent_name'];?>
                </td>
            </tr>
        </table>
    
    <?php } ?>
 
      <div class="col-md-6 col-md-offset-0">
<!--          <form  method="post" class="form-inline" action="">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="an" name="an"/>
                </div>
                <div class="form-group">
                    <label for="dep">OPD</label>
                    <input type="radio" name="dep" value="OPD" id="dep" class="form-control"/>
                    <label for="ipd">IPD</label>
                    <input type="radio" name="dep" value="IPD" id="ipd" class="form-control"/>
                    <label for="er">ER</label>
                    <input type="radio" name="dep" value="er" id="er" class="form-control"/>
                </div>

                <button type="submit" class="btn btn-primary glyphicon glyphicon-search"> บันทึกการทำงาน</button>
            </form>-->
            <?php $formrent = ActiveForm::begin(['id' => 'rent']); ?>

                <?= $formrent->field($rent, 'rent_chart_an')->input('hidden',['value'=>$c['an']])?>
                <?= $formrent->field($rent, 'rent_chart_date')->input('hidden',['value'=>$daterent])?>
<div class="form-group">
<?= $formrent->field($rent, 'rent_chart_dep')->radioList(array('opd'=>'OPD','ipd'=>'IPD','er'=>'ER')); ?>
</div>
    <div class="form-group">
                    <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary', 'name' => 'rent']) ?>
                </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
    <?php } ?>
</div>
