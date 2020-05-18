<?php
  include('header.php');
  if(isset($_GET['action'])) {
    $action = protect($_GET['action']);
  }
?>
<?php if(is_admin_Loggedin()):?>

<?php if(isset($_GET['action']) and $action == 'edit') {
  $id = protect($_GET['id']);
  if (isset($_POST['save'])){
    $semester = protect($_POST['semester']);
    $course_id = protect($_POST['course_id']);
    $teacher_id = protect($_POST['teacher_id']);
    $time_slot = protect($_POST['time_slot']);
    $day = protect($_POST['day']);

    
    $check = $db->query("SELECT * FROM course_offer WHERE   semester='$semester' and course_id='$course_id' and teacher_id='$teacher_id' and time_slot='$time_slot' and day='$day'");
    $check2 = $db->query("SELECT * FROM course_offer WHERE   semester='$semester' and teacher_id='$teacher_id' and time_slot='$time_slot' and day='$day'");

    if( empty($semester) or empty($course_id) or empty($teacher_id) or empty($time_slot) or empty($day)) {
      echo error("All fields are required.");
    } elseif($check->num_rows>0) {
      echo error("Course Offer, on <b>$semester ($day) </b> was exists.");
    } elseif($check2->num_rows>0) {
      echo error("Course Offer by <b>".teacher_info($teacher_id,"name")."</b>, on <b>$semester  ($day) </b> was exists.");
    } else {
      $update = $db->query("UPDATE course_offer SET semester='$semester', course_id='$course_id', teacher_id='$teacher_id', time_slot='$time_slot', day='$day' WHERE id='$id'");
      echo success("Course Offer by <b>".teacher_info($teacher_id,"name")."</b>, on <b>$semester  ($day) </b> was edited successfully.");
    }
  }

  $query = $db->query("SELECT * FROM course_offer WHERE id=$id ");
  if ($query->num_rows > 0) {
    $row = $query->fetch_assoc();
  }
?>

<div class="panel-heading">
  <h1 class="page-title">Edit Course Offering/Advising</h1>
</div>
<div class="panel-body">
  <form class="form-horizontal" action="" method="post">
  

  <div class="form-group">
    <label for="semester" class="col-sm-4 control-label">Semester</label>
    <div class="col-sm-5">
      <select class="form-control" id="semester" name="semester">
        <option value="Spring-2017" <?php if($row['semester'] == "Spring-2017") { echo 'selected'; } ?>>Spring-2017</option>
        <option value="Summer-2017" <?php if($row['semester'] == "Summer-2017") { echo 'selected'; } ?>>Summer-2017</option>
        <option value="Fall-2017" <?php if($row['semester'] == "Fall-2017")     { echo 'selected'; } ?>>Fall-2017</option>
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
            while($course = $query->fetch_assoc()) {
              if($course['id'] == $row['course_id']) {
                $selected = "selected";
              } else {
                $selected = "";
              }
              echo '<option value="'.$course[id].'"'.$selected.'>'.$course[course_code].'</option>';
            }
          } else {
            echo '<option value="null>No Course to Display</option>';
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
          while($teacher = $query->fetch_assoc()) {
            if($teacher['id'] == $row['teacher_id']) {
              $selected = "selected";
            } else {
              $selected = " ";
            }
            echo '<option value="'.$teacher['id'].'"'.$selected.'>'.$teacher['name'].'</option>';
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
          <option value="sat" <?php if($row['day'] == "sat") { echo 'selected'; } ?>>Sat</option>
          <option value="sun" <?php if($row['day'] == "sun") { echo 'selected'; } ?>>Sun</option>
          <option value="mon" <?php if($row['day'] == "mon") { echo 'selected'; } ?>>Mon</option>
          <option value="tue" <?php if($row['day'] == "tue") { echo 'selected'; } ?>>Tue</option>
          <option value="wed" <?php if($row['day'] == "wed") { echo 'selected'; } ?>>Wed</option>
          <option value="thu" <?php if($row['day'] == "thu") { echo 'selected'; } ?>>Thu</option>
        </select>
      </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-5">
      <button type="submit" id="save" name="save" class="btn btn-primary btn-block">Save</button>
    </div>
  </div>
</form>
</div>

<?php } else if(isset($_GET['action']) and $action == 'delete') { 
  $id = protect($_GET['id']);
  $query = $db->query("SELECT * FROM course_offer WHERE id='$id'");
  if($query->num_rows==0) { header("Location: course_offer_list.php"); }
  $row = $query->fetch_assoc();
?>
<h2 class="sub-header">Delete Course Offering/Advising</h2>
<?php

  if(isset($_GET['confirm'])) {
    $delete = $db->query("DELETE FROM course_offer WHERE id='$row[id]'");
    echo success("Course Offer by <b>".teacher_info($row['teacher_id'],"name")."</b>, on <b>$row[semester] $row[year] (".day_name($row['day']).") </b> was deleted successfully.");
  } else {
    echo info("Are you sure you want to delete Course Offer by <b>".teacher_info($row['teacher_id'],"name")."</b>, on <b>$row[semester] (".day_name($row['day']).") </b>?");
    echo '<a href="./course_offer_list.php?&action=delete&id='.$id.'&confirm=1" class="btn btn-success"><i class="fa fa-check"></i> Yes</a>&nbsp;&nbsp;
      <a href="./course_offer_list.php" class="btn btn-danger"><i class="fa fa-times"></i> No</a>';
  }
?>
<?php } 
else if(isset($_GET['action']) and $action == 'search') {
  if (isset($_POST['type'])) {
    $type = protect($_POST['type']);
  }
  if (isset($_POST['key'])) {
    $key = protect($_POST['key']);
  }
  if ($type == 'semester') {
    $check = $db->query("SELECT * FROM course_offer WHERE semester ='$key' ORDER BY `course_offer`.`id` DESC");
  } else if ($type == 'teacher_id') {
    $check = $db->query("SELECT * FROM course_offer INNER JOIN teacher_profile on course_offer.teacher_id=teacher_profile.id WHERE teacher_profile.name LIKE '%$key%' ORDER BY `course_offer`.`id` DESC");
  } 
?>
<h2 class="sub-header">Result of: <?php echo $key; ?></h2>
<form  method="post" action="?action=search" >
  <div class="row">
    <div class="col-xs-4">
      <select class="form-control" id="type" name="type">
        <option value="semester" selected>Semester</option>
        <option value="teacher_id">Teacher</option>
      </select>
    </div>

    <div class="col-xs-4">
      <input type="text" class="form-control" id="key" name="key">
    </div>

    <div class="col-xs-2">

      <input type="submit" class="btn btn-primary" id="search" name="search" value="Search">
    </div>
  </div>
</form>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#Sl</th>
        <th>Semester</th>
        <th>Course</th>
        <th>Teacher</th>
        <th>Time</th>
        <th>Day</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if($check->num_rows>0) {
          $i = 1;
          while($row = $check->fetch_assoc()) {
            echo '<tr><td>'.$i.'</td><td>'.ucfirst($row['semester']).'</td><td>'.get_info("course_list",$row["course_id"],"course_code").'</td><td>'.teacher_info($row["teacher_id"],"name")." ".teacher_credit($row["teacher_id"],"credit").'</td><td>'.$row["time_slot"].'</td><td>'.day_name($row["day"]).'</td><td><a href="course_offer_list.php?action=edit&id='.$row['id'].'">Edit</a> | <a href="course_offer_list.php?action=delete&id='.$row['id'].'">Delete</a></td></tr>';
           $i++;
          }
        } else {
          echo '<tr><td>No Student to Display</td></tr>';
        }
      ?>
    </tbody>
  </table>
</div>
<?php }//search result end
else { ?>
<h2 class="sub-header">All Course Offering/Advising</h2>

<form  method="post" action="?action=search" >
  <div class="row">
    <div class="col-xs-4">
      <select class="form-control" id="type" name="type">
        <option value="semester" selected>Semester</option>
        <option value="teacher_id">Teacher</option>
      </select>
    </div>

    <div class="col-xs-4">
      <input type="text" class="form-control" id="key" name="key">
    </div>

    <div class="col-xs-2">

      <input type="submit" class="btn btn-primary" id="search" name="search" value="Search">
    </div>
  </div>
</form>

<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#Sl</th>
        <th>Semester</th>
        <th>Course</th>
        <th>Teacher</th>
        <th>Time</th>
        <th>Day</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $query = $db->query("SELECT * FROM `course_offer` ORDER BY `course_offer`.`id` DESC");
        if($query->num_rows>0) {$i=1;
          while($row = $query->fetch_assoc()) {
            echo '<tr><td>'.$i.'</td><td>'.ucfirst($row['semester']).'</td><td>'.get_info("course_list",$row["course_id"],"course_code").'</td><td>'.teacher_info($row["teacher_id"],"name")." ".teacher_credit($row["teacher_id"],"credit").'</td><td>'.$row["time_slot"].'</td><td>'.day_name($row["day"]).'</td><td><a href="course_offer_list.php?action=edit&id='.$row['id'].'">Edit</a> | <a href="course_offer_list.php?action=delete&id='.$row['id'].'">Delete</a></td></tr>';
          $i++;}
        } else {
          echo '<tr><td>No Course offer to Display</td></tr>';
        }
      ?>
    </tbody>
  </table>
</div>
<?php } ?>




<?php else:?>
<?php header('Location: signin.php');?>
<?php endif?>
<?php
  include('footer.php');
?>