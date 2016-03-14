<?php

namespace frontend\controllers;

class ReportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $data= date('Y-m-d');
        function thaidate($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
        $date=  thaidate($data);
        $rsbox1 = \Yii::$app->hosxp->createCommand("select count(*) as n FROM ovst WHERE vstdate=date(now())")->queryAll();
        $rsbox2 = \Yii::$app->hosxp->createCommand("SELECT count(*) as n FROM an_stat where dchdate IS NULL")->queryAll();
        $rsbox3 = \Yii::$app->hosxp->createCommand("SELECT COUNT(*) as n FROM oapp WHERE nextdate = DATE(now())")->queryAll();
        $rsbox4 = \Yii::$app->hosxp->createCommand("SELECT COUNT(*) as n FROM er_regist WHERE vstdate = DATE(now())")->queryAll();
        /////////////////2 Row
        $rsbox5 = \Yii::$app->hosxp->createCommand("SELECT COUNT(*) as n FROM dtmain WHERE vstdate = DATE(now())")->queryAll();
        $rsbox6 = \Yii::$app->hosxp->createCommand("SELECT count(v.vn) as n  from ovst v 
JOIN clinic_visit cv on cv.vn=v.vn WHERE v.vstdate =DATE(now())")->queryAll();
        
        return $this->render('index',[
            'date'=>$date,
            'rsbox1'=>$rsbox1,
            'rsbox2'=>$rsbox2,
            'rsbox3'=>$rsbox3,
            'rsbox4'=>$rsbox4,
            'rsbox5'=>$rsbox5,
            'rsbox6'=>$rsbox6,
            
        ]);
    }

}
