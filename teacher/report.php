<?php

ob_start();
session_start();

if($_SESSION['name']!='oasis')
{
  header('location: login.php');
}
?>
<?php include('connect.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Online Attendance Management System</title>
<meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
   
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
   
  <link rel="stylesheet" href="styles.css" >
   
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<header>

  <h1>Online Attendance Management System </h1>
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
    <h3>Individual Report</h3>

    <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
    <div class="form-group">

<label  for="input1" class="col-sm-3 control-label">Select Subject</label>
  <div class="col-sm-4">
   <!-- <label>Select subject</label>-->
    <select name="whichcourse">
    <option  value="MA506">Number Theory and Cryptography</option>
         <option  value="MA514">Theory of Computation</option>
        <option  value="MA518">Database Management System</option>
        <option  value="MA543">Functional Analysis</option>
        <option  value="MA572">Numerical Analysis</option>
    </select>
    </div>

</div>


<div class="form-group">
           <label for="input1" class="col-sm-3 control-label">Student Roll No.</label>
              <div class="col-sm-7">
                  <input type="text" name="rollno"  class="form-control" id="input1" placeholder="enter your roll no." />
              </div>
       
    <!--  <label>Student Roll No.</label>
      <input type="text" name="rollno">-->
      <input type="submit" class="btn btn-primary col-md-3 col-md-offset-7"  name="sr_btn" value="Go!" >

    </form>
    <br>
    <p> </p>
    <div class="content">
    <h3><center>Mass Report</center></h3>
    <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
    <div class="form-group">
    <label  for="input1" class="col-sm-3 control-label">Select Subject</label>
      <div class="col-sm-4">
   <!-- <label>Select Subject</label>-->
    <select name="course">
    <option  value="MA506">Number Theory and Cryptography</option>
         <option  value="MA514">Theory of Computation</option>
        <option  value="MA518">Database Management System</option>
        <option  value="MA543">Functional Analysis</option>
        <option  value="MA572">Numerical Analysis</option>
    </select>
    </div>

</div>

    <div class="form-group">
           <label for="input1" class="col-sm-3 control-label">Date</label>
              <div class="col-sm-7">
                  <input type="date" name="date"  class="form-control" id="input1" placeholder="" />
              </div>
        </div>
     <!-- <label>Date ( yyyy-mm-dd)</label>
      <input type="text" name="date">-->
      <input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" name="sr_date" value="Go!" >
    </form>
    </div>
    <br>

    <br>

   <?php

    if(isset($_POST['sr_btn'])){

     $rollno = $_POST['rollno'];
     $course = $_POST['whichcourse'];

     $single = $conn->query("select A.rollno,count(*) as countP from project.attendance A where A.rollno= '$rollno' and A.courseid = '$course' and A.status='Present'");
      $singleT= $conn->query("select count(distinct A.lectureid) as countT from project.attendance A where A.courseid = '$course'");
    //  $count_tot = mysql_num_rows($singleT);
  } 

    if(isset($_POST['sr_date'])){

     $sdate = $_POST['date'];
     $course = $_POST['course'];

     $all_query = $conn->query("select S.sname, A.rollno, A.status from project.attendance A, project.lecture L, project.student S where L.date='$sdate' and L.courseid = '$course' and A.lectureid = L.lectureid and S.rollno = A.rollno");

    }
    if(isset($_POST['sr_date'])){

      ?>

    <table class="table table-stripped">
      <thead>
        <tr>
          <th scope="col">Roll No.</th>
          <th scope="col">Name</th>
          <th scope="col">Attendance Status</th>
        </tr>
     </thead>


    <?php

     $i=0;
     while ($data = $all_query->fetch(PDO::FETCH_ASSOC)) {

       $i++;

     ?>
        <tbody>
           <tr>
             <td><?php echo $data['rollno']; ?></td>
             <td><?php echo $data['sname']; ?></td>
             <td><?php echo $data['status']; ?></td>
             
           </tr>
        </tbody>

     <?php 
   } 
  }
     ?>
     
    </table>


    <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
    <table class="table table-striped">

    <?php


    if(isset($_POST['sr_btn'])){

       $count_pre = 0;
       $i= 0;
       $count_tot = 0;
       if($row=$singleT->fetch(PDO::FETCH_ASSOC))
       {
       //$count_tot=$row[0];
       }
       while ($data = $single->fetch(PDO::FETCH_ASSOC)) {
       $i++;
       
       if($i <= 1){
     ?>


     <tbody>
      <tr>
          <td>Student Roll No: </td>
          <td><?php echo $data['rollno']; ?></td>
      </tr>

           <?php
         //}
        
        // }

      ?>
      
      <tr>
        <td>Total Class (Days): </td>
        <td><?php echo $row['countT']; ?> </td>
      </tr>

      <tr>
        <td>Present (Days): </td>
        <td><?php echo $data['countP']; ?> </td>
      </tr>

      <tr>
        <td>Absent (Days): </td>
        <td><?php echo $row['countT'] -  $data['countP']; ?> </td>
      </tr>

      <tr>
        <td>Attendance Percentage: </td>
        <td><?php echo ( $data['countP'] * 100)/$row['countT']. "%"; ?> </td>
      </tr>


    </tbody>

   <?php

     }  
    }}
     ?>
    </table>
  </form>

  </div>

</div>

</center>

</body>
</html>
