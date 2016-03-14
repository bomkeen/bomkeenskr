<?php 
include_once '../../inc/thaidate.php';
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน', 'url' => ['report/index']];
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
                <h4><p class="label label-success">ข้อมูลหระว่างวันที่ <?php echo thaidate($date1);?> ถึง <?php echo thaidate($date2);?></p></h4>
                <?php
              
                
                echo "<table class='table table-hover'  > <caption><h3>รายงานสถิติผู้ป่วยใน</h3></caption>";
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
                echo'อัตราการตาย(ต่อ1000)';
                echo '</td>';
                foreach ($d_m as $d_m_data)
               { //วนลูปแสดงข้อมูล
                    echo "<td>";
                    echo $d_m_data['cc'];
                    echo "</td>";
                }
                echo '<th class="bg-danger">';
                foreach ($d as $d_data);
            
                echo $d_data['cc'];
                echo '</th>';
                echo"</tr>";
                //หมดชุดแถว
                
                //เริ่มต้นชุดข้อมูล ที่ 2 อัตรการครองเตียง
                echo "<tr>";
                echo '<td>';
                echo'อัตราการครองเตียง';
                echo '</td>';
                foreach ($bed_m as $bed_m_data)
                 { //วนลูปแสดงข้อมูล
                    echo "<td>";
                    echo $bed_m_data['cc'];
                    echo "</td>";
                }
                echo '<th class="bg-danger">';
                foreach ($bed as $bed_data);
           
                echo $bed_data['cc'];
                echo '</th>';
                echo"</tr>";
                //หมดชุดแถว
                
                //เริ่มต้นชุดข้อมูล ที่ 2 อัตรการใช้เตียง
                echo "<tr>";
                echo '<td>';
                echo'อัตราการใช้เตียง';
                echo '</td>';
                foreach ($bed_use_m as $bed_use_m_data)
                { //วนลูปแสดงข้อมูล
                    echo "<td>";
                    echo $bed_use_m_data['cc'];
                    echo "</td>";
                }
                echo '<th class="bg-danger">';
                foreach ($bed_use as $bed_use_data);
               
                echo $bed_use_data['cc'];
                echo '</th>';
                echo"</tr>";
                //หมดชุดแถว
                
                //เริ่มต้นชุดข้อมูล วันนอนเฉลี่ย
                echo "<tr>";
                echo '<td>';
                echo'วันนอนเฉลี่ย';
                echo '</td>';
                foreach ($day_m as $day_m_data)
                { //วนลูปแสดงข้อมูล
                    echo "<td>";
                    echo $day_m_data['cc'];
                    echo "</td>";
                }
                echo '<th class="bg-danger">';
                foreach ($day as $day_data);
                echo $day_data['cc'];
                echo '</th>';
                echo"</tr>";
                //หมดชุดแถว
                
                 echo "<tr>";
                echo '<td>';
                echo'วันนอนรวม';
                echo '</td>';
                foreach ($day_sum as $day_s)
                 { //วนลูปแสดงข้อมูล
                    echo "<td>";
                    echo $day_s['cc'].' วัน';
                    echo "</td>";
                }
                echo '<th class="bg-danger">';
                foreach ($day_sum_y as $day_s_y);
                
                echo $day_s_y['cc'].' วัน';
                echo '</th>';
                echo"</tr>";
                ///////////////////////////////
                 echo "<tr>";
                echo '<td>';
                echo'จำนวนผู้ป่วย';
                echo '</td>';
                foreach ($man_sum as $man_s)
                { //วนลูปแสดงข้อมูล
                    echo "<td>";
                    echo $man_s['cc'].' คน';
                    echo "</td>";
                }
                echo '<th class="bg-danger">';
                foreach ($man_y as $man_s_y);
                
                echo $man_s_y['cc'].' คน';
                echo '</th>';
                echo"</tr>";
///////////////////////////////////////////
                 echo "<tr>";
                echo '<td>';
                echo'Readmit 28 Day';
                echo '</td>';
                foreach ($re_ratio as $re_s)
                { //วนลูปแสดงข้อมูล
                    echo "<td>";
                    echo $re_s['re_ratio'];
                    echo "</td>";
                }
                echo '<th class="bg-danger">';
                foreach ($re_ratio_y as $re_s_y);
                
                echo $re_s_y['re_ratio'];
                echo '</th>';
                echo"</tr>";
//////////////////////////////////
                echo "</table>";
                ?>
             
            </div>
        </div>
  <div class="row">
            <div class="container-fluid col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <p>อัตราการครองเตียง</p>
                    </div>
                    <div class="panel-body">
                        <p>(จำนวนวันนอนผู้ป่วยใน*100)/(30*จำนวนวันที่ดูข้อมูล)</p>
                    </div>
                </div>
            </div>
            <div class="container-fluid col-md-3 ">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <p>อัตราตาย(ต่อพัน)ผู้ป่วยใน</p>
                    </div>
                    <div class="panel-body">
                        <p>(จำนวนผู้ป่วยใน*1000)/จำนวนผู้ป่วยที่ DCH ในช่วงเวลา</p>
                    </div>
                </div>
            </div>
            <div class="container-fluid col-md-3 ">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <p>อัตราการใช้เตียง</p>
                    </div>
                    <div class="panel-body">
                        <p>(จำนวนผู้ป่วยใน)/30 เตียง</p>
                    </div>
                </div>
            </div>
             <div class="container-fluid col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <p>วันนอนเฉลี่ย</p>
                    </div>
                    <div class="panel-body">
                        <p>จำนวนวันนอนรวม/จำนวนผู้ป่วยใน</p>
                    </div>
                </div>
            </div>
        </div>






<?php } ?>