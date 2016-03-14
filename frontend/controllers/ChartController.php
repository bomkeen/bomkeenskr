<?php

namespace frontend\controllers;
use frontend\models\Ipt;
use frontend\models\TempHn;
use common\models\RentChart;
use yii;

class ChartController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
       $model = new TempHn ;
       $rent=new RentChart();
     
         if ($rent->load(Yii::$app->request->post()) && $rent->save()){
          Yii::$app->getSession()->setFlash('alert',[
                'body'=>'บันทึกเรยบร้อยครับผมมมม',
                'options'=>['class'=>'alert-success']
            ]);      
               return $this->render('index', [
                'model' => $model,
               ]);
         }
    
       if ($model->load(Yii::$app->request->post())) {
                    
            $hn = $model->hn;  
          
        $chart=  \yii::$app->hosxpslave->
                createCommand("SELECT t.an as an,t.dchdate as dchdate,t.hn as hn
,d.name as dchname 
,r.checkin as checkin
,r.rent_date as rent_date
,r.comment as comment
,o.name as rent_name
FROM ipt t
LEFT OUTER JOIN ipdrent r ON t.an=r.an
LEFT OUTER JOIN doctor d ON t.dch_doctor=d.code
LEFT OUTER JOIN opduser o ON o.loginname=r.rent_user
WHERE t.hn=$hn ORDER BY t.an DESC limit 1
")->queryAll();
        if(!$chart){
            Yii::$app->getSession()->setFlash('none_an',[
                'body'=>'ไม่เคย Admit',
                'options'=>['class'=>'alert-danger']
            ]);      
               return $this->render('index', [
                'model' => $model,
               ]);
        }
        
             return $this->render('index', [
                'model' => $model,
                 'chart'=> $chart,
                 'rent'=>$rent,
            ]);
       } else {
            return $this->render('index', [
                'model' => $model,
                'rent'=>$rent,
            ]);
       }
           
        
    }
    
    public function actionNote() {
        $model=new RentChart();
        $date=  date("Y-m-d");
         if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $an = $request->post('an');
            $dep=$request->post('dep');
            $model->rent_chart_an=$an;
            $model->rent_chart_date=$date;
            $model->rent_chart_dep=$dep;
            $model->save();
         }
             
        
        return $this->render('index');
        
    }


}
