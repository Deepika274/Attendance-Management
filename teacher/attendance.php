<?php

ob_start();
session_start();

if($_SESSION['name']!='oasis')
{
  header('location: login.php');
}
?>

<?php
    include('connect.php');
    try{
      
    if(isset($_POST['save'])){

      $course1 = $_POST['whichcourse'];

      foreach ($_POST['st_status'] as $i => $st_status) {
        
        $stat_id = $_POST['stat_id'][$i];
        $dp = $_POST['date'];
        $course = $_POST['whichcourse'];
        $lectureid = $_POST['lectureid'][$i];
        $stat = "insert into project.attendance(rollno,lectureid,courseid,status) values('$stat_id','$lectureid', '$course1','$st_status')";
        $stmt1 = $conn->exec($stat);
        $att_msg = "Attendance Recorded.";

      }



    }
  }
  catch(Execption $e){
    $error_msg = $e->$getMessage();
  }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Online Attendance Management System 1.0</title>
<meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
   
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
   
  <link rel="stylesheet" href="styles.css" >
   
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<style type="text/css">
  .status{
    font-size: 10px;
  }

</style>

</head>
<body>

<header>

  <h1>Online Attendance Management System 1.0</h1>
  <div class="navbar">
  <a href="index.php">Home</a>
  <a href="students.php">Students</a>
  <a href="attendance.php">Attendance</a>
  <a href="report.php">Report</a>
  <a href="../logout.php">Logout</a>

</div>

</header>

<center>

<div class="row">

  <div class="content">
    <!--<h3>Attendance of <?php// echo date('Y-m-d'); ?></h3>-->
    <br>

    <center><p><?php if(isset($att_msg)) echo $att_msg; if(isset($error_msg)) echo $error_msg; ?></p></center> 
    
    <form action="" method="post" class="form-horizontal col-md-6 col-md-offset-3">

     <div class="form-group">

               <label>Select Date</label>
                <input type="date" name="date" id="input2" placeholder="enter date">
              </div>

              <div class="form-group">

        <label >Select Subject</label>
        <select name="whichcourse" id="input1">
      <option  value="MA518">Database Management System</option>
        <option  value="LMA518">Database Management System Lab</option>
         <option  value="MA506">Number Theory and Cryptography</option>
         <option  value="MA514">Theory of Computation</option>
        <option  value="MA543">Functional Analysis</option>
        <option  value="MA572">Numerical Analysis</option>
        <option  value="LMA572">Numerical Analysis Lab</option>

      </select>

      </div>
               
     <input type="submit" class="btn btn-primary col-md-2 col-md-offset-5" value="Mark!" name="mark" />

   <!-- </form>

    <div class="content"></div>
   <!-- <form action="" method="post">-->

     <!-- <div class="form-group">

        <label >Select Subject</label>
        <select name="whichcourse" id="input1">
      <option  value="MA518">Database Management System</option>
        <option  value="LMA518">Database Management System Lab</option>
         <option  value="MA506">Number Theory and Cryptography</option>
         <option  value="MA514">Theory of Computation</option>
        <option  value="MA543">Functional Analysis</option>
        <option  value="MA572">Numerical Analysis</option>
        <option  value="LMA572">Numerical Analysis Lab</option>

      </select>

      </div>-->

    <table class="table table-stripped">
      <thead>
        <tr>
          <th scope="col">Roll No.</th>
          <th scope="col">Name</th>
          <th scope="col">Lecture id</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
   <?php

    if(isset($_POST['mark'])){
        $date = $_POST['date'];
        $course = $_POST['whichcourse'];
     $i=0;
     $radio = 0;
     $all_query = "select s.rollno , s.sname , l.lectureid from project.student s , project.lecture l , project.enrolled e where l.date = '$date'and l.courseid = '$course' and e.courseid = l.courseid and e.rollno = s.rollno";
     $stmt = $conn->prepare($all_query);
     $stmt->execute();
     while ($data = $stmt->fetch()) {
       $i++;
     ?>
  <body>
     <tr>
       <td><?php echo $data['rollno']; ?> <input type="hidden" name="stat_id[]" value="<?php echo $data['rollno']; ?>"> </td>
       <td><?php echo $data['sname']; ?></td>
       <td><?php echo $data['lectureid']; ?></td><input type="hidden" name="lectureid[]" value="<?php echo $data['lectureid']; ?>"> </td>
       <td>
         <label>Present</label>
         <input type="radio" name="st_status[<?php echo $radio; ?>]" value="Present" >
         <label>Absent </label>
         <input type="radio" name="st_status[<?php echo $radio; ?>]" value="Absent" checked>
       </td>
     </tr>
  </body>

     <?php

        $radio++;
      } 
}
      ?>
    </table>

    <center><br>
    <input type="submit" class="btn btn-primary col-md-2 col-md-offset-10" value="Save!" name="save" />
  </center>

</form>
  </div>

</div>

</center>

</body>
</html>
