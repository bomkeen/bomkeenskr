<?php

namespace frontend\controllers;

use kartik\mpdf\Pdf;
use yii;

?>
<?php

class ReportncdController extends \yii\web\Controller {

    public $enableCsrfValidation = false;

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionPdf1($rsht) {

        $content = $this->renderPartial('htdmdiag', ['rsht' => $rsht]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            'content' => $content,
            'options' => ['title' => 'Rejestracja na forum'],
            'methods' => [
                'SetHeader' => ['Rejestracja na forum'],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionHtdmdiag() {
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        $export = 'test';
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
            $export = $request->post('export');
            $ht = "SELECT 'IPD' as ipd,SUM(CASE WHEN iptd.diagtype=1 AND iptd.icd10='I10' THEN 1 ELSE 0 END) as ht,SUM(CASE WHEN iptd.icd10 between 'I600' AND 'I698' and iptd.an in 
            (SELECT iptd.an FROM ipt ipt LEFT OUTER JOIN iptdiag as iptd on iptd.an=ipt.an WHERE ipt.dchdate BETWEEN '$date1' and '$date2'   AND iptd.icd10='I10'
            )THEN 1 ELSE 0 END) as bt,SUM(CASE WHEN (iptd.icd10 between 'I110' AND 'I119' or iptd.icd10 between 'I200' AND 'I259') 
            and iptd.an in (SELECT iptd.an FROM ipt ipt LEFT OUTER JOIN iptdiag as iptd on iptd.an=ipt.an WHERE ipt.dchdate BETWEEN '$date1' and '$date2'   AND iptd.icd10='I10'
            )THEN 1 ELSE 0 END) as heart,SUM(CASE WHEN (iptd.icd10 between 'I120' AND 'I129' or iptd.icd10 between 'N170' AND 'N19') 
            and iptd.an in (SELECT iptd.an FROM ipt ipt LEFT OUTER JOIN iptdiag as iptd on iptd.an=ipt.an WHERE ipt.dchdate BETWEEN '$date1' and '$date2'   AND iptd.icd10='I10'
            )THEN 1 ELSE 0 END) as N FROM ipt ipt LEFT OUTER JOIN iptdiag as iptd on iptd.an=ipt.an WHERE ipt.dchdate BETWEEN '$date1' and '$date2'
        UNION
            SELECT 'OPD',SUM(CASE WHEN ov.diagtype=1 AND ov.icd10='I10' THEN 1 ELSE 0 END) as opd_ht
            ,SUM(CASE WHEN ov.icd10 between 'I600' AND 'I698'  AND ov.vn in (SELECT ov.vn FROM ovstdiag ov WHERE ov.vstdate BETWEEN '$date1' and '$date2'   AND ov.icd10='I10'
            ) THEN 1 ELSE 0 END) as bt,SUM(CASE WHEN (ov.icd10 between 'I110' AND 'I119' or ov.icd10 between 'I200' AND 'I259') AND ov.vn in(
            SELECT ov.vn FROM ovstdiag ov WHERE ov.vstdate BETWEEN '$date1' and '$date2'   AND ov.icd10='I10'
            ) THEN 1 ELSE 0 END) as opd_heart,SUM(CASE WHEN (ov.icd10 between 'I120' AND 'I129' or ov.icd10 between 'N170' AND 'N19') AND ov.vn in(
            SELECT ov.vn FROM ovstdiag ov WHERE ov.vstdate BETWEEN '$date1' and '$date2'   AND ov.icd10='I10'
            )THEN 1 ELSE 0 END) as opd_N FROM ovstdiag ov WHERE ov.vstdate BETWEEN '$date1' and '$date2'";
            $dm = "SELECT 'IPD' as ipd,SUM(CASE WHEN iptd.diagtype=1 AND iptd.icd10 between 'E10' AND 'E14' THEN 1 ELSE 0 END) as dm
            ,SUM(CASE WHEN iptd.icd10 in ('E102','E112','E132','E142') and iptd.an in (SELECT iptd.an FROM ipt ipt 
            LEFT OUTER JOIN iptdiag as iptd on iptd.an=ipt.an WHERE ipt.dchdate BETWEEN '$date1' and '$date2'  AND  iptd.icd10 between 'E10' AND 'E14'
            ) THEN 1 ELSE 0 END) as t,SUM(CASE WHEN iptd.icd10 in ('E103','E113','E133','E143') and iptd.an in 
            (SELECT iptd.an FROM ipt ipt LEFT OUTER JOIN iptdiag as iptd on iptd.an=ipt.an WHERE ipt.dchdate BETWEEN '$date1' and '$date2'   AND iptd.icd10 between 'E10' AND 'E14'
            ) THEN 1 ELSE 0 END) as eye,SUM(CASE WHEN iptd.icd10 in ('E104','E114','E134','E144') and iptd.an in 
            (SELECT iptd.an FROM ipt ipt LEFT OUTER JOIN iptdiag as iptd on iptd.an=ipt.an WHERE ipt.dchdate BETWEEN '$date1' and '$date2'   AND iptd.icd10 between 'E10' AND 'E14'
            ) THEN 1 ELSE 0 END) as hydro FROM ipt ipt LEFT OUTER JOIN iptdiag as iptd on iptd.an=ipt.an WHERE ipt.dchdate BETWEEN '$date1' and '$date2'  
        UNION
            SELECT 'OPD',SUM(CASE WHEN ov.diagtype=1 AND ov.icd10 between 'E10' AND 'E14' THEN 1 ELSE 0 END) as opd_dm
            ,SUM(CASE WHEN ov.icd10 in ('E102','E112','E132','E142') AND ov.vn in(SELECT ov.vn
            FROM ovstdiag ov WHERE ov.vstdate BETWEEN '$date1' and '$date2'    AND ov.icd10 between 'E10' AND 'E14'
            ) THEN 1 ELSE 0 END) as Opd_t,SUM(CASE WHEN ov.icd10 in ('E103','E113','E133','E143') AND ov.vn in(
            SELECT ov.vn FROM ovstdiag ov WHERE ov.vstdate BETWEEN '$date1' and '$date2'    AND ov.icd10 between 'E10' AND 'E14'
            ) THEN 1 ELSE 0 END) as opd_eye,SUM(CASE WHEN ov.icd10 in ('E104','E114','E134','E144') AND ov.vn in(
            SELECT ov.vn FROM ovstdiag ov WHERE ov.vstdate BETWEEN '$date1' and '$date2'    AND ov.icd10 between 'E10' AND 'E14'
            )  THEN 1 ELSE 0 END) as opd_hydro FROM ovstdiag ov WHERE ov.vstdate BETWEEN '$date1' and '$date2' ";

            $rsht = \Yii::$app->hosxpslave->createCommand("$ht")->queryAll();
            $rsdm = \Yii::$app->hosxpslave->createCommand("$dm")->queryAll();
///////////////////   PDF   ////////////////////////////////////////////            
//
            if ($export == 'pdf') {
                $content = $this->renderPartial('htdmdiag', [
                    'date1' => $date1,
                    'date2' => $date2,
                    'rsdm' => $rsdm,
                    'rsht' => $rsht,
                    'export' => $export,
                ]);
                $pdf = new Pdf([
                    'mode' => Pdf::MODE_CORE,
                    'content' => $content,
                    'options' => ['title' => 'จำนวนผู้ป่วยโรคเรื้อรังและโรคร่วม'],
                    'methods' => [
                        'SetHeader' => ['จำนวนผู้ป่วยโรคเรื้อรังและโรคร่วม'],
                        'SetFooter' => ['{PAGENO}'],
                    ]
                ]);
                return $pdf->render();
            }
            //////////////////////////////////////////////////       
            else {
                return $this->render('htdmdiag', [
                            'date1' => $date1,
                            'date2' => $date2,
                            'rsht' => $rsht,
                            'rsdm' => $rsdm,
                            'export' => $export,
                ]);
            }
        } else {
            return $this->render('htdmdiag', [
                        'date1' => $date1,
                        'date2' => $date2,
            ]);
        }
    }

    public function actionHtdetail() {
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        $export = 'test';
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
            $export = $request->post('export');
            $labsql = "select 'ผู้ป่วยความดันโลหิตรายใหม่' as name,count(distinct vn.hn) as man,count(vn.vn) as n from vn_stat vn 
inner join clinicmember cm on vn.hn=cm.hn 
where vn.vstdate BETWEEN '$date1' and '$date2'
AND cm.begin_year=(YEAR(NOW())+543)
and cm.clinic=002 AND cm.hn not in (select hn from clinicmember WHERE clinic=001)
UNION
select 'ผู้ป่วยความดันโลหิตสูงที่รับบริการทั้งหมด' as name,count(distinct vn.hn) as man,count(vn.vn) as n from ovst vn 
inner join clinicmember cm on vn.hn=cm.hn 
where vn.vstdate BETWEEN '$date1' and '$date2'
and cm.clinic=002 AND cm.hn not in (select hn from clinicmember WHERE clinic=001)
UNION
select 'ผู้ป่วย HT ควบคุมระดับความดันได้ 140/90 mmHg' as name,count(distinct vn.hn) as man ,count(vn.vn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn inner join opdscreen op on vn.vn=op.vn 
  where vn.vstdate BETWEEN '$date1' and '$date2'
  and cm.clinic=002 AND cm.hn not in (select hn from clinicmember WHERE clinic=001)
and op.bps <140 and op.bpd <90
UNION
select 'ผู้ป่วยความดันโลหิตสูง ได้รับการตรวจ FBS' as name,count(distinct vn.hn) as man ,count(vn.vn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  join lab_head lh on vn.vn=lh.vn 
  join lab_order lo on lh.lab_order_number=lo.lab_order_number 
  where vn.vstdate BETWEEN '$date1' and '$date2'
  and lo.lab_items_code =659 
  and cm.clinic=002 AND cm.hn not in (select hn from clinicmember WHERE clinic=001)
UNION
select 'ผู้ป่วยความดันโลหิตสูง ได้รับการตรวจ Lipid Profile'  as name,count(distinct vn.hn) as man ,count(DISTINCT lo.lab_order_number) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  join lab_head lh on vn.vn=lh.vn 
  join lab_order lo on lh.lab_order_number=lo.lab_order_number 
JOIN lab_items li on lo.lab_items_code=li.lab_items_code
  where vn.vstdate BETWEEN '$date1' and '$date2'
  and li.lab_items_code in (102,103,91,92,211) 
  and cm.clinic=002 AND cm.hn not in (select hn from clinicmember WHERE clinic=001)
UNION
select 'ผู้ป่วยความดันโลหิตสูง ได้รับการตรวจ LDL (รวมในกลุ่ม Lipid ด้วย)' as name,count(distinct vn.hn) as man ,count(DISTINCT lo.lab_order_number) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  join lab_head lh on vn.vn=lh.vn 
  join lab_order lo on lh.lab_order_number=lo.lab_order_number 
JOIN lab_items li on lo.lab_items_code=li.lab_items_code
  where vn.vstdate BETWEEN '$date1' and '$date2'
  and li.lab_items_code in (92,211) 
  and cm.clinic=002 AND cm.hn not in (select hn from clinicmember WHERE clinic=001)
UNION
select 'ผู้ป่วยความดันโลหิตสูง ได้รับการตรวจ LDL (รวมในกลุ่ม Lipid ด้วย < 100 mg/dl)' as name,count(distinct vn.hn) as man ,count(DISTINCT lo.lab_order_number) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  join lab_head lh on vn.vn=lh.vn 
  join lab_order lo on lh.lab_order_number=lo.lab_order_number 
JOIN lab_items li on lo.lab_items_code=li.lab_items_code
  where vn.vstdate BETWEEN '$date1' and '$date2'
  and li.lab_items_code in (92,211)
AND lo.lab_order_result <100  
  and cm.clinic=002 AND cm.hn not in (select hn from clinicmember WHERE clinic=001)
UNION
select 'ผู้ป่วยความดันโลหิตสูง ได้รับการตรวจ Urine Microalbumine' as name,count(distinct vn.hn) as man ,count(vn.vn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  join lab_head lh on vn.vn=lh.vn 
  join lab_order lo on lh.lab_order_number=lo.lab_order_number 
  where vn.vstdate BETWEEN '$date1' and '$date2'
  and lo.lab_items_code =704 
  and cm.clinic=002 AND cm.hn not in (select hn from clinicmember WHERE clinic=001)
UNION
select 'ผู้ป่วยความดันโลหิตสูง ได้รับการตรวจ Urine Macroalbumine' as name,count(distinct vn.hn) as man ,count(vn.vn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  join lab_head lh on vn.vn=lh.vn 
  join lab_order lo on lh.lab_order_number=lo.lab_order_number 
  where vn.vstdate BETWEEN '$date1' and '$date2'
  and lo.lab_items_code =188 
  and cm.clinic=002 AND cm.hn not in (select hn from clinicmember WHERE clinic=001)
UNION
	select 'ผู้ป่วยความดันโลหิตสูง มีสภาวะ Albuminuria Positive' as name,count(distinct vn.hn) as man ,count(vn.vn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  join lab_head lh on vn.vn=lh.vn 
  join lab_order lo on lh.lab_order_number=lo.lab_order_number 
  where vn.vstdate BETWEEN '$date1' and '$date2'
  and lo.lab_items_code in (704,188) AND lo.lab_order_result LIKE '%po%' 
  and cm.clinic=002 AND cm.hn not in (select hn from clinicmember WHERE clinic=001)
UNION
select 'ผู้ป่วยความดันโลหิต ได้รับการตรวจ  Albuminuria ผล Positive ได้รับยา ACEI/ARB' as name,count(distinct vn.hn) as man ,count(vn.vn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  join lab_head lh on vn.vn=lh.vn 
  join lab_order lo on lh.lab_order_number=lo.lab_order_number 
JOIN opitemrece op on vn.vn=op.vn
  where vn.vstdate BETWEEN '$date1' and '$date2'
  and lo.lab_items_code in (704,188) 
AND lo.lab_order_result LIKE '%po%'
and op.icode in (1460151,1000122,1520008)
  and cm.clinic=002 AND cm.hn not in (select hn from clinicmember WHERE clinic=001)
UNION
select 'ผู้ป่วยความดันโลหิตสูง ได้รับการตรวจ Cr' as name,count(distinct vn.hn) as man ,count(vn.vn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  join lab_head lh on vn.vn=lh.vn 
  join lab_order lo on lh.lab_order_number=lo.lab_order_number 
  where vn.vstdate BETWEEN '$date1' and '$date2'
  and lo.lab_items_code =78 
  and cm.clinic=002 AND cm.hn not in (select hn from clinicmember WHERE clinic=001)";
            $egfrsql = "select 'Kidney Damage with Normal or increased eGFR >= 90' as name,count(distinct vn.hn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  JOIN ovst_gfr AS gfr on vn.vn=gfr.vn 
  where vn.vstdate BETWEEN '$date1' and '$date2' and gfr.ckd_epi >=90 
and cm.clinic=002 AND cm.hn not in (select hn from clinicmember WHERE clinic=001)
UNION
select 'Kidney Damage with Mild decreased eGFR 60-89' as name,count(distinct vn.hn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  JOIN ovst_gfr AS gfr on vn.vn=gfr.vn 
  where vn.vstdate BETWEEN '$date1' and '$date2' and gfr.ckd_epi between '60' AND '89' 
and cm.clinic=002 AND cm.hn not in (select hn from clinicmember WHERE clinic=001)
UNION
select 'Moderate decreased 30-59' as name,count(distinct vn.hn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  JOIN ovst_gfr AS gfr on vn.vn=gfr.vn 
  where vn.vstdate BETWEEN '$date1' and '$date2' and gfr.ckd_epi between '30' AND '59' 
and cm.clinic=002 AND cm.hn not in (select hn from clinicmember WHERE clinic=001)
UNION
select 'Severe decreased 15-29' as name,count(distinct vn.hn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  JOIN ovst_gfr AS gfr on vn.vn=gfr.vn 
  where vn.vstdate BETWEEN '$date1' and '$date2' and gfr.ckd_epi between '15' AND '29' 
and cm.clinic=002 AND cm.hn not in (select hn from clinicmember WHERE clinic=001)
UNION
select 'Kidney Failure GFR <15' as name,count(distinct vn.hn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  JOIN ovst_gfr AS gfr on vn.vn=gfr.vn 
  where vn.vstdate BETWEEN '$date1' and '$date2' and gfr.ckd_epi < '15'
and cm.clinic=002 AND cm.hn not in (select hn from clinicmember WHERE clinic=001)";
            $pingsql = "select 'สีเขียว BP<= 139/89 mmHg' as name,count(distinct vn.hn) as man ,count(vn.vn) as n from vn_stat vn 
  inner join opdscreen op on vn.vn=op.vn 
  where vn.vstdate BETWEEN '$date1' and '$date2'
  AND vn.hn  not in (SELECT hn FROM clinicmember WHERE clinic ='001') 
  AND vn.hn in (SELECT hn FROM clinicmember WHERE clinic ='002') 
 and op.bps <139 and op.bpd <89
UNION
select 'สีเหลือง BP<= 140/90 - 159/99 mmHg' as name,count(distinct vn.hn) as man ,count(vn.vn) as n from vn_stat vn 
  inner join opdscreen op on vn.vn=op.vn 
  where vn.vstdate BETWEEN '$date1' and '$date2'
  AND vn.hn  not in (SELECT hn FROM clinicmember WHERE clinic ='001') 
  AND vn.hn in (SELECT hn FROM clinicmember WHERE clinic ='002') 
   and op.bps between '140' and '159' and op.bpd between '90' and '99'
UNION
select 'สีส้ม  BP<= 160/100 - 179/109 mmHg' as name,count(distinct vn.hn) as man ,count(vn.vn) as n from vn_stat vn 
  inner join opdscreen op on vn.vn=op.vn 
  where vn.vstdate BETWEEN '$date1' and '$date2'
  AND vn.hn  not in (SELECT hn FROM clinicmember WHERE clinic ='001') 
  AND vn.hn in (SELECT hn FROM clinicmember WHERE clinic ='002') 
    and op.bps between '160' and '179' and op.bpd between '100' and '109'
UNION
select 'สีแดง  BP>= 180/110 mmHg' as name,count(distinct vn.hn) as man ,count(vn.vn) as n from vn_stat vn 
  inner join opdscreen op on vn.vn=op.vn 
  where vn.vstdate BETWEEN '$date1' and '$date2'
  AND vn.hn  not in (SELECT hn FROM clinicmember WHERE clinic ='001') 
  AND vn.hn in (SELECT hn FROM clinicmember WHERE clinic ='002') 
    and op.bps >= '180' and op.bpd >='110'
UNION
select 'สีดำ ผู้ป่วยที่มีภาวะแทรกซ้แน สทอง หัวใจ หลอดเลือด ไต' as name,count(distinct vn.hn) as man ,count(vn.vn) as n from vn_stat vn 
  inner join ovstdiag ov on vn.vn=ov.vn 
  where vn.vstdate BETWEEN '$date1' and '$date2'
  AND vn.hn  not in (SELECT hn FROM clinicmember WHERE clinic ='001') 
  AND vn.hn in (SELECT hn FROM clinicmember WHERE clinic ='002') 
  and ov.icd10 in ('I64','E112','N083','I259')";
            $lab = \Yii::$app->hosxpslave->createCommand("$labsql")->queryAll();
            $egfr = \Yii::$app->hosxpslave->createCommand("$egfrsql")->queryAll();
            $ping = \Yii::$app->hosxpslave->createCommand("$pingsql")->queryAll();
            ///////////////////   PDF   ////////////////////////////////////////////            
//
            if ($export == 'pdf') {
                $content = $this->renderPartial('htdetail', [
                    'date1' => $date1,
                    'date2' => $date2,
                    'lab' => $lab,
                    'egfr' => $egfr,
                    'ping' => $ping,
                ]);
                $pdf = new Pdf([
                    'mode' => Pdf::MODE_CORE,
                    'content' => $content,
                    'options' => ['title' => 'ภาพรวมการให้บริการคลินิคความดันโลหิตสูง HT Deatil'],
                    'methods' => [
                        'SetHeader' => ['ภาพรวมการให้บริการคลินิคความดันโลหิตสูง HT Deatil'],
                        'SetFooter' => ['{PAGENO}'],
                    ]
                ]);
                return $pdf->render();
            }
            //////////////////////////////////////////////////       
            else {

                return $this->render('htdetail', [
                            'date1' => $date1,
                            'date2' => $date2,
                            'lab' => $lab,
                            'egfr' => $egfr,
                            'ping' => $ping,
                ]);
            }
        } else {
            return $this->render('htdetail', [
                        'date1' => $date1,
                        'date2' => $date2,
            ]);
        }
    }

    public function actionDmdetail() {
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        $export = 'test';
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $date1 = $request->post('date1');
            $date2 = $request->post('date2');
            $export = $request->post('export');
            $labsql = "select 'ผู้ป่วยเบาหวานรายใหม่' as name,count(distinct vn.hn) as man,count(vn.vn) as n from vn_stat vn 
inner join clinicmember cm on vn.hn=cm.hn 
where vn.vstdate BETWEEN '$date1' and '$date2'
AND cm.begin_year=(YEAR(NOW())+543)
and cm.clinic=001 
UNION
select 'ผู้ป่วยโรคเบาหวานรับบริการทั้งหมด' as name,count(distinct vn.hn) as man,count(vn.vn) as n from ovst vn 
inner join clinicmember cm on vn.hn=cm.hn 
where vn.vstdate BETWEEN '$date1' and '$date2'
and cm.clinic=001
UNION
select 'ผู้ป่วยโรคเบาหวานควบคุมระดับน้ำตาลได้ 70-130 mg/dl' as name,count(distinct vn.hn) as man,count(vn.vn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  join lab_head lh on vn.vn=lh.vn 
  join lab_order lo on lh.lab_order_number=lo.lab_order_number 
  where vn.vstdate BETWEEN '$date1' and '$date2' and (lo.lab_items_code =659 or lo.lab_items_code =626) 
  and lo.lab_order_result between 70 and 130 
  and cm.clinic=001
UNION
select 'ผู้ป่วยโรคเบาหวานที่ BP < 140/80 mmHg' as name,count(distinct vn.hn) as man,count(vn.vn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  join opdscreen op on vn.vn=op.vn 
  where vn.vstdate BETWEEN '$date1' and '$date2' and op.bps<=140 and op.bpd<=80 
  and cm.clinic=001
UNION
select 'ผู้ป่วยโรคเบาหวานที่ได้ตรวจ HbA1C' as name,count(distinct vn.hn) as man,count(vn.vn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  join lab_head lh on vn.vn=lh.vn 
  join lab_order lo on lh.lab_order_number=lo.lab_order_number 
  where vn.vstdate BETWEEN '$date1' and '$date2' and (lo.lab_items_code =193 or lo.lab_items_code =632) 
  and cm.clinic=001
UNION
select 'ผู้ป่วยโรคเบาหวานที่ได้ตรวจ HbA1C ค่า < 7%' as name,count(distinct vn.hn) as man,count(vn.vn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  join lab_head lh on vn.vn=lh.vn 
  join lab_order lo on lh.lab_order_number=lo.lab_order_number 
  where vn.vstdate BETWEEN '$date1' and '$date2' and (lo.lab_items_code =193 or lo.lab_items_code =632) and lo.lab_order_result<7 
  and cm.clinic=001
UNION
select 'ผผู้ป่วยโรคเบาหวาน ได้รับการตรวจ Lipid profile'  as name,count(distinct vn.hn) as man ,count(DISTINCT lo.lab_order_number) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  join lab_head lh on vn.vn=lh.vn 
  join lab_order lo on lh.lab_order_number=lo.lab_order_number 
JOIN lab_items li on lo.lab_items_code=li.lab_items_code
  where vn.vstdate BETWEEN '$date1' and '$date2'
  and li.lab_items_code in (102,103,91,92,211) 
  and cm.clinic=001
UNION
select 'ผผู้ป่วยโรคเบาหวาน ได้รับการตรวจ LDL (รวมในกลุ่ม Lipid ด้วย)' as name,count(distinct vn.hn) as man ,count(DISTINCT lo.lab_order_number) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  join lab_head lh on vn.vn=lh.vn 
  join lab_order lo on lh.lab_order_number=lo.lab_order_number 
JOIN lab_items li on lo.lab_items_code=li.lab_items_code
  where vn.vstdate BETWEEN '$date1' and '$date2'
  and li.lab_items_code in (92,211) 
  and cm.clinic=001
UNION
select 'ผู้ป่วยโรคเบาหวาน ได้รับการตรวจ LDL < 100 mg/dl (รวมในกลุ่ม Lipid ด้วย)' as name,count(distinct vn.hn) as man ,count(DISTINCT lo.lab_order_number) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  join lab_head lh on vn.vn=lh.vn 
  join lab_order lo on lh.lab_order_number=lo.lab_order_number 
JOIN lab_items li on lo.lab_items_code=li.lab_items_code
  where vn.vstdate BETWEEN '$date1' and '$date2'
  and li.lab_items_code in (92,211)
AND lo.lab_order_result <100  
  and cm.clinic=001
UNION
select 'ผู้ป่วยโรคเบาหวาน ได้รับการตรวจ Urine Microalbumine' as name,count(distinct vn.hn) as man ,count(vn.vn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  join lab_head lh on vn.vn=lh.vn 
  join lab_order lo on lh.lab_order_number=lo.lab_order_number 
  where vn.vstdate BETWEEN '$date1' and '$date2'
  and lo.lab_items_code =704 
  and cm.clinic=001
UNION
select 'ผู้ป่วยโรคเบาหวาน ได้รับการตรวจ Urine Microalbumine ได้รับยา ACEI/ARB' as name,count(distinct vn.hn) as man ,count(vn.vn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  join lab_head lh on vn.vn=lh.vn 
  join lab_order lo on lh.lab_order_number=lo.lab_order_number 
JOIN opitemrece op on vn.vn=op.vn
  where vn.vstdate BETWEEN '$date1' and '$date2'
  and lo.lab_items_code in (704) 
AND lo.lab_order_result LIKE '%po%'
and op.icode in (1460151,1000122,1520008)
  and cm.clinic=001
UNION
select 'ผู้ป่วยโรคเบาหวาน ได้รับการตรวจ Cr' as name,count(distinct vn.hn) as man ,count(vn.vn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  join lab_head lh on vn.vn=lh.vn 
  join lab_order lo on lh.lab_order_number=lo.lab_order_number 
  where vn.vstdate BETWEEN '$date1' and '$date2'
  and lo.lab_items_code =78 
  and cm.clinic=001";
            $egfrsql = "select 'Kidney Damage with Normal or increased eGFR >= 90' as name,count(distinct vn.hn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  JOIN ovst_gfr AS gfr on vn.vn=gfr.vn 
  where vn.vstdate BETWEEN '$date1' and '$date2' and gfr.ckd_epi >=90 
and cm.clinic=001
UNION
select 'Kidney Damage with Mild decreased eGFR 60-89' as name,count(distinct vn.hn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  JOIN ovst_gfr AS gfr on vn.vn=gfr.vn 
  where vn.vstdate BETWEEN '$date1' and '$date2' and gfr.ckd_epi between '60' AND '89' 
and cm.clinic=001
UNION
select 'Moderate decreased 30-59' as name,count(distinct vn.hn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  JOIN ovst_gfr AS gfr on vn.vn=gfr.vn 
  where vn.vstdate BETWEEN '$date1' and '$date2' and gfr.ckd_epi between '30' AND '59' 
and cm.clinic=001
UNION
select 'Severe decreased 15-29' as name,count(distinct vn.hn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  JOIN ovst_gfr AS gfr on vn.vn=gfr.vn 
  where vn.vstdate BETWEEN '$date1' and '$date2' and gfr.ckd_epi between '15' AND '29' 
and cm.clinic=001
UNION
select 'Kidney Failure GFR <15' as name,count(distinct vn.hn) as n from vn_stat vn 
  join clinicmember cm on vn.hn=cm.hn 
  JOIN ovst_gfr AS gfr on vn.vn=gfr.vn 
  where vn.vstdate BETWEEN '$date1' and '$date2' and gfr.ckd_epi < '15'
and cm.clinic=001";
            $pingsql = "SELECT 'สีขียว FBS<125 mg/dl' as name,COUNT(DISTINCT hn) as man
,count(ovst.vn) as n 
  FROM ovst 
  WHERE vstdate BETWEEN '$date1' and '$date2'
  AND vn in 
  (SELECT ps.vn 
  FROM opdscreen AS ps 
  WHERE ps.vstdate BETWEEN '$date1' and '$date2'
  AND ps.fbs BETWEEN '1' AND '125' 
  AND ps.hn  in (SELECT hn FROM clinicmember WHERE clinic ='001') 
 UNION 
  SELECT ps.vn FROM opdscreen AS ps 
  INNER JOIN opdscreen_fbs AS dtx ON dtx.vn=ps.vn 
  WHERE ps.vstdate BETWEEN '$date1' and '$date2' 
  AND dtx.dtx1 BETWEEN '1' AND '125' 
  AND ps.hn  in (SELECT hn FROM clinicmember WHERE clinic ='001')
  )
UNION
SELECT 'สีเหลือง FBS 126-154 mg/dl' as name,COUNT(DISTINCT hn) as man
,count(ovst.vn) as n 
  FROM ovst 
  WHERE vstdate BETWEEN '$date1' and '$date2'
  AND vn in 
  (SELECT ps.vn 
  FROM opdscreen AS ps 
  WHERE ps.vstdate BETWEEN '$date1' and '$date2'
  AND ps.fbs BETWEEN '126' AND '154' 
  AND ps.hn  in (SELECT hn FROM clinicmember WHERE clinic ='001') 
  
UNION 
  SELECT ps.vn FROM opdscreen AS ps 
  INNER JOIN opdscreen_fbs AS dtx ON dtx.vn=ps.vn 
  WHERE ps.vstdate BETWEEN '$date1' and '$date2' 
  AND dtx.dtx1 BETWEEN '126' AND '154' 
  AND ps.hn  in (SELECT hn FROM clinicmember WHERE clinic ='001')
  )
UNION
SELECT 'สีส้ม FBS 155-182 mg/dl' as name,COUNT(DISTINCT hn) as man
,count(ovst.vn) as n 
  FROM ovst 
  WHERE vstdate BETWEEN '$date1' and '$date2'
  AND vn in 
  (SELECT ps.vn 
  FROM opdscreen AS ps 
  WHERE ps.vstdate BETWEEN '$date1' and '$date2'
  AND ps.fbs BETWEEN '155' AND '182' 
  AND ps.hn  in (SELECT hn FROM clinicmember WHERE clinic ='001') 
  
UNION 
  SELECT ps.vn FROM opdscreen AS ps 
  INNER JOIN opdscreen_fbs AS dtx ON dtx.vn=ps.vn 
  WHERE ps.vstdate BETWEEN '$date1' and '$date2'
  AND dtx.dtx1 BETWEEN '155' AND '182' 
  AND ps.hn  in (SELECT hn FROM clinicmember WHERE clinic ='001')
  )
UNION
SELECT 'สีแดง FBS > 183 mg/dl' as name,COUNT(DISTINCT hn) as man
,count(ovst.vn) as n 
  FROM ovst 
  WHERE vstdate BETWEEN '$date1' and '$date2' 
  AND vn in 
  (SELECT ps.vn 
  FROM opdscreen AS ps 
  WHERE ps.vstdate BETWEEN '$date1' and '$date2'
  AND ps.fbs >183
  AND ps.hn  in (SELECT hn FROM clinicmember WHERE clinic ='001') 
  
UNION 
  SELECT ps.vn FROM opdscreen AS ps 
  INNER JOIN opdscreen_fbs AS dtx ON dtx.vn=ps.vn 
  WHERE ps.vstdate BETWEEN '$date1' and '$date2' 
  AND dtx.dtx1 >183
  AND ps.hn  in (SELECT hn FROM clinicmember WHERE clinic ='001')
  )
UNION
select 'สีดำ ผู้ป่วยมีภาวะแทรกซ้อน สมอง หัวใจ หลอดเลือด ไต' as name,count(distinct vn.hn) as man ,count(vn.vn) as n from vn_stat vn 
  inner join ovstdiag ov on vn.vn=ov.vn 
  where vn.vstdate BETWEEN '$date1' and '$date2'
  
  AND vn.hn in (SELECT hn FROM clinicmember WHERE clinic ='001') 
  and ov.icd10 in ('I64','E112','N083','I259')";

            $lab = \Yii::$app->hosxpslave->createCommand("$labsql")->queryAll();
            $egfr = \Yii::$app->hosxpslave->createCommand("$egfrsql")->queryAll();
            $ping = \Yii::$app->hosxpslave->createCommand("$pingsql")->queryAll();

            ///////////////////   PDF   ////////////////////////////////////////////            
//
            if ($export == 'pdf') {
                $content = $this->renderPartial('dmdetail', [
                    'date1' => $date1,
                    'date2' => $date2,
                    'lab' => $lab,
                    'egfr' => $egfr,
                    'ping' => $ping,
                ]);
                $pdf = new Pdf([
                    'mode' => Pdf::MODE_CORE,
                    'content' => $content,
                    'options' => ['title' => 'ภาพรวมการให้บริการคลินิคgเบาหวาน DM Deatil'],
                    'methods' => [
                        'SetHeader' => ['ภาพรวมการให้บริการคลินิคgเบาหวาน DM Deatil'],
                        'SetFooter' => ['{PAGENO}'],
                    ]
                ]);
                return $pdf->render();
            }
            //////////////////////////////////////////////////       
            else {
                return $this->render('dmdetail', [
                            'date1' => $date1,
                            'date2' => $date2,
                            'lab' => $lab,
                            'egfr' => $egfr,
                            'ping' => $ping,
                ]);
            }
        } else {
            return $this->render('dmdetail', [
                        'date1' => $date1,
                        'date2' => $date2,
            ]);
        }
    }

}
