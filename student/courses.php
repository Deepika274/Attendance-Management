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


</head>
<body>

<header>

  <h1>Online Attendance Management System </h1>
  <div class="navbar">
  <a href="index.php">Home</a>
  <a href="coursess.php">Courses</a>
  <a href="report.php">My Report</a>
  <a href="account.php">My Account</a>
  <a href="../logout.php">Logout</a>

</div>

</header>

<center>

<div class="row">

  <div class="content">
    <h3>List</h3>
    <br>

   <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Registration No</label>
            <div class="col-sm-7">
                <input type="text" name="roll"  class="form-control" id="input1" placeholder="enter your rollno" />
                
            </div>

      </div>
      <input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Go!" name="sr_btn" />
      
   </form>

   <div class="content"></div>
    <table class="table table-striped">
      
      <thead>
      <tr>
        <th scope="col">Course</th>
        <th scope="col">Course Title</th>
        <th scope="col">Instructor</th>
        <th scope="col">Credit</th>
       <!-- <th scope="col">Semester</th>-->
      <!--  <th scope="col">Email</th>-->
      </tr>
      </thead>
   <?php

    if(isset($_POST['sr_btn'])){
     
     $roll = $_POST['roll'];
     $i=0;
     $all_query = "SELECT c.courseid , c.cname , c.instructor , c.coursecredit from project.course c , project.enrolled e where e.rollno = '$roll' and c.courseid = e.courseid ";
    // $all_query = "select * from project.course where students.st_batch = '$srbatch' order by st_id asc";
    $stmt = $conn->query($all_query);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
   while($data = $stmt->fetch()){
       $i++;
     
     ?>

     <tr>
       <td><?php echo $data['courseid']; ?></td>
       <td><?php echo $data['cname']; ?></td>
       <td><?php echo $data['instructor']; ?></td>
       <td><?php echo $data['coursecredit']; ?></td>
     </tr>

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
