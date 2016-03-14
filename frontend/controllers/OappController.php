<?php 
namespace frontend\controllers;
use yii;
?>
<?php



class OappController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $c = Yii::$app->hosxp->createCommand("SELECT nextdate,concat('คนไข้',' ',COUNT(vn),' ','คน') as n,if(COUNT(vn)>100,'#FF0000','#D79AE6') AS color from oapp WHERE nextdate > '2015-10-01' GROUP BY nextdate");
        $events = $c->queryAll();
        $task=[];
        foreach ($events as $eve) {
            
            $event = new \yii2fullcalendar\models\Event();
            //$event->id = $eve['nextdate'];
            $event->title = $eve['n'];
            $event->start = $eve['nextdate'];
            $event->color=$eve['color'];
            
            
            //$event->url =\yii\helpers\Url::to(['/site/visitday','day'=>$eve['today']]);
            $task[] = $event;
            
        }
        
        
        return $this->render('index',[
            'events'=>$task,
        ]);
    }

}
