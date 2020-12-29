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

<!-- head started -->
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
<!-- head ended -->

<!-- body started -->
<body>

<!-- Menus started-->
<header>

  <h1>Online Attendance Management System </h1>
  <div class="navbar">
  <a href="index.php">Home</a>
  <a href="courses.php">Courses</a>
  <a href="report.php">My Report</a>
  <a href="account.php">My Account</a>
  <a href="../logout.php">Logout</a>

</div>

</header>
<!-- Menus ended -->

<center>

<!-- Content, Tables, Forms, Texts, Images started -->
<div class="row">

  <div class="content">
    <h3>Student Report</h3>
    <br>
    <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">

  <div class="form-group">

    <label  for="input1" class="col-sm-3 control-label">Select Subject</label>
      <div class="col-sm-4">
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

  </div>

        <div class="form-group">
           <label for="input1" class="col-sm-3 control-label">Your Reg. No.</label>
              <div class="col-sm-7">
                  <input type="text" name="sr_id"  class="form-control" id="input1" placeholder="enter your reg. no." />
              </div>
        </div>
        <input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Go!" name="sr_btn" />
    </form>

    <div class="content"><br></div>

    <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
    <table class="table table-striped">

   <?php

    //checking the form for ID
    if(isset($_POST['sr_btn'])){

    //initializing ID 
     $sr_id = $_POST['sr_id'];
     $course = $_POST['whichcourse'];

     $i=0;
     $count_pre = 0;
     
     //query for searching respective ID
    //  $all_query = mysql_query("select * from reports where reports.st_id='$sr_id' and reports.course = '$course'");
    //  $count_tot = mysql_num_rows($all_query);
     $all_query = "select rollno,count(*) as countP from project.attendance where attendance.rollno='$sr_id' and attendance.courseid = '$course' and attendance.status='Present'";
     $stmt1 = $conn->prepare($all_query);
     $stmt1->execute();
     $stmt1->setFetchMode(PDO::FETCH_ASSOC);
     $singleT= "select count(*) as countT from project.attendance where attendance.rollno='$sr_id' and attendance.courseid = '$course'";
     $stmt2 = $conn->prepare($singleT);
     $stmt2->execute();
     $stmt2->setFetchMode(PDO::FETCH_ASSOC);
     $count_tot;
     $row[] = '';
     if ($row = $stmt2->fetch())
     {
      // print_r($row);
      // echo "$row[0]";
       $count_tot= $row['countT'];
       //echo "$count_tot";
     }

     while ($data = $stmt1->fetch() ) {
       $i++;
      // print_r($data);
       if($i <= 1){
     ?>
        

     <tbody>
      <tr>
          <td>Registration No.: </td>
          <td><?php echo $data['rollno']; ?></td>
      </tr>

      <tr>
        <td>Total Class (Days): </td>
        <td><?php echo $count_tot; ?> </td>
      </tr>

      <tr>
        <td>Present (Days): </td>
        <td><?php echo $data['countP']; ?> </td>
      </tr>

      <tr>
        <td>Absent (Days): </td>
        <td><?php echo $count_tot -  $data['countP']; ?> </td>
      </tr>

      <tr>
        <td>Attendance Percentage: </td>
        <td><?php echo ( $data['countP'] * 100)/$count_tot . "%"; ?> </td>
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
<!-- Contents, Tables, Forms, Images ended -->

</center>

</body>
</html>