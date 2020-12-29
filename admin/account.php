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

//initializing the student id
$sid = $_POST['id'];

//udating students information to database table "students"
$result1 = "update project.admin set aname='$_POST[name]' where mobileno='$sid'";
$stmt = $conn->prepare($result1);
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
      <a href="account.php">Account</a>
      <a href="index.php">Add Data</a>
      <a href="../logout.php">Logout</a>

    </div>

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
              <label for="input1" class="col-sm-3 control-label">Mobile No.</label>
              <div class="col-sm-7">
                <input type="text" name="sr_id"  class="form-control" id="input1" placeholder="enter your mobile no. to continue" />
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
     $all_query = ("select * from project.admin where admin.mobileno='$sr_id'");
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
          <td>Mobileno No.:</td>
          <td><?php echo $data['mobileno']; ?></td>
        </tr>

        <tr>
            <td>Admin's Name:</td>
            <td><input type="text" name="name" value="<?php echo $data['aname']; ?>"></input></td>
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
