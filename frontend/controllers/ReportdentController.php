<?php

namespace frontend\controllers;
use yii;
?>

<?php
class ReportdentController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionDetail() {
        $date1=  date('Y-m-d');
        $date2=  date('Y-m-d');
         if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
             $sql="SELECT 
dt.dental_care_type_name
,COUNT(d.vn) as sum 
from dental_care d
inner JOIN ovst ov on d.vn=ov.vn 
JOIN dental_care_type dt ON d.dental_care_type_id=dt.dental_care_type_id
where ov.vstdate BETWEEN '$date1' and '$date2' GROUP BY d.dental_care_type_id";
         $rs = \Yii::$app->hosxpslave->createCommand("$sql")->queryAll();
              $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rs,
            'pagination' => FALSE,
        ]); 
            return $this->render('detail',[
            'date1'=>$date1,
            'date2'=>$date2,
                'dataProvider'=>$dataProvider,
        ]);  
         }
 else {
        return $this->render('detail',[
            'date1'=>$date1,
            'date2'=>$date2,
        ]);
 }
    }
    
    public function actionDttm() {
        $date1=  date('Y-m-d');
        $date2=  date('Y-m-d');
         if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
             $sql="SELECT COUNT(dt.vn) AS vn
,COUNT(DISTINCT dt.hn) AS hn
,dm.name
FROM dtmain AS dt
JOIN dttm AS dm ON dt.tmcode=dm.code
WHERE dt.vstdate BETWEEN '$date1' and '$date2'
GROUP BY dt.tmcode ORDER BY vn DESC";
         $rs = \Yii::$app->hosxpslave->createCommand("$sql")->queryAll();
              $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rs,
            'pagination' => FALSE,
        ]); 
            return $this->render('dttm',[
            'date1'=>$date1,
            'date2'=>$date2,
                'dataProvider'=>$dataProvider,
        ]);  
         }
 else {
        return $this->render('dttm',[
            'date1'=>$date1,
            'date2'=>$date2,
        ]);
 }
    }
    

}
