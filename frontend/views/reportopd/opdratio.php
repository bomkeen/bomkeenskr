<?php 
include_once '../../inc/thaidate.php';
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน OPD', 'url' => ['index']];
?>

    <div class="row">.
            <div class="col-md-4 col-md-offset-8">
                <form id="form1" name="form1" method="post" >

                    <select class="form-control" name="year" id="year">
                        <option value="2016"> ปีงบประมาณ 2559</option>
                        <option value="2015">ปีงบประมาณ 2558</option>
                        <option value="2014">ปีงบประมาณ 2557</option>
                        <option value="2013">ปีงบประมาณ 2556</option>
                        <option value="2012">ปีงบประมาณ 2555</option>
                        <option value="2011">ปีงบประมาณ 2554</option>
</select>
                
                    
 <input type="hidden" name="form1" id="form1" value="true" />
 <input class="btn btn-success" type="submit" name="Submit" value="แสดงข้อมูล" />
 </form>
            </div>
    </div>

<?php if(isset($m)) { ?>
  <div class="row">
       
            <div class="container container-fluid col-md-12 col-md-offset-0">
                <h3><p class="label label-success">ข้อมูลหระว่างวันที่ <?php echo thaidate($date1);?> ถึง <?php echo thaidate($date2);?></p></h3>
                <?php
              
                
                echo "<table class='table table-hover'  > <caption><h3>รายงานสถิติผู้ป่วยนอก</h3></caption>";
                echo '<th>';
                echo'หัวข้อรายงาน';
                echo '</th>';
               foreach ($m as $m_name){
                    echo "<th>";
                    echo thaimonth($m_name['m']);
                    echo "</th>";
                }
                echo '<th class="bg-danger">';
                echo'ภาพปีงบ';
                echo '</th>';

//เริ่มต้นชุดข้อมูล
                echo "<tr>";
                echo '<td>';
                echo'จำนวนคนไข้';
                echo '</td>';
                foreach ($man_m as $man_m_data)
               { //วนลูปแสดงข้อมูล
                    echo "<td>";
                    echo $man_m_data['cc'];
                    echo "</td>";
                }
                echo '<th class="bg-danger">';
                foreach ($man as $man_data);
            
                echo $man_data['cc'];
                echo '</th>';
                echo"</tr>";
                //หมดชุดแถว
                //เริ่มต้นชุดข้อมูล
                echo "<tr>";
                echo '<td>';
                echo'จำนวนครั้ง';
                echo '</td>';
                foreach ($n_m as $n_m_data)
               { //วนลูปแสดงข้อมูล
                    echo "<td>";
                    echo $n_m_data['cc'];
                    echo "</td>";
                }
                echo '<th class="bg-danger">';
                foreach ($n as $n_data);
            
                echo $n_data['cc'];
                echo '</th>';
                echo"</tr>";
                //หมดชุดแถว
               
                
             
//////////////////////////////////
                echo "</table>";
                ?>
             
            </div>
        </div>
  





<?php } ?>