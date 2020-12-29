<?php

ob_start();
session_start();

//checking if the session is valid
if($_SESSION['name']!='oasis')
{
  header('location: ../login.php');
}
?>

<?php include('connect.php');?>


<?php 
try{

       //checking form data and empty fields
        if(isset($_POST['done'])){

        if (empty($_POST['name'])) {
          throw new Exception("Name cannot be empty");
          
        }
            if (empty($_POST['dob'])) {
             
              throw new Exception("DOB cannot be empty");
              
            }
            if(empty($_POST['phone']))
            {
              throw new Exception("Mobileno cannot be empty");
                  
             }
                if(empty($_POST['gender']))
                {
                  throw new Exception("Gender cannot be empty");
                      
                }

//initializing the student id
$sid = $_POST['id'];

//udating students information to database table "students"
$result1 = "update project.student set sname='$_POST[name]' where rollno='$sid'";
$result2 = "update project.student set dob='$_POST[dob]' where rollno='$sid'";
$result3 = "update project.student set mobileno='$_POST[phone]' where rollno='$sid'";
$result4 = "update project.student set gender='$_POST[gender]' where rollno='$sid'";
$stmt = $conn->prepare($result1);
$stmt->execute();
$stmt = $conn->prepare($result2);
$stmt->execute();
$stmt = $conn->prepare($result3);
$stmt->execute();
$stmt = $conn->prepare($result4);
$stmt->execute();
$success_msg = 'Updated  successfully';
}

}
catch(Exception $e){

$error_msg =$e->getMessage();
}

?>



<!DOCTYPE html>
<html lang="en">

<!-- head started -->
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

<!-- Content, Tables, Forms, Texts, Images started -->
<center>

<div class="row">
  <div class="content">

        <h3>Update Account</h3>
        <br>
        
        <!-- Error or Success Message printint started --><p>
    <?php

        if(isset($success_msg))
        {
          echo $success_msg;
        }
        if(isset($error_msg))
        {
          echo $error_msg;
        }

      ?>
        </p><!-- Error or Success Message printint ended -->

        <br>
 
        <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
          <div class="form-group">
              <label for="input1" class="col-sm-3 control-label">Registration No.</label>
              <div class="col-sm-7">
                <input type="text" name="sr_id"  class="form-control" id="input1" placeholder="enter your reg. no. to continue" />
              </div>
          </div>
          <input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Go!" name="sr_btn" />
        </form>
        <div class="content"></div>


    <?php

    if(isset($_POST['sr_btn'])){

    //initializing student ID from form data
     $sr_id = $_POST['sr_id'];
    //echo "$sr_id";
     $i=0;

     //searching students information respected to the particular ID
     $all_query = ("select * from project.student where student.rollno='$sr_id'");
     $stmt = $conn->query($all_query);
     $stmt->execute();
     $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while($data = $stmt->fetch()){
      // echo "hello g";
       $i++;
     
     ?>
<form action="" method="post" class="form-horizontal col-md-6 col-md-offset-3">
 <table class="table table-striped">

        <tr>
          <td>Registration No.:</td>
          <td><?php echo $data['rollno']; ?></td>
        </tr>

        <tr>
            <td>Student's Name:</td>
            <td><input type="text" name="name" value="<?php echo $data['sname']; ?>"></input></td>
        </tr>

        <tr>
            <td>DOB:</td>
            <td><input type="text" name="dob" value="<?php echo $data['dob']; ?>"></input></td>
        </tr>

        <tr>
            <td>Mobile No:</td>
            <td><input type="text" name="phone" value="<?php echo $data['mobileno']; ?>"></input></td>
        </tr>
        
        <tr>
            <td>Gender:</td>
            <td><input type="text" name="gender" value="<?php echo $data['gender']; ?>"></input></td>
        </tr>
        <input type="hidden" name="id" value="<?php echo $sr_id; ?>">
        
        <tr><td></td></tr>
        <tr>
              <td></td>
              <td><input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Update" name="done" /></td>
              
        </tr>

  </table>
</form>
   <?php 
} 
   }  
   ?>


    </div>

</div>

</center>
<!-- Contents, Tables, Forms, Images ended -->

</body>
<!-- Menus ended -->

</html>
