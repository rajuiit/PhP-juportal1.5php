<?php
  include('header.php');
?>
<?php if(is_student_Loggedin()):?>
<div class="container-fluid">
	<br>
   <div class="row" align="center">
   	 <div class="col-sm-4 col-sm-push-8 " >
   	 	<img src="image/<?php echo student_info($_SESSION['s_id'],'s_id') ?>.jpg" alt="Image is not found" name="image" width="200" height="200" border="2" id="image" />
   	 </div>
   	 <div class="col-sm-6 well col-sm-offset-2 col-sm-pull-4 " style="">
   	 	<div class="col-sm-offset-1" align="left">
   	 		<h2><label for="date_of_birth" class="control-label">Name : 
		        <?php echo student_info($_SESSION['s_id'],'s_name'); ?>
		      </label><br>
		      <label for="date_of_birth" class="control-label">Email : 
		        <?php echo student_info($_SESSION['s_id'],'s_email'); ?>
		      </label><br>
		      <label for="date_of_birth" class="control-label">Phone : 
		        <?php echo student_info($_SESSION['s_id'],'s_mobile'); ?>
		      </label>
		      </h2>
   	 	</div>
   	 </div>
   </div>
</div>
<?php else:?>
<?php header('Location: signin.php'); //echo "Not Loggedin"; ?>
<?php endif?>
<?php
	include('footer.php');
?>