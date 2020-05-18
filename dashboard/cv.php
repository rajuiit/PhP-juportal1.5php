<?php
  include('header.php');
?>
<?php if(is_student_Loggedin()):?>

<h1 class="page-header">Update Student Profile</h1>
  <div class="row" align="center">
      <img src="image/<?php echo student_info($_SESSION['s_id'],'s_id') ?>.jpg" alt="Image is not found" name="image" width="200" height="200" border="2" id="image" />
  </div>
<div class="col-sm-12">
  <h2><b>Personal Information:</b></h2>
  <div class="col-sm-6">
    <div class="row">
      <label for="s_id" class="col-sm-4 control-label">ID</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'s_id'); ?>
      </div>
    </div>
    <div class="row">
      <label for="s_name" class="col-sm-4 control-label">Name</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'s_name'); ?>
      </div>
    </div>
    <div class="row">
      <label for="date_of_birth" class="col-sm-4 control-label">Date of Birth</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'date_of_birth'); ?>
      </div>
    </div>
    <div class="row">
      <label for="nationality" class="col-sm-4 control-label">Nationality</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'nationality'); ?>
      </div>
    </div>
    <div class="row">
      <label for="s_nid" class="col-sm-4 control-label">NID No.</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'s_nid'); ?>
      </div>
    </div>
    <div class="row">
      <label for="gender" class="col-sm-4 control-label">Gender</label>
      <div class="col-sm-8">
          <?php echo student_info($_SESSION['s_id'],'gender'); ?>
      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="row">
      <label for="present_address" class="col-sm-4 control-label">Present Address</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'present_address'); ?>
      </div>
    </div>

    <div class="row">
      <label for="permanent_address" class="col-sm-4 control-label">Permanent Address</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'permanent_address'); ?>
      </div>
    </div>

     <div class="row">
      <label for="s_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'s_mobile'); ?>
      </div>
    </div>
    <div class="row">
      <label for="s_email" class="col-sm-4 control-label">Email</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'s_email'); ?>
      </div>
    </div>
  </div>
</div>

<div class="col-sm-12">
  <h2><b>Parents and Guardians Information:</b></h2>
  <div class="col-sm-6">
    <h4 style="color:red;"><b>Father's Info:</b></h4>
     <div class="row">
      <label for="f_name" class="col-sm-4 control-label">Father's Name</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'f_name'); ?>
      </div>
    </div>
    <div class="row">
      <label for="f_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'f_mobile'); ?>
      </div>
    </div>
    <div class="row">
      <label for="f_nid" class="col-sm-4 control-label">NID</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'f_nid'); ?>
      </div>
    </div>
    <h4 style="color:red;"><b>Guardian's Info:</b></h4>
    <div class="row">
      <label for="g_name" class="col-sm-4 control-label">Guirdian Name</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'g_name'); ?>
      </div>
    </div>

    <div class="row">
      <label for="g_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'g_mobile'); ?>
      </div>
    </div>
    
    <div class="row">
      <label for="g_nid" class="col-sm-4 control-label">NID</label>
      <div class="col-sm-8 ">
        <?php echo student_info($_SESSION['s_id'],'g_nid'); ?>
      </div>
    </div>
  </div>

  <div class="col-sm-6">
  <h4 style="color:red;"><b>Mother's Info:</b></h4>
    <div class="row">
      <label for="m_name" class="col-sm-4 control-label">Mother's Name</label>
      <div class="col-sm-8 ">
        <?php echo student_info($_SESSION['s_id'],'m_name'); ?>
      </div>
    </div>

    <div class="row">
      <label for="m_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-8 ">
        
        <?php echo student_info($_SESSION['s_id'],'m_mobile'); ?>
      </div>
    </div>

    <div class="row">
      <label for="m_nid" class="col-sm-4 control-label">NID</label>
      <div class="col-sm-8 ">
        <?php echo student_info($_SESSION['s_id'],'m_nid'); ?>
      </div>
    </div>
  </div>
</div>

<div class="col-sm-12">
  <h2><b>Admission Details:</b></h2>
  <div class="col-sm-6">
    <div class="row">
      <label for="a_year" class="col-sm-5 control-label">Admission Year</label>
      <div class="col-sm-7">
          <?php  
              echo student_info($_SESSION['s_id'],'a_year');
            
          ?>
      </div>
    </div>
    <div class="row">
      <label for="a_sem" class="col-sm-5 control-label">Admission Semester</label>
      <div class="col-sm-7">
           <p><?php echo student_info($_SESSION['s_id'],'a_sem' );?></p>
        
      </div>
    </div>
    <div class="row">
      <label for="a_sec" class="col-sm-5 control-label">Admission Section</label>
      <div class="col-sm-7">
        <p> <?php echo student_info($_SESSION['s_id'],'a_sec') ;?></p>
        
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="row">
      <label for="a_program" class="col-sm-5 control-label">Admission Program</label>
      <div class="col-sm-7">
        <p><?php echo student_info($_SESSION['s_id'],'a_program') ?></p>
      </div>
    </div>
    <div class="row">
      <label for="reg_no" class="col-sm-5 control-label">Registration No.</label>
      <div class="col-sm-7">
        <p><?php echo student_info($_SESSION['s_id'],'reg_no'); ?></p>
      </div>
    </div>
   
  </div>
</div>
<!--end Admission-->
<div class="col-sm-12">
<?php
   $id=student_info($_SESSION['s_id'],'s_id');
  $query = $db->query("SELECT * FROM education_info WHERE s_roll ='$id'");
  ?>
  <h2><b>Educational Information:</b></h2>
  <table class="table">
    <tr>
      <th>Degree</th>
      <th>Group</th>
      <th>Institution</th>
      <th>Gpa</th>
      <th>Year</th>
    </tr>
  <?php
   if($query->num_rows>0) {
          while($row = $query->fetch_assoc()) { 
            echo '<tr><td>'.$row['degree_name'].'</td><td>'.$row['group_name'].'</td><td>'.$row['school_name'].'</td><td>'.$row['gpa'].'</td><td>'.$row['pass_year'].'</td></tr>';
  }
}
 ?>
</table>
</div>
<div class="col-sm-12">
  <h2><b>Academic Transcript:</b></h2>
  <p><a href="upload/<?php echo student_info($_SESSION['s_id'],'s_id') ?>.pdf" >Download Academic Transcript</a></p>
</div>
<!--Educational Information-->
<div class="col-sm-12">
  <h2><b>Job Experience:</b></h2>
  <p><?php echo student_info($_SESSION['s_id'],'experience'); ?></p>
</div>








<SCRIPT language="javascript">
    function addRow(tableID) {

      var table = document.getElementById(tableID);

      var rowCount = table.rows.length;
      var row = table.insertRow(rowCount);

      var colCount = table.rows[0].cells.length;

      for(var i=0; i<colCount; i++) {

        var newcell = row.insertCell(i);

        newcell.innerHTML = table.rows[0].cells[i].innerHTML;
        //alert(newcell.childNodes);
        switch(newcell.childNodes[0].type) {
          case "text":
              newcell.childNodes[0].value = "";
              break;
          case "checkbox":
              newcell.childNodes[0].checked = false;
              break;
          case "select-one":
              newcell.childNodes[0].selectedIndex = 0;
              break;
        }
      }
    }

    function deleteRow(tableID) {
      try {
      var table = document.getElementById(tableID);
      var rowCount = table.rows.length;

      for(var i=0; i<rowCount; i++) {
        var row = table.rows[i];
        var chkbox = row.cells[0].childNodes[0];
        if(null != chkbox && true == chkbox.checked) {
          if(rowCount <= 1) {
            alert("Cannot delete all the rows.");
            break;
          }
          table.deleteRow(i);
          rowCount--;
          i--;
        }


      }
      }catch(e) {
        alert(e);
      }
    }

  </SCRIPT>




<?php else:?>
<?php header('Location: signin.php'); ?>
<?php endif?>
<?php
include('footer.php');
?>