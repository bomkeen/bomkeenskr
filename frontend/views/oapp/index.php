<div class="row">
    <?php
    $this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน', 'url' => ['report/index']];
   ?>
<div class="col-md-8 col-md-offset-2">
        <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
      'events'=> $events,
             'options' => [
        'lang' => 'th',
        //... more options to be defined here!
      ],
         
  ));?>
    </div>
</div>