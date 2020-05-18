function get_total(id) {

  var s_id = $("#s_id"+id).val();
  var sname = $("#same"+id).val();
  var attend = $("#attend"+id).val();
  var ct = $("#ct"+id).val();
  var quiz = $("#quiz"+id).val();
  var assignment = $("#assignment"+id).val();
  var presentation = $("#presentation"+id).val();
  var final_exam = $("#final_exam"+id).val();
  var absent = $("#absent"+id).val();
  var sum = (1*attend)+(1*ct)+(1*quiz)+(1*assignment)+(1*presentation)+(1*final_exam);
  var data1 = sum.toFixed(1);
  
  var color="green";
  $("#total"+id).val(data1);

  if(data1 >= 80 && data1 <= 100) { 
    $("#gpa"+id).val("4.00");
    $("#grade"+id).val("A+");
  } else if(data1 >= 75 && data1 <= 79) { 
    $("#gpa"+id).val("3.75");
    $("#grade"+id).val("A");
  } else if(data1 >= 70 && data1 <= 74) { 
    $("#gpa"+id).val("3.50");
    $("#grade"+id).val("A-");
  } else if(data1 >= 65 && data1 <= 69) { 
    $("#gpa"+id).val("3.25");
    $("#grade"+id).val("B+");
  } else if(data1 >= 60 && data1 <= 64) { 
    $("#gpa"+id).val("3.00");
    $("#grade"+id).val("B");
  } else if(data1 >= 55 && data1 <= 59) { 
    $("#gpa"+id).val("2.75");
    $("#grade"+id).val("C+");
  } else if(data1 >= 50 && data1 <= 54) { 
    $("#gpa"+id).val("2.50");
    $("#grade"+id).val("C");
  } else if(data1 >= 45 && data1 <= 49) { 
    $("#gpa"+id).val("2.25");
    $("#grade"+id).val("D+");
  } else if(data1 >= 40 && data1 <= 44) { 
    $("#gpa"+id).val("2.00");
    $("#grade"+id).val("D");
  } else {
    $("#gpa"+id).val("0.00");
    $("#grade"+id).val("F");
  }

}

function insert_data(id) {

  var sid = $(".id"+id).val();
  var s_id = $(".s_id"+id).val();
  var attend = $(".attend"+id).val();
  var ct = $(".ct"+id).val();
  var quiz = $(".quiz"+id).val();
  var assignment = $(".assignment"+id).val();
  var presentation = $(".presentation"+id).val();
  var final_exam = $(".final_exam"+id).val();
  var absent = $(".absent"+id).val();
  var sum = (1*attend)+(1*ct)+(1*quiz)+(1*assignment)+(1*presentation)+(1*final_exam);
  var data1 = sum.toFixed(1);
  var color="green";
  $(".total"+id).val(data1);


     var gpa= $(".gpa"+id).val();
     var lg = $(".grade"+id).val();

     var sem= $("#sem"+id).val();
     //var year= $("#year"+id).val();
     var course= $("#course"+id).val();

     var saveBT = $("#save_button"+id).val();
     

//var saveB=saveBT+id;
    
    //alert(saveBT);
    //alert(s_id);
    //alert(attend);
    //alert(ct);
    //alert(quiz);
    //alert(assignment);
    //alert(presentation);
    //alert(final_exam);
    
    //alert(year);
    

    $.ajax({
    method:'POST',
    url:'modify_marks_records.php',
    data:{
    saveData:saveBT,
    row_sid: s_id,
    row_attend:attend,
    row_ct:ct,
    row_quiz:quiz,
    row_assignment:assignment,
    row_presentation:presentation,
    row_final_exam:final_exam,
    row_data1:data1,  
    row_gpa:gpa,
    row_lg: lg,
    row_ab: absent,
    row_co: color,
    row_sem:sem,
    //row_year:year,
    row_course:course
    },
    success:function(response) {
      if(response=="success") {
          alert("Data Inserted Succesfully");
        $(msg).hide(3000);
      } else {
        alert("Data not Inserted");
      }
    }
  });

}


function getCourseList(sem_id) {
  $.ajax({
    url: "course_list_dropdown.php",
    method:"POST",
    data:{
      sem_id:sem_id
    },
    datatype:"text",
    success:function(data){
      $('#course_id').html(data);
    }

  });
}

//get courses list
function getParentCourses() {

    $.ajax({
        url: "fetch.php",
        method: "POST",
        data: {parent: "parent"},
        success: function (data) {
            $('#parent_dropdown').html(data)
        }
    });
}
//getParentCourses();






///js function



function take_course(id) {


     var course1= $(".course_offer_id"+id).val();
      //var c= $('.course_offer_id+id:checked').serialize();
    
     

//var saveB=saveBT+id;
    
    //alert(saveBT);
    //alert(s_id);
    //alert(attend);
    //alert(ct);
    //alert(quiz);
    //alert(assignment);
    //alert(presentation);
    //alert(final_exam);
    

    alert(course1);
    //alert(c);
    

    $.ajax({
    method:'POST',
    url:'check_course_records.php',
    data:{
    row_course:course1
    },
    success:function(response) {
      if(response=="success") {
          alert("You are eligible");
          $(".course_offer_id"+id).prop('checked', true);
          console.log(response);
        //$(msg).hide(3000);
      } else {
        alert("You are not eligible");
        $(".course_offer_id"+id).prop('checked', false);
        console.log(response);
      }
    }
  });

}