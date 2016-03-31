<?php

namespace frontend\controllers;
use kartik\mpdf\Pdf;
use yii;
?>
<?php 

class ReportlabController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        return $this->render('index');
    }
    
     public function actionWorkload() {
         $date1="2014-10-01";
            $date2="2015-09-31";
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $year=$request->post('year');
            $date1=((int) $year - 1).'-10-01';
            $date2 = $year.'-9-30';
          $m = \Yii::$app->hosxpslave->createCommand("SELECT ov.vstdate as m from ovst ov WHERE ov.vstdate  
              BETWEEN '$date1' and '$date2'
GROUP BY MONTH(ov.vstdate) ORDER BY ov.vstdate")->queryAll(); 
          
           $lab_man_m=\Yii::$app->hosxpslave->createCommand("SELECT COUNT(DISTINCT lh.hn) AS man FROM lab_head AS lh
INNER JOIN lab_order AS lo on lh.lab_order_number=lo.lab_order_number
WHERE lh.order_date BETWEEN '$date1' and '$date2' AND department <> 'IPD'
GROUP BY MONTH(lh.order_date) ORDER BY lh.order_date")->queryAll();
           $lab_man=\Yii::$app->hosxpslave->createCommand("SELECT COUNT(DISTINCT lh.hn) AS man FROM lab_head AS lh
INNER JOIN lab_order AS lo on lh.lab_order_number=lo.lab_order_number
WHERE lh.order_date BETWEEN '$date1' and '$date2' AND department <> 'IPD'")->queryAll();
            $lab_vn_m=\Yii::$app->hosxpslave->createCommand("SELECT COUNT(lo.lab_order_number) AS man FROM lab_head AS lh
INNER JOIN lab_order AS lo on lh.lab_order_number=lo.lab_order_number
WHERE lh.order_date BETWEEN '$date1' and '$date2' AND department <> 'IPD'
GROUP BY MONTH(lh.order_date) ORDER BY lh.order_date")->queryAll();
           $lab_vn=\Yii::$app->hosxpslave->createCommand("SELECT COUNT(lo.lab_order_number) AS man FROM lab_head AS lh
INNER JOIN lab_order AS lo on lh.lab_order_number=lo.lab_order_number
WHERE lh.order_date BETWEEN '$date1' and '$date2' AND department <> 'IPD'")->queryAll();
           
           $lab_ipd_man_m=\Yii::$app->hosxpslave->createCommand("SELECT COUNT(DISTINCT lh.hn) AS man FROM lab_head AS lh
INNER JOIN lab_order AS lo on lh.lab_order_number=lo.lab_order_number
WHERE lh.order_date BETWEEN '$date1' and '$date2' AND department = 'IPD'
GROUP BY MONTH(lh.order_date) ORDER BY lh.order_date")->queryAll();
           $lab_ipd_man=\Yii::$app->hosxpslave->createCommand("SELECT COUNT(DISTINCT lh.hn) AS man FROM lab_head AS lh
INNER JOIN lab_order AS lo on lh.lab_order_number=lo.lab_order_number
WHERE lh.order_date BETWEEN '$date1' and '$date2' AND department = 'IPD'")->queryAll();
            $lab_ipd_vn_m=\Yii::$app->hosxpslave->createCommand("SELECT COUNT(lo.lab_order_number) AS man FROM lab_head AS lh
INNER JOIN lab_order AS lo on lh.lab_order_number=lo.lab_order_number
WHERE lh.order_date BETWEEN '$date1' and '$date2' AND department = 'IPD'
GROUP BY MONTH(lh.order_date) ORDER BY lh.order_date")->queryAll();
           $lab_ipd_vn=\Yii::$app->hosxpslave->createCommand("SELECT COUNT(lo.lab_order_number) AS man FROM lab_head AS lh
INNER JOIN lab_order AS lo on lh.lab_order_number=lo.lab_order_number
WHERE lh.order_date BETWEEN '$date1' and '$date2' AND department = 'IPD'")->queryAll();
      
           
           
              
        return $this->render('workload',[
          
            'date1'=>$date1,
            'date2'=>$date2,
            'm'=>$m,
            'lab_man_m'=>$lab_man_m,
            'lab_man'=>$lab_man,
            'lab_vn_m'=>$lab_vn_m,
            'lab_vn'=>$lab_vn,
            
            'lab_ipd_man_m'=>$lab_man_m,
            'lab_ipd_man'=>$lab_man,
            'lab_ipd_vn_m'=>$lab_vn_m,
            'lab_ipd_vn'=>$lab_vn,
                              
        ]);
        }
 else {
            return $this->render('workload');
 }
    }

}
