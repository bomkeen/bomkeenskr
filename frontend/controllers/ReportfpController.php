<?php

namespace frontend\controllers;
use kartik\mpdf\Pdf;
use yii;
?>
<?php

class ReportfpController extends \yii\web\Controller {
  public $enableCsrfValidation = false;
   
  public function actionIndex() {
        return $this->render('index');
    }

    public function actionVaccine() {
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
            $export = $request->post('export');
            $vac_in_sql = "SELECT COUNT(*) as n,pv.vaccine_name as name FROM person_vaccine_list AS pvl 
JOIN person_vaccine pv ON pvl.person_vaccine_id=pv.person_vaccine_id
WHERE pvl.vaccine_date BETWEEN '$date1' and '$date2'
GROUP BY pvl.person_vaccine_id ";
            $vac_out_sql = "SELECT COUNT(*) as n,vaccine_name as name FROM ovst_vaccine opv
JOIN person_vaccine pv ON opv.person_vaccine_id=pv.person_vaccine_id
JOIN ovst ov ON opv.vn=ov.vn
WHERE ov.vstdate BETWEEN '$date1' and '$date2'
GROUP BY opv.person_vaccine_id";

            $vac_in = \Yii::$app->hosxpslave->createCommand("$vac_in_sql")->queryAll();
            $vac_out = \Yii::$app->hosxpslave->createCommand("$vac_out_sql")->queryAll();
            ///////////////////   PDF   ////////////////////////////////////////////            
//
            if ($export == 'pdf') {
                $content = $this->renderPartial('vaccine', [
                    'date1' => $date1,
                    'date2' => $date2,
                    'vac_in' => $vac_in,
                    'vac_out' => $vac_out,
                    'export' => $export,
                ]);
                $pdf = new Pdf([
                    'mode' => Pdf::MODE_CORE,
                    'content' => $content,
                    'options' => ['title' => 'สรุปข้อมูลกาให้บริการ vaccine'],
                    'methods' => [
                        'SetHeader' => ['สรุปข้อมูลกาให้บริการ vaccine'],
                        'SetFooter' => ['{PAGENO}'],
                    ]
                ]);
                return $pdf->render();
            }
            //////////////////////////////////////////////////       
            else {
                return $this->render('vaccine', [
                            'date1' => $date1,
                            'date2' => $date2,
                            'vac_in' => $vac_in,
                            'vac_out' => $vac_out,
                            'export' => $export,
                ]);
            }
        }
        return $this->render('vaccine', [
                    'date1' => $date1,
                    'date2' => $date2,
        ]);
    }

}
