<?php

namespace frontend\controllers;
use yii;

?>
<?php


class ReportipdController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        return $this->render('index');
    }
    
     public function actionTop20() {
        $date1=  date('Y-m-d');
        $date2=  date('Y-m-d');
         if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
       $sql="select v.icd10 AS diag,i.NAME,count(DISTINCT v.an) AS n,count(DISTINCT ipt.hn) AS dis
FROM iptdiag v JOIN ipt ON v.an=ipt.an JOIN icd101 AS i on v.icd10=i.code
WHERE (v.icd10 NOT like 'V%' AND v.icd10 NOT like 'W%' AND v.icd10 NOT like 'X%'
AND v.icd10 NOT like 'Y%' AND v.icd10 NOT like 'Z%')
AND ipt.dchdate BETWEEN '$date1' and '$date2' GROUP BY v.icd10,i.name
ORDER BY n DESC LIMIT 20";
         $rs = \Yii::$app->hosxpslave->createCommand("$sql")->queryAll();
              $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rs,
            'pagination' => FALSE,
        ]);
         
        return $this->render('top20',[
             'date1'=>$date1,
             'date2'=>$date2,
            'dataProvider'=>$dataProvider,
             
         ]);
         }
        
        return $this->render('top20',[
            'date1'=>$date1,
            'date2'=>$date2,
        ]);
        
    }
    
    public function actionIpdratio() {
         $date1="2014-10-01";
            $date2="2015-09-31";
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $year=$request->post('year');
            $date1=((int) $year - 1).'-10-01';
            $date2 = $year.'-9-30';
          $m = \Yii::$app->hosxpslave->createCommand("SELECT a.dchdate as m FROM an_stat a
WHERE a.dchdate  BETWEEN '$date1' AND '$date2'
GROUP BY MONTH(a.dchdate) ORDER BY a.dchdate")->queryAll();  
          //อัตราการตาย
          $d_m=\Yii::$app->hosxpslave->createCommand("SELECT 
FORMAT(((COUNT(d.hn)*1000)/COUNT(a.vn)),2) AS cc
FROM an_stat a
LEFT OUTER JOIN death as d on d.an=a.an
WHERE a.dchdate  BETWEEN '$date1' AND '$date2'
GROUP BY MONTH(a.dchdate) ORDER BY a.dchdate")->queryAll();
          $d=\Yii::$app->hosxpslave->createCommand("SELECT 
FORMAT(((COUNT(d.hn)*1000)/COUNT(a.vn)),2) as cc
FROM an_stat a
LEFT OUTER JOIN death as d on d.an=a.an
WHERE a.dchdate  BETWEEN '$date1' AND '$date2' ORDER BY a.dchdate")->queryAll(); 
          /// อัตราครองเตียง
          $bed_m=\Yii::$app->hosxpslave->createCommand("SELECT 
format(((SUM(a.admdate_cut24)*100)/(30*DATE_FORMAT(LAST_DAY(a.dchdate), '%e') )),2) as cc
FROM an_stat a
WHERE a.dchdate  BETWEEN '$date1' AND '$date2' GROUP BY MONTH(a.dchdate) ORDER BY a.dchdate")->queryAll(); 
          $bed=\Yii::$app->hosxpslave->createCommand("SELECT FORMAT(((SUM(a.admdate_cut24)*100)/(30*365)),2) as cc
FROM an_stat a
WHERE a.dchdate  BETWEEN '$date1' AND '$date2' ORDER BY a.dchdate")->queryAll(); 
          //อัตราการใช้เตียง
           $bed_use_m=\Yii::$app->hosxpslave->createCommand("SELECT 
format((count(a.an)/30),2) as cc
FROM an_stat as a
WHERE a.dchdate BETWEEN '$date1' AND '$date2'
GROUP BY MONTH(a.dchdate) ORDER BY a.dchdate")->queryAll();
            $bed_use=\Yii::$app->hosxpslave->createCommand("SELECT 
format((count(a.an)/30),2) as cc                      
FROM an_stat as a
WHERE a.dchdate BETWEEN '$date1' AND '$date2' ORDER BY a.dchdate")->queryAll();
        //วันนอนเฉลี่ย
          $day_m=\Yii::$app->hosxpslave->createCommand("SELECT 
format(SUM(a.admdate_cut24)/COUNT(a.an),2) as cc
FROM an_stat as a
WHERE a.dchdate BETWEEN '$date1' AND '$date2'
GROUP BY MONTH(a.dchdate)
ORDER BY a.dchdate")->queryAll();
           $day=\Yii::$app->hosxpslave->createCommand("SELECT 
format(SUM(a.admdate_cut24)/COUNT(a.an),2) as cc                     
FROM an_stat as a
WHERE a.dchdate BETWEEN '$date1' AND '$date2'
ORDER BY a.dchdate")->queryAll(); 
       //วันนอนรวม
          $day_sum=\Yii::$app->hosxpslave->createCommand("SELECT 
format(SUM(a.admdate_cut24),0) as cc
FROM an_stat as a
WHERE a.dchdate BETWEEN '$date1' AND '$date2'
GROUP BY MONTH(a.dchdate)
ORDER BY a.dchdate")->queryAll(); 
           $day_sum_y=\Yii::$app->hosxpslave->createCommand("SELECT 
format(SUM(a.admdate_cut24),0) as cc
FROM an_stat as a
WHERE a.dchdate BETWEEN '$date1' AND '$date2'
ORDER BY a.dchdate")->queryAll(); 
     ////// จำนวนผู้ป่วยใน
              $man_sum=\Yii::$app->hosxpslave->createCommand("SELECT 
count(DISTINCT a.an) as cc
FROM an_stat as a
WHERE a.dchdate BETWEEN '$date1' AND '$date2'
GROUP BY MONTH(a.dchdate)
ORDER BY a.dchdate")->queryAll();
              $man_y=\Yii::$app->hosxpslave->createCommand("SELECT 
count(DISTINCT a.an) as cc
FROM an_stat as a
WHERE a.dchdate BETWEEN '$date1' AND '$date2'
ORDER BY a.dchdate")->queryAll(); 
              
              ////readmit
              $re_ratio=\Yii::$app->hosxpslave->createCommand("SELECT
format(((SUM(CASE WHEN (TO_DAYS(an2.dchdate)-TO_DAYS(an.dchdate)) BETWEEN 0 AND 28 AND an.pdx=an2.pdx THEN 1 ELSE 0 END)*100)/count(an.hn)),2) as re_ratio
FROM an_stat AS an
LEFT OUTER JOIN an_stat AS an2 ON an2.hn=an.hn AND an2.an>an.an AND an2.an IS NOT NULL
WHERE an.dchdate BETWEEN '$date1' AND '$date2'  AND (
an.pdx NOT LIKE 'V%' AND an.pdx NOT LIKE 'W%' AND an.pdx 
NOT LIKE 'X%' AND an.pdx NOT LIKE 'Y%' AND an.pdx NOT LIKE 'Z%')
GROUP BY MONTH(an.dchdate)")->queryAll();
               $re_ratio_y=\Yii::$app->hosxpslave->createCommand("SELECT
format(((SUM(CASE WHEN (TO_DAYS(an2.dchdate)-TO_DAYS(an.dchdate)) BETWEEN 0 AND 28 AND an.pdx=an2.pdx THEN 1 ELSE 0 END)*100)/count(an.hn)),2) as re_ratio
FROM an_stat AS an
LEFT OUTER JOIN an_stat AS an2 ON an2.hn=an.hn AND an2.an>an.an AND an2.an IS NOT NULL
WHERE an.dchdate BETWEEN '$date1' AND '$date2'  AND (
an.pdx NOT LIKE 'V%' AND an.pdx NOT LIKE 'W%' AND an.pdx 
NOT LIKE 'X%' AND an.pdx NOT LIKE 'Y%' AND an.pdx NOT LIKE 'Z%')")->queryAll(); 
              
        return $this->render('ipdratio',[
            'm'=>$m,
            'd_m'=>$d_m,
            'd'=>$d,
            'bed_m'=>$bed_m,
            'bed'=>$bed,
            'bed_use_m'=>$bed_use_m,
            'bed_use'=>$bed_use,
            'day_m'=>$day_m,
            'day'=>$day,
            'day_sum'=>$day_sum,
            'day_sum_y'=>$day_sum_y,
            'man_sum'=>$man_sum,
            'man_y'=>$man_y,
            're_ratio'=>$re_ratio,
            're_ratio_y'=>$re_ratio_y,
            'date1'=>$date1,
            'date2'=>$date2,
                              
        ]);
        }
 else {
            return $this->render('ipdratio');
 }
    }

}
