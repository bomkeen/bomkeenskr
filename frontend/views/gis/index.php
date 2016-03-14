<?php
$this->title = 'Yii2 GIS';//กำหนด Title

use yii\helpers\Html;
use yii\grid\GridView;
//Google Library
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <div class="col-md-2">
                <a class="btn btn-success glyphicon glyphicon-file" href="<?= \yii\helpers\Url::to(['/gis/list']) ?>"> ลงพิกัดจุดเกิดเหตุ</a>
            </div>
            <div class="col-md-10">
<?php
//print_r($schools);=> 14.4734475, 'lng' => 100.557107
$coord = new LatLng(['lat' => 14.4292572, 'lng' => 100.6006033]);
$map = new Map([
    'center' => $coord,
    'zoom' => 12,
    'width' => '100%',
    'height' => '500',
        ]);
foreach ($er as $s) {
   $lat= $s['lat'];
   $lng=$s['lng'];
    $coords = new LatLng(['lat' => $lat, 'lng' => $lng]);//กำหนด lat lng
    // สร้าง marker ในแผนที่
    $marker = new Marker([
        'position' => $coords,
    ]);

    // กำหนด InfoWindow ให้กับ Marker
    
    $marker->attachInfoWindow(
            new InfoWindow([
        'content' => '<h4>' . $s['hn'] . ''
                . '</h4><table class="table table-bordered">'
                . '<tr></tr><tr><td>HN :</td><td>' . $s['date'] .'</td>
           
            </table>'
            ])
    );

    // นำ Marker ที่ได้ใส่ในแผนที่
    $map->addOverlay($marker);
}

// กำหนดให้แสดงแผนที่
echo $map->display();

?>
            </div>
        </div>

    </div>
</div>
