<?php
  include('header.php');
?>
<?php if(is_teacher_Loggedin()):?>
  <br />
<h1 class="page-header">Result</h1>
<br />
<style type="text/css">
  .res_inp {
    width: 70px;
  }
</style>








<form  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
<div class="row">

 <div class="col-xs-4">
    <select class="form-control" id="sem_id" name="sem_name" onchange="getCourseList(this.value);">
      <option value="">Select Course</option>
      <?php
        $query_sem = $db->query("SELECT * from semester");
        if($query_sem->num_rows>0) {
          while($row_sem = $query_sem->fetch_assoc()) {
            echo '<option value="'.$row_sem["id"].'">'.$row_sem["semester"].'</option>';
          }
        }
      ?>
    </select>
  </div>

  <div class="col-xs-4">
    <select class="form-control" id="course_id" name="course_name">
      <option value="" disabled selected>Select Course</option>
    </select>
  </div>


<div class="col-xs-2">

  <input type="submit" class="btn btn-primary" id="sub" name="sub" value="Submit">

</div>
</div>
</form>




<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Attend</th>
        <th>CT</th>
        <th>Quiz</th>
        <th>Assign</th>
        <th>Present</th>
        <th>Final</th>
        <th>Total</th>
        <th>CGPA</th>
        <th>Grade Point</th>
        <th>Absent</th>
        <th>Action</th>
      </tr>
    </thead>

    <tbody >
        
        <?php
        
        if (isset($_POST['sub'])) {


        
        $checkvalue="";

        $sem= $_POST['sem_name'];
        $course_id= $_POST['course_name'];
        /*$str= $_POST['sem_name'];
        $course_id= $_POST['course_name'];
        $sem=explode('-',$str);
 
        $query = $db->query("SELECT sp.s_id, sp.s_name FROM student_profile as sp, registration as r where r.s_id=sp.s_id  and r.semester = '".$sem[0]."' and r.year = '".$sem[1]."' and r.cid='".$course_id."' ORDER BY sp.s_id");

        if($query->num_rows>0) {
          //$ind=1;
          while($row = $query->fetch_assoc()) {

              $query2 = $db->query("INSERT IGNORE INTO `result` (`id`, `s_id`, `st_name`, `semester`, `year`, `course_offer_id`) values(null,'".$row['s_id']."','".$row['s_name']."', '".$sem[0]."', '".$sem[1]."', '".$_POST['course_name']."') ");
             
            
              }

            }*/
$ind=1;
         $query3 = $db->query("SELECT * from result where semester = '".$sem."' and course_offer_id='".$course_id."' ");

        if($query3->num_rows>0) {
          while($row3 = $query3->fetch_assoc()) {
 
        
        //$str1= $_POST['sem_name'];
        $course_id1= $_POST['course_name'];
        //$sem1=explode('-',$str1);

        print '<tr id1="1" style="background:'.$row3['color'].'">
     
        <div class="col-sm-4" >

<td width="40%"><input type="text" id="s_id'.$ind.'" class="form-control s_id'.$ind.'" name="s_id[]"  value='.$row3['s_id'].' disabled></td>

        </div>


        <div class="col-sm-8"> 
       
    <td><input type="text" id="attend'.$ind.'" class="form-control res_inp attend'.$ind.'" name="attend[]" value="'.$row3['attend'].'" onchange="get_total('.$ind.');"></td>
    <td><input type="text" id="ct'.$ind.'" class="form-control res_inp ct'.$ind.'" name="ct[]" value="'.$row3['ct'].'" onchange="get_total('.$ind.');"></td>
    <td><input type="text" id="quiz'.$ind.'" class="form-control res_inp quiz'.$ind.'" name="quiz[]" value="'.$row3['quize'].'" onchange="get_total('.$ind.');"></td>
    <td><input type="text" id="assignment'.$ind.'" class="form-control res_inp assignment'.$ind.'" name="assignment[]" value="'.$row3['assignment'].'" onchange="get_total('.$ind.');"></td>
        <td><input type="text" id="presentation'.$ind.'" class="form-control res_inp presentation'.$ind.'" name="presentation[]" value="'.$row3['presentation'].'" onchange="get_total('.$ind.');"></td>
        <td><input type="text" id="final_exam'.$ind.'" class="form-control res_inp final_exam'.$ind.'" name="final_exam[]" value="'.$row3['final_exam'].'" onchange="get_total('.$ind.');"></td>
        <td><input type="text" id="total'.$ind.'" class="form-control res_inp total'.$ind.'" name="total[]" value="'.$row3['total'].'" disabled  onchange="get_total('.$ind.');"></td>
        <td><input type="text" id="gpa'.$ind.'" class="form-control res_inp gpa'.$ind.'" name="gpa[]" value="'.$row3['gp'].'"  disabled onchange="get_total('.$ind.');" ></td>

        <td><input type="text" id="grade'.$ind.'" class="form-control res_inp grade'.$ind.'" name="grade[]" value="'.$row3['lg'].'"  disabled onchange="get_total('.$ind.');" ></td>

        <td>
        <input type="checkbox" id="absent'.$ind.'"  class=" res_inp absent'.$ind.'"  name="absent" value="'.$checkvalue.'" onchange="get_total('.$ind.');"></td>

            <input type="hidden" id="sem'.$ind.'" name="sem'.$ind.'" value="'.$sem.'" >
            <input type="hidden" id="course'.$ind.'" name="course'.$ind.'" value="'.$course_id.'">


        
        <td><input type="submit" class="btn btn-primary save_button'.$ind.'" value="Save" id="save_button'.$ind.'"  onclick="insert_data('.$ind.');"> </td>

        </div>
        </tr>';

          $ind++;

          }


        } else {
          echo '<tr><td>No Student to Display</td></tr>';
        }
      }

      ?>

    </tbody>

  </table>
</div>











<?php else:?>
<?php header('Location: signin.php'); ?>
<?php endif?>
<?php
	include('footer.php');
?>