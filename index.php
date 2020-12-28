<?php

ob_start();
session_start();

if($_SESSION['name']!='oasis')
{

  header('location: ../index.php');
}
?>

<?php

include('connect.php');

//data insertion
  try{

    //checking if the data comes from lecture form
    if(isset($_POST['std'])){

      //students data insertion to database table "students"
        $result = "insert into project.lecture values('$_POST[lecid]','$_POST[whichcourse]','$_POST[date]','$_POST[week]')";
        $stmt1 = $conn->exec($result);
        $success_msg = "Student added successfully.";

    }

  }
  catch(Execption $e){
    $error_msg =$e->getMessage();
  }

 ?>



<!DOCTYPE html>
<html lang="en">
<!-- head started -->
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

  .message{
    padding: 10px;
    font-size: 15px;
    font-style: bold;
    color: black;
  }
</style>
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

    </header>
    <!-- Menus ended -->

<center>
<!-- Error or Success Message printint started -->
<div class="message">
        <?php if(isset($success_msg)) echo $success_msg; if(isset($error_msg)) echo $error_msg; ?>
</div>
<!-- Error or Success Message printint ended -->

<!-- Content, Tables, Forms, Texts, Images started -->
<div class="content">

  <div class="row" id="student">

     <form method="post" class="form-horizontal col-md-6 col-md-offset-3">
      <h4>Schedule Lecture</h4>
      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Lecture Id</label>
          <div class="col-sm-7">
            <input type="text" name="lecid"  class="form-control" id="input1" placeholder="lecture id" />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">course</label>
          <div class="col-sm-7">
          <select name="whichcourse" id="input1">
      <option  value="MA518">Database Management System</option>
        <option  value="LMA518">Database Management System Lab</option>
         <option  value="MA506">Number Theory and Cryptography</option>
         <option  value="MA514">Theory of Computation</option>
        <option  value="MA543">Functional Analysis</option>
        <option  value="MA572">Numerical Analysis</option>
        <option  value="LMA572">Numerical Analysis Lab</option>

      </select>
            <!--<input type="text" name="st_name"  class="form-control" id="input1" placeholder="student full name" />-->
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Date</label>
          <div class="col-sm-7">
            <input type="date" name="date"  class="form-control" id="input1" placeholder="" />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Week</label>
          <div class="col-sm-7">
            <input type="number" name="week"  class="form-control" id="input1" placeholder="week" />
          </div>
      </div>

      <input type="submit" class="btn btn-primary col-md-2 col-md-offset-8" value="Add data" name="std" />
    </form>

  </div>
<br><br><br>
  
<!-- Contents, Tables, Forms, Images ended -->

</center>
</body>
<!-- Body ended  -->
</html>
