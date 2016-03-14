<?php

namespace frontend\controllers;
use yii;

?>
<?php
class ReportopdController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        
        
        return $this->render('index');
    }
    
    public function actionSumopd() {
        $date1=  date('Y-m-d');
        $date2=  date('Y-m-d');
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
       $all_sql="SELECT
SUM(CASE WHEN (ov.vsttime BETWEEN '16:30:01' AND '24:00:00' or ov.vsttime BETWEEN '00:00:00' AND '08:29:59') THEN 1 ELSE 0 END) AS outtime
,SUM(CASE WHEN ov.vsttime BETWEEN '08:30:00' AND '16:30:00' THEN 1 ELSE 0 END) AS intime
,COUNT(ov.vn) AS cc,COUNT(DISTINCT ov.hn) AS dissum
FROM	ovst AS ov WHERE ov.vstdate BETWEEN '$date1' AND '$date2'";
       $opd_all="SELECT SUM(CASE WHEN (ov.vsttime BETWEEN '16:30:01' AND '24:00:00' or ov.vsttime BETWEEN '00:00:00' AND '08:29:59') THEN 1 ELSE 0 END) AS outtime
,SUM(CASE WHEN ov.vsttime BETWEEN '08:30:00' AND '16:30:00' THEN 1 ELSE 0 END) AS intime
,COUNT(ov.vn) AS cc,COUNT(DISTINCT ov.hn) AS dissum
FROM	ovst AS ov WHERE ov.vstdate BETWEEN '$date1' and '$date2'
AND ov.vn not in (SELECT vn from er_regist WHERE vstdate BETWEEN '$date1' and '$date2')";
       $er_sql="SELECT SUM(CASE WHEN (ov.vsttime BETWEEN '16:30:01' AND '24:00:00' or ov.vsttime BETWEEN '00:00:00' AND '08:29:59') THEN 1 ELSE 0 END) AS outtime
,SUM(CASE WHEN ov.vsttime BETWEEN '08:30:00' AND '16:30:00' THEN 1 ELSE 0 END) AS intime
,COUNT(ov.vn) AS cc,COUNT(DISTINCT ov.hn) AS dissum
FROM	ovst AS ov INNER JOIN er_regist AS er ON er.vn=ov.vn
WHERE ov.vstdate BETWEEN '$date1' and '$date2'";
       $dent_sql="SELECT COUNT(dt.vn) AS cc,COUNT(DISTINCT dt.hn) AS dissum
FROM dtmain AS dt WHERE dt.vstdate BETWEEN '$date1' AND '$date2'";
       $anc_sql="SELECT COUNT(s.vn) as cc
,COUNT(DISTINCT s.person_anc_id) as dissum FROM person_anc_service as s
WHERE s.anc_service_date BETWEEN '$date1' and '$date2'";
        $rsall = \Yii::$app->hosxp->createCommand("$all_sql")->queryAll();
        $rsopd_all = \Yii::$app->hosxp->createCommand("$opd_all")->queryAll();
        $er = \Yii::$app->hosxp->createCommand("$er_sql")->queryAll();
        $rsdent = \Yii::$app->hosxp->createCommand("$dent_sql")->queryAll();
        $rsanc = \Yii::$app->hosxp->createCommand("$anc_sql")->queryAll();
        return $this->render('sumopd',[
            'date1'=>$date1,
            'date2'=>$date2,
            'rsall'=>$rsall,
            'rsopd_all'=>$rsopd_all,
            'er'=>$er,
            'rsdent'=>$rsdent,
            'rsanc'=>$rsanc,
        ]);
        }
        /////////////// ก่อน post///////////////
        return $this->render('sumopd',[
            'date1'=>$date1,
            'date2'=>$date2,
        ]);
    }
    
    public function actionTop20() {
        $date1=  date('Y-m-d');
        $date2=  date('Y-m-d');
         if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
       $sql="select v.icd10 AS diag,i.NAME,count(DISTINCT v.vn) AS n,
	count(DISTINCT v.hn) AS dis FROM ovstdiag v
	JOIN icd101 AS i on v.icd10=i.code WHERE
	v.icd10 = i.code AND ( v.icd10 NOT like 'V%' AND v.icd10 NOT like 'W%' AND v.icd10 NOT like 'X%'
AND v.icd10 NOT like 'Y%' AND v.icd10 NOT like 'Z%') AND v.vstdate 
BETWEEN '$date1' and '$date2' GROUP BY v.icd10,i.name ORDER BY n DESC LIMIT 20";
         $rs = \Yii::$app->hosxp->createCommand("$sql")->queryAll();
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

}
?>