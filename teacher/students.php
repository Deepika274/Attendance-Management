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
<title>Online Attendance Management System </title>
<meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
   
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
   
  <link rel="stylesheet" href="styles.css" >
   
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
    <h3>Student List</h3>
    <br>
    <form method="post" action="">
      <label>CourseID</label>
      <input type="text" name="sr_batch">
      <input type="submit" name="sr_btn" value="Go!" >
    </form>
    <br>
    <table class="table table-stripped">
      <thead>
        <tr>
          <th scope="col">Roll No.</th>
          <th scope="col">Name</th>
          <th scope="col">Mobile No.</th>
          <th scope="col">Gender</th>
        </tr>
      </thead>

   <?php

    if(isset($_POST['sr_btn'])){
     
     $srbatch = $_POST['sr_batch'];
     $i=0;
     
     $all_query = $conn->query("select S.rollno,S.sname,S.mobileno,S.gender from project.student S,project.enrolled E where S.rollno = E.rollno and E.courseid = '$srbatch' order by rollno asc ");
     
     while ($data=$all_query->fetch(PDO::FETCH_ASSOC)) {
       $i++;
     
     ?>
  <tbody>
     <tr>
       <td><?php echo $data['rollno']; ?></td>
       <td><?php echo $data['sname']; ?></td>
       <td><?php echo $data['mobileno']; ?></td>
       <td><?php echo $data['gender']; ?></td>
     </tr>
  </tbody>

     <?php 
          } 
              }
      ?>
      
    </table>

  </div>

</div>

</center>

</body>
</html>
