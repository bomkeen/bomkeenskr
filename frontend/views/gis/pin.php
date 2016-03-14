<?php
use yii\web\JsExpression;
use yii\helpers\Html;
?>
<div class="page-header">
   
    Location: <input class="form-control" type="text" id="us2-address"/>
  
    </div>
<div class="row">
    <div class="col-md-2">
        
        
        <form  method="post" class="form-inline" >
                <div class="form-group">
                    vn : <input class="form-control" type="text" id="vn" name="vn" value="<?php echo $vn ;?>"/>
                    Lat.: <input  class="form-control" type="text" id="lat" name="lat"/>

                    Long.: <input class="form-control" type="text" id="lng" name="lng"/>
                </div>

                <button type="submit" class="btn btn-primary glyphicon glyphicon-search"> บันทึก</button>
            </form>
        
        
        


    </div>
    <div class="col-md-10">
         
<?php
    echo \pigolab\locationpicker\LocationPickerWidget::widget([
       'key' => 'AIzaSyAWUAQmzH8gdqVcw8_qLossWkUQoI67A4M', // optional , Your can also put your google map api key
       'options' => [
            'style' => 'width: 100%; height: 500px', // map canvas width and height
        ] ,
        'clientOptions' => [
            'location' => [
                'latitude'  => 14.3991011 ,
                'longitude' => 100.597101,
                
            ],
            'radius'    => 300,
            'inputBinding' => [
                'latitudeInput'     => new JsExpression("$('#lat')"),
                'longitudeInput'    => new JsExpression("$('#lng')"),
                //'radiusInput'       => new JsExpression("$('#us2-radius')"),
                'locationNameInput' => new JsExpression("$('#us2-address')")
            ]
        ]        
    ]);
?>
    </div>
</div>