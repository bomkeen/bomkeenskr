<?php

namespace frontend\controllers;
use kartik\mpdf\Pdf;
use yii;
?>

<?php



class ReportdrugController extends \yii\web\Controller
{
      public $enableCsrfValidation = false;
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionCost() {
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
            $export = $request->post('export');
            $cost_sql = "SELECT 
SUM(IF((op.vsttime BETWEEN '16:30:01' AND '24:00:00' or op.vsttime BETWEEN '00:00:00' AND '08:29:59') AND op.vn IS NOT null,op.sum_price,0)) AS opd_out
,SUM(IF(op.vsttime BETWEEN '08:30:00' AND '16:30:00'  AND op.vn IS NOT null,op.sum_price,0)) AS opd_in
,SUM(IF((op.vsttime BETWEEN '16:30:01' AND '24:00:00' or op.vsttime BETWEEN '00:00:00' AND '08:29:59') AND op.an IS NOT null,op.sum_price,0)) AS ipd_out
,SUM(IF(op.vsttime BETWEEN '08:30:00' AND '16:30:00'  AND op.an IS NOT null,op.sum_price,0)) AS ipd_in
,SUM(IF(op.vsttime IS NULL,op.sum_price,0)) AS non_time
,sum(op.sum_price) AS total
FROM opitemrece AS op
WHERE op.vstdate BETWEEN '$date1' and '$date2'
AND op.icode LIKE '1%'";
           

            $cost = \Yii::$app->hosxpslave->createCommand("$cost_sql")->queryAll();
            
            ///////////////////   PDF   ////////////////////////////////////////////            
//
            if ($export == 'pdf') {
                $content = $this->renderPartial('cost', [
                    'date1' => $date1,
                    'date2' => $date2,
                    'cost' => $cost,
                    'export' => $export,
                ]);
                $pdf = new Pdf([
                    'mode' => Pdf::MODE_CORE,
                    'content' => $content,
                    'options' => ['title' => 'สรุปค่าใช้จ่ายในการใช้ยา'],
                    'methods' => [
                        'SetHeader' => ['สรุปค่าใช้จ่ายในการใช้ยา'],
                        'SetFooter' => ['{PAGENO}'],
                    ]
                ]);
                return $pdf->render();
            }
            //////////////////////////////////////////////////       
            else {
                return $this->render('cost', [
                            'date1' => $date1,
                            'date2' => $date2,
                            'cost' => $cost,
                            'export' => $export,
                ]);
            }
        }
        return $this->render('cost', [
                    'date1' => $date1,
                    'date2' => $date2,
        ]);
    }
    
    public function actionItem() {
         $date1=  date('Y-m-d');
        $date2=  date('Y-m-d');
         if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
       $sql="SELECT 
COUNT(DISTINCT op.vn) AS rx
,COUNT(DISTINCT ov.hn) AS person
,d.name AS dname
,SUM(op.sum_price) AS price
from ovst ov 
JOIN opitemrece op ON ov.vn=op.vn
JOIN drugitems d ON op.icode=d.icode
WHERE ov.vstdate BETWEEN '$date1' AND '$date2'
GROUP BY op.icode
ORDER BY price DESC LIMIT 20";
         $rs = \Yii::$app->hosxpslave->createCommand("$sql")->queryAll();
              $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rs,
            'pagination' => FALSE,
        ]);
         
        return $this->render('item',[
             'date1'=>$date1,
             'date2'=>$date2,
            'dataProvider'=>$dataProvider,
             
         ]);
         }
        
        return $this->render('item',[
            'date1'=>$date1,
            'date2'=>$date2,
        ]);
    }
    
    

}
