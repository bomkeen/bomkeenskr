<?php

namespace frontend\controllers;

use yii;
?>
<?php

class ReportncdController extends \yii\web\Controller {

    public $enableCsrfValidation = false;

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionHtdmdiag() {
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
            $ht = "SELECT 'IPD' as ipd,SUM(CASE WHEN iptd.diagtype=1 AND iptd.icd10='I10' THEN 1 ELSE 0 END) as ht
            ,SUM(CASE WHEN iptd.icd10 between 'I600' AND 'I698' and iptd.an in 
            (SELECT iptd.an
            FROM ipt ipt LEFT OUTER JOIN iptdiag as iptd on iptd.an=ipt.an
            WHERE ipt.dchdate BETWEEN '$date1' and '$date2'   AND iptd.icd10='I10'
            )THEN 1 ELSE 0 END) as bt,SUM(CASE WHEN (iptd.icd10 between 'I110' AND 'I119' or iptd.icd10 between 'I200' AND 'I259') 
            and iptd.an in (SELECT iptd.an FROM ipt ipt 
            LEFT OUTER JOIN iptdiag as iptd on iptd.an=ipt.an
            WHERE ipt.dchdate BETWEEN '$date1' and '$date2'   AND iptd.icd10='I10'
            )THEN 1 ELSE 0 END) as heart
            ,SUM(CASE WHEN (iptd.icd10 between 'I120' AND 'I129' or iptd.icd10 between 'N170' AND 'N19') 
            and iptd.an in (SELECT iptd.an FROM ipt ipt LEFT OUTER JOIN iptdiag as iptd on iptd.an=ipt.an
            WHERE ipt.dchdate BETWEEN '$date1' and '$date2'   AND iptd.icd10='I10'
            )THEN 1 ELSE 0 END) as N
            FROM ipt ipt 
            LEFT OUTER JOIN iptdiag as iptd on iptd.an=ipt.an
            WHERE ipt.dchdate BETWEEN '$date1' and '$date2'
        UNION
            SELECT 'OPD',
            SUM(CASE WHEN ov.diagtype=1 AND ov.icd10='I10' THEN 1 ELSE 0 END) as opd_ht
            ,SUM(CASE WHEN ov.icd10 between 'I600' AND 'I698'  AND ov.vn in (
            SELECT ov.vn FROM ovstdiag ov 
            WHERE ov.vstdate BETWEEN '$date1' and '$date2'   AND ov.icd10='I10'
            ) THEN 1 ELSE 0 END) as Opd_I600
            ,SUM(CASE WHEN (ov.icd10 between 'I110' AND 'I119' or ov.icd10 between 'I200' AND 'I259') AND ov.vn in(
            SELECT ov.vn FROM ovstdiag ov 
            WHERE ov.vstdate BETWEEN '$date1' and '$date2'   AND ov.icd10='I10'
            ) THEN 1 ELSE 0 END) as opd_heart
            ,SUM(CASE WHEN (ov.icd10 between 'I120' AND 'I129' or ov.icd10 between 'N170' AND 'N19') AND ov.vn in(
            SELECT ov.vn
            FROM ovstdiag ov 
            WHERE ov.vstdate BETWEEN '$date1' and '$date2'   AND ov.icd10='I10'
            )THEN 1 ELSE 0 END) as opd_N
            FROM ovstdiag ov 
            WHERE ov.vstdate BETWEEN '$date1' and '$date2'";
            $dm = "SELECT 'IPD' as ipd, 
SUM(CASE WHEN iptd.diagtype=1 AND iptd.icd10 between 'E10' AND 'E14' THEN 1 ELSE 0 END) as dm
,SUM(CASE WHEN iptd.icd10 in ('E102','E112','E132','E142') and iptd.an in 
(
SELECT iptd.an
FROM ipt ipt 
LEFT OUTER JOIN iptdiag as iptd on iptd.an=ipt.an
WHERE ipt.dchdate BETWEEN '$date1' and '$date2'  AND  iptd.icd10 between 'E10' AND 'E14'
) THEN 1 ELSE 0 END) as t
,SUM(CASE WHEN iptd.icd10 in ('E103','E113','E133','E143') and iptd.an in 
(
SELECT iptd.an
FROM ipt ipt 
LEFT OUTER JOIN iptdiag as iptd on iptd.an=ipt.an
WHERE ipt.dchdate BETWEEN '$date1' and '$date2'   AND iptd.icd10 between 'E10' AND 'E14'
) THEN 1 ELSE 0 END) as eye
,SUM(CASE WHEN iptd.icd10 in ('E104','E114','E134','E144') and iptd.an in 
(
SELECT iptd.an
FROM ipt ipt 
LEFT OUTER JOIN iptdiag as iptd on iptd.an=ipt.an
WHERE ipt.dchdate BETWEEN '$date1' and '$date2'   AND iptd.icd10 between 'E10' AND 'E14'
) THEN 1 ELSE 0 END) as hydro
FROM ipt ipt 
LEFT OUTER JOIN iptdiag as iptd on iptd.an=ipt.an
WHERE ipt.dchdate BETWEEN '$date1' and '$date2'  
UNION
SELECT 'OPD', 
SUM(CASE WHEN ov.diagtype=1 AND ov.icd10 between 'E10' AND 'E14' THEN 1 ELSE 0 END) as opd_dm
,SUM(CASE WHEN ov.icd10 in ('E102','E112','E132','E142') AND ov.vn in(
SELECT ov.vn
FROM ovstdiag ov 
WHERE ov.vstdate BETWEEN '$date1' and '$date2'    AND ov.icd10 between 'E10' AND 'E14'
) THEN 1 ELSE 0 END) as Opd_t
,SUM(CASE WHEN ov.icd10 in ('E103','E113','E133','E143') AND ov.vn in(
SELECT ov.vn
FROM ovstdiag ov 
WHERE ov.vstdate BETWEEN '$date1' and '$date2'    AND ov.icd10 between 'E10' AND 'E14'
) THEN 1 ELSE 0 END) as opd_eye
,SUM(CASE WHEN ov.icd10 in ('E104','E114','E134','E144') AND ov.vn in(
SELECT ov.vn
FROM ovstdiag ov 
WHERE ov.vstdate BETWEEN '$date1' and '$date2'    AND ov.icd10 between 'E10' AND 'E14'
)  THEN 1 ELSE 0 END) as opd_hydro
FROM ovstdiag ov 
WHERE ov.vstdate BETWEEN '$date1' and '$date2' ";

            $rsht = \Yii::$app->hosxpslave->createCommand("$ht")->queryAll();
            $rsdm = \Yii::$app->hosxpslave->createCommand("$dm")->queryAll();


            return $this->render('htdmdiag', [
                        'date1' => $date1,
                        'date2' => $date2,
                        'rsht' => $rsht,
                        'rsdm' => $rsdm,
            ]);
        } else {
            return $this->render('htdmdiag', [
                        'date1' => $date1,
                        'date2' => $date2,
            ]);
        }
    }

}
