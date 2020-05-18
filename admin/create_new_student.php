<?php
  include('header.php');
?>
<?php if(is_admin_Loggedin()):?>
<?php
  if (isset($_POST['create'])){
    $s_id = protect($_POST['s_id']);
    $s_name = protect($_POST['s_name']);
    $s_mobile = protect($_POST['s_mobile']);
    $date_of_birth = protect($_POST['date_of_birth']);
    $studentship = protect($_POST['studentship']);
    $s_email = protect($_POST['s_email']);
    $s_hall = protect($_POST['s_hall']);
    $a_year = protect($_POST['a_year']);
    $a_sem = protect($_POST['a_sem']);
    $a_sec = protect($_POST['a_sec']);
    $a_program = protect($_POST['a_program']);
    $reg_no = protect($_POST['reg_no']);
    $password = protect($_POST['password']);
     
    
    if($_FILES['file1']['name']) {
      image_upload();
      }


    $check = $db->query("SELECT * FROM student_profile WHERE s_id='$s_id'");
    if(empty($s_id) or empty($s_name) or empty($s_hall)or empty($s_mobile) or empty($studentship) or empty($s_email) or empty($password)
      or empty($a_year)or empty($a_sem)or empty($a_sec)or empty($a_program)or empty($reg_no) or empty($date_of_birth)) { echo error("All fields are required."); }
    elseif($check->num_rows>0) { echo error("Student, <b>$s_name ($s_id) </b> was exists."); }
    else {
      $pass = md5($password);
      $insert = $db->query("INSERT student_profile (s_id,s_name,s_mobile,studentship,s_email,password,hall,a_year,a_sem,a_sec,a_program,reg_no,date_of_birth) VALUES ('$s_id','$s_name','$s_mobile','$studentship','$s_email','$pass','$s_hall','$a_year','$a_sem','$a_sec','$a_program','$reg_no','$date_of_birth')");
      
      echo success("Student, <b>$s_name ($s_id) </b> was added successfully.");
    }
  }

?>

<div class="panel-heading">
  <h1 class="page-title">Create New Student</h1>
</div>
<div class="panel-body">
  <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
    <div class="form-group">
      <label for="s_id" class="col-sm-4 control-label">Student ID</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="s_id" name="s_id" placeholder="Student Id">
      </div>
    </div>

    <div class="form-group">
      <label for="s_name" class="col-sm-4 control-label">Student Name</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="s_name" name="s_name" placeholder="Student Name">
      </div>
    </div>
    <div class="form-group">
      <label for="date_of_birth" class="col-sm-4 control-label">Date of Birth</label>
      <div class="col-sm-5">
        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Date of Birth" value="<?php echo student_info($_SESSION['s_id'],'date_of_birth'); ?>" />
      </div>
    </div>
    <div class="form-group">
      <label for="s_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="s_mobile" name="s_mobile" placeholder="Student Mobile Number">
      </div>
    </div>

    <div class="form-group">
      <label for="s_email" class="col-sm-4 control-label">Email</label>
      <div class="col-sm-5">
        <input type="email" class="form-control" id="s_email" name="s_email" placeholder="Email">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-4 control-label">Hall</label>
      <div class="col-sm-5">
          <select class="form-control"  name="s_hall">
            <?php 
            $query = $db->query("SELECT * FROM hall");
            if($query->num_rows>0) {
              $i = 1;
              while($row = $query->fetch_assoc()) {
                echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                $i++;
              }
            } else {
              echo '<option value="others">Others</option>';
            }?>
            
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="password" class="col-sm-4 control-label">Password</label>
      <div class="col-sm-5">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      </div>
    </div>

    <div class="form-group">
      <label for="studentsihp" class="col-sm-4 control-label">Studentship</label>
      <div class="col-sm-5">
          <select class="form-control" id="studentship" name="studentship">
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
      </div>
    </div>
    <div class="form-group">
      <label  class="col-sm-4 control-label">Admission Year</label>
      <div class="col-sm-5">
          <select class="form-control" name="a_year" id="a_year">
          <?php
            for($y=date("Y")-5; $y<date("Y")+5; $y++){
              if($y == student_info($_SESSION['s_id'],'a_year')) {
                  $selected = "selected";
                } else {
                  $selected = "";
                }
              echo '<option value="'.$y.'"'.$selected.'>'.$y.'</option>';
            }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label  class="col-sm-4 control-label">Admission Semester</label>
      <div class="col-sm-5">
          <select class="form-control" id="a_sem" name="a_sem">
          <option value="spring" >Spring</option>
          <option value="summer" >Summer</option>
          <option value="fall" >Fall</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label  class="col-sm-4 control-label">Admission Section</label>
      <div class="col-sm-5">
          <select class="form-control" id="a_sec" name="a_sec">
          <option value="a" >A</option>
          <option value="b" >B</option>
          <option value="c" >C</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label">Admission Program</label>
      <div class="col-sm-5">
          <select class="form-control" id="a_program" name="a_program">
            <?php 
            $query = $db->query("SELECT * FROM program");
            if($query->num_rows>0) {
              $i = 1;
              while($row = $query->fetch_assoc()) {
                echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                $i++;
              }
            } else {
              echo '<option value="others">Others</option>';
            }?>
            
        </select>
      </div>
    </div>
    <div class="form-group">
      <label  class="col-sm-4 control-label">Registration No.</label>
      <div class="col-sm-5">
          <input class="form-control" type="text" name="reg_no" >
      </div>
    </div>
    <div class="form-group">
      <label for="exampleInputFile" class="col-sm-4 control-label">Upload Your Picture</label>
        <div class="col-sm-5">
          <input type="file" id="file" name="file1" onchange="readURL(this);">
          <p class="help-block">Size must be less than 250 KB</p>
          <span style="color:Red;">Only JPEG Format</span> 
      </div>
   </div>
    <div class="form-group">
      <div class="col-sm-offset-4 col-sm-5">
        <button type="submit" id="create" name="create" class="btn btn-primary btn-block">Create</button>
      </div>
    </div>
  </form>
</div>

<?php else:?>
<?php header('Location: signin.php');?>
<?php endif?>
<?php
  include('footer.php');
?>