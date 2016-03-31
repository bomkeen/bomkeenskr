<?php

namespace frontend\controllers;
use yii;
?>
<?php 
class F43Controller extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionLabfu() {
         $d = \Yii::$app->hdc->createCommand("SELECT DATE_SERV as label,CONCAT(year(DATE_SERV),'-',DATE_FORMAT(DATE_SERV, '%m'),'%') as v 
FROM service GROUP BY MONTH(DATE_SERV),year(DATE_SERV) order by date_serv DESC")->queryAll(); 
        
         if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $yymm = $request->post('yymm');
            //$date2 = $request->post('date2');
       $sql="SELECT CONCAT(ln.id_labtest,'-',ln.labtest) AS lab,COUNT(ln.labtest) AS n,SUM(CASE WHEN s.INSTYPE =0100 THEN '1' ELSE '0' end) AS uc,SUM(CASE WHEN s.INSTYPE <>0100 THEN '1' ELSE '0' end) AS nonuc,lf.DATE_SERV as fdate
FROM labfu AS lf JOIN clabtest AS ln ON lf.LABTEST=ln.id_labtest
 LEFT OUTER JOIN service AS s ON lf.SEQ=s.SEQ 
 WHERE lf.DATE_SERV LIKE '$yymm' GROUP BY lf.LABTEST ORDER BY lf.LABTEST";
         $rs = \Yii::$app->hdc->createCommand("$sql")->queryAll();
              $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rs,
            'pagination' => FALSE,
        ]);
         
        return $this->render('labfu',[
            'yymm'=>$yymm,
                'd'=>$d,
            'dataProvider'=>$dataProvider,
             
         ]);
         }
 else {
        return $this->render('labfu',[
            //'yymm'=>$yymm,
            'd'=>$d,
         
        ]);
     
 }
    }
    
    public function actionChronicfu() {
         $d = \Yii::$app->hdc->createCommand("SELECT DATE_SERV as label,CONCAT(year(DATE_SERV),'-',DATE_FORMAT(DATE_SERV, '%m'),'%') as v 
FROM service GROUP BY MONTH(DATE_SERV),year(DATE_SERV) order by date_serv DESC")->queryAll(); 
        
         if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $yymm = $request->post('yymm');
            //$date2 = $request->post('date2');
       $sql="SELECT SUM(CASE WHEN cf.FOOT IN ('1','3') THEN 1 ELSE 0 END) AS foot,SUM(CASE WHEN cf.RETINA <8 THEN 1 ELSE 0 END) AS ratina
,COUNT(*) AS sum,cf.DATE_SERV as fdate FROM chronicfu AS cf WHERE cf.DATE_SERV LIKE '$yymm' order by cf.date_serv";
         $rs = \Yii::$app->hdc->createCommand("$sql")->queryAll();
              $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rs,
            'pagination' => FALSE,
        ]);
         
        return $this->render('chronicfu',[
            'yymm'=>$yymm,
                'd'=>$d,
            'dataProvider'=>$dataProvider,
             
         ]);
         }
 else {
        return $this->render('chronicfu',[
            //'yymm'=>$yymm,
            'd'=>$d,
         
        ]);
     
 }
    }
     public function actionEpi() {
         $d = \Yii::$app->hdc->createCommand("SELECT DATE_SERV as label,CONCAT(year(DATE_SERV),'-',DATE_FORMAT(DATE_SERV, '%m'),'%') as v 
FROM service GROUP BY MONTH(DATE_SERV),year(DATE_SERV) order by date_serv DESC")->queryAll(); 
        
         if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $yymm = $request->post('yymm');
            //$date2 = $request->post('date2');
       $sql="SELECT vc.thvaccine as vac,COUNT(epi.SEQ) as n,epi.DATE_SERV as fdate FROM epi 
JOIN cvaccinetype AS vc on epi.VACCINETYPE=vc.id_vaccinetype
WHERE epi.DATE_SERV LIKE '$yymm'
GROUP BY epi.VACCINETYPE  order by epi.date_serv";
         $rs = \Yii::$app->hdc->createCommand("$sql")->queryAll();
              $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rs,
            'pagination' => FALSE,
        ]);
         
        return $this->render('epi',[
            'yymm'=>$yymm,
                'd'=>$d,
            'dataProvider'=>$dataProvider,
             
         ]);
         }
 else {
        return $this->render('epi',[
            //'yymm'=>$yymm,
            'd'=>$d,
         
        ]);
     
 }
    }

}
