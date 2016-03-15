<?php 
namespace frontend\controllers;
use yii;

?>

<?php



class ErreportController extends \yii\web\Controller
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
       $sql="SELECT
	a.pdx,
	count(DISTINCT a.hn) AS dis,
COUNT(a.vn) AS n,
i.name as diag
FROM
	vn_stat a
LEFT OUTER JOIN icd101 i ON i. CODE = a.pdx
WHERE
	a.vstdate between '$date1' and '$date2' 
AND a.pdx <> ''
AND a.pdx IS NOT NULL
AND a.vn IN (SELECT vn FROM er_regist)
AND (a.pdx NOT like 'I10%' and a.pdx not BETWEEN 'E10' AND 'E149' 
AND a.pdx NOT like 'V%' AND a.pdx NOT like 'W%' AND a.pdx NOT like 'X%'
AND a.pdx NOT like 'Y%' AND a.pdx NOT like 'Z%'
)
GROUP BY
	a.pdx,
	i.NAME
ORDER BY	dis DESC LIMIT 20";
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
    
    public function actionDetail() {
         $date1=  date('Y-m-d');
        $date2=  date('Y-m-d');
         if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
             $sql="select distinct a.er_period,b.name, 
  count(case when a.er_pt_type = '1' then a.vn end) as 'Pt_1', 
  count(case when a.er_pt_type = '2' then a.vn end) as 'Pt_2', 
  count(case when a.er_pt_type = '3' then a.vn end) as 'Pt_3', 
  count(case when a.er_pt_type not in ('1','2','3') then a.vn end) as 'Pt_4', 
  count(case when a.er_emergency_type = '1' then a.vn end) as 'Emer_1', 
  count(case when a.er_emergency_type = '2' then a.vn end) as 'Emer_2', 
  count(case when a.er_emergency_type = '3' then a.vn end) as 'Emer_3', 
  count(case when a.er_emergency_type = '4' then a.vn end) as 'Emer_4', 
  count(case when a.er_emergency_type not in ('1','2','3','4') then a.vn end) as 'Emer_5', 
  count(case when a.er_dch_type not in ('2','3','4','5','6') then a.vn end) as 'Dch_1', 
  count(case when a.er_dch_type = '2' then a.vn end) as 'Dch_2', 
  count(case when a.er_dch_type = '3' then a.vn end) as 'Dch_3', 
  count(case when a.er_dch_type = '4' then a.vn end) as 'Dch_4', 
  count(case when a.er_dch_type = '5' then a.vn end) as 'Dch_5', 
  count(case when a.er_dch_type = '6' then a.vn end) as 'Dch_6', 
  count(a.vn) as 'VisitTotal', 
  sum(c.income) as 'MoneyTotal' 
  from er_regist a 
  left outer join er_period b on b.er_period = a.er_period 
  left outer join vn_stat c on c.vn = a.vn 
  where a.vstdate BETWEEN '2015-10-01' and '2015-10-31'
  group by  a.er_period 
  order by a.vstdate, a.er_period";
         $rs = \Yii::$app->hosxpslave->createCommand("$sql")->queryAll();
            
          return $this->render('detail',[
            'date1'=>$date1,
            'date2'=>$date2,
            'rs'=>$rs,
        ]);
         
         
         }
 else {
        return $this->render('detail',[
            'date1'=>$date1,
            'date2'=>$date2,
           
        ]);
 }
    }
}
