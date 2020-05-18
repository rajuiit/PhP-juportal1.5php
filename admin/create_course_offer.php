<?php
  include('header.php');
?>
<?php if(is_admin_Loggedin()):?>
<?php
  if (isset($_POST['create'])){
    $semester = protect($_POST['semester']);
    $course_id = protect($_POST['course_id']);
    $teacher_id = protect($_POST['teacher_id']);
    $time_slot = protect($_POST['time_slot']);
    $day = protect($_POST['day']);

$check = $db->query("SELECT * FROM course_offer WHERE  semester='$semester' and course_id='$course_id' and teacher_id='$teacher_id' and time_slot='$time_slot' and day='$day'");
$check2 = $db->query("SELECT * FROM course_offer WHERE  semester='$semester' and teacher_id='$teacher_id' and time_slot='$time_slot' and day='$day'");

if(empty($semester) or empty($course_id) or empty($teacher_id) or empty($time_slot) or empty($day)) {
      echo error("All fields are required.");
    } elseif($check->num_rows>0) {
      echo error("Course Offer, on <b>$semester  ($day) </b> was exists.");
    } elseif($check2->num_rows>0) {
      echo error("Course Offer by <b>".teacher_info($teacher_id,"name")."</b>, on <b>$semester ($day) </b> was exists.");
    } else {
      $insert = $db->query("INSERT course_offer (semester,course_id,teacher_id,time_slot,day) VALUES ('$semester','$course_id','$teacher_id','$time_slot','$day')");
      echo success("Course Offer, on <b>$semester ($day) </b> was added successfully.");
    }
  }
?>

<h1 class="page-header">Create New Course Offering/Advising</h1>
<form class="form-horizontal" action="" method="post">
 <div class="form-group">
    <label for="semester" class="col-sm-4 control-label">Semester</label>
    <div class="col-sm-5">
        <select class="form-control" id="semester" name="semester">
          <option value="Spring-2017">Spring-2017</option>
          <option value="Summer-2017">Summer-2017</option>
          <option value="Fall-2017">Fall-2017</option>
        </select>
    </div>
  </div>

  <div class="form-group">
    <label for="course_id" class="col-sm-4 control-label">Course Code</label>
    <div class="col-sm-5">
        <select class="form-control" id="course_id" name="course_id">
          <?php
            $query = $db->query("SELECT * FROM course_list ORDER BY id");
            if($query->num_rows>0) {
              while($row = $query->fetch_assoc()) {
                echo '<option value="'.$row[id].'">'.$row[course_code].'</option>';
              }
            } else {
              echo '<option value="null">No Course to Display</option>';
            }
          ?>
        </select>
    </div>
  </div>

  <div class="form-group">
  <label for="teacher_id" class="col-sm-4 control-label">Teacher's Name</label>
  <div class="col-sm-5">
      <select class="form-control" id="teacher_id" name="teacher_id">
      <?php
        $query = $db->query("SELECT * FROM teacher_profile ORDER BY id");
        if($query->num_rows>0) {
          while($row = $query->fetch_assoc()) {
            echo '<option value="'.$row[id].'">'.$row[name].'</option>';
          }
        } else {
          echo '<option value="null">No Teacher to Display</option>';
        }
      ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="time_slot" class="col-sm-4 control-label">Time Slot</label>
    <div class="col-sm-5">
      <input type="time" class="form-control" id="time_slot" name="time_slot" placeholder="Time Slot">
    </div>
  </div>

  <div class="form-group">
    <label for="day" class="col-sm-4 control-label">Day</label>
    <div class="col-sm-5">
        <select class="form-control" id="day"  name="day">
          <option value="sat">Sat</option>
          <option value="sun">Sun</option>
          <option value="mon">Mon</option>
          <option value="tue">Tue</option>
          <option value="wed">Wed</option>
          <option value="thu">Thu</option>
        </select>
      </div>
  </div>

  
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-5">
      <button type="submit" id="create" name="create" class="btn btn-primary btn-block">Save</button>
    </div>
  </div>
</form>

<?php else:?>
<?php header('Location: signin.php');?>
<?php endif?>
<?php
  include('footer.php');
?>