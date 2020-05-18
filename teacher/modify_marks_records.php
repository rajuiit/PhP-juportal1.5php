<?php

  ob_start();
  session_start();
  include('../includes/connect.php');
  include('../includes/function.php');


if(isset($_POST['saveData']))
{
    $row_sid =  $_POST['row_sid']; 
    $row_attend = $_POST['row_attend']; 
    $row_ct = $_POST['row_ct'];
    $row_quiz =  $_POST['row_quiz'];
    $row_assignment = $_POST['row_assignment'];
    $row_presentation =  $_POST['row_presentation'];
    $row_final_exam =   $_POST['row_final_exam'];
    $row_data1 = $_POST['row_data1'];
    $row_gpa=$_POST['row_gpa'];
    $row_lg=$_POST['row_lg'];

    $row_sem= $_POST['row_sem'];
    //$row_year=$_POST['row_year'];
    $row_course=$_POST['row_course'];


    //var_dump($row_sid);

$query = $db->query("UPDATE `result` SET `attend`= '".$row_attend."', `ct`='".$row_ct."',`quize`= '".$row_quiz."',`assignment`= '".$row_assignment."',`presentation`= '".$row_presentation."',`final_exam`='".$row_final_exam."',`total`= '".$row_data1."', `lg`= '".$row_lg."', `gp`='".$row_gpa."' where `s_id` = $row_sid and `semester`= '".$row_sem."' and `course_offer_id`= $row_course ");

 echo "success";
 exit();
}


 