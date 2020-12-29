<?php
//include('connect.php');
if(isset($_POST['signup']))
{
//echo "here in isset";
  try{

//echo "hey in try";
        if(empty($_POST['uid'])){
           // echo "hey";
           throw new Exception("Userid cann't be empty.");
        }

        if(empty($_POST['uname'])){
           throw new Exception("Username cann't be empty.");
        }
        
        if(empty($_POST['pass'])){
           throw new Exception("password cann't be empty.");
        }
        if(empty($_POST['fname'])){
           throw new Exception("name cann't be empty.");
        }
        if(empty($_POST['phone'])){
            throw new Exception("phone no cann't be empty.");
         }
         
         if(empty($_POST['gender'])){
            throw new Exception("Gender cann't be empty.");
         }
         if(empty($_POST['course'])){
            throw new Exception(" Please choose course.");
         }
         include('connect.php');
        $result1 = "insert into project.user (userid,passwd,username) values('$_POST[uid]','$_POST[pass]','$_POST[uname]')";
        $stmt1 = $conn->exec($result1);
        $result2 = "update project.user set usertype ='teacher' where userid =('$_POST[uid]')";
        $stmt2 = $conn->prepare($result2);
        $stmt2->execute();
        $result3 = "insert into project.faculty (webmail , tname , mobileno , gender) values ('$_POST[uid]','$_POST[fname]','$_POST[phone]','$_POST[gender]') ";
        $stmt3 = $conn->exec($result3);
        foreach($_POST["course"] as $course)
        {
          $result4 = "insert into project.teaches values ('$_POST[uid]' , '$course')";
          $stmt4 = $conn->exec($result4);
        }
        $success_msg="Signup Successfully!";
    }
  catch(PDOException $e)
  {
    $error_msg =$e->getMessage();
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Online Attendance Management System 1.0</title>
<meta charset="UTF-8">
  
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
   
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
   
  <link rel="stylesheet" href="styles.css" >
   
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center>
<h1>Signup/Register here</h1>
<p> Faculty,use your Webmail as userid </p>
<div class="content">
<div class="row">
  <?php
    if(isset($success_msg)) echo $success_msg;
    if(isset($error_msg)) echo $error_msg;
     ?>
<form method="post" class="form-horizontal col-md-6 col-md-offset-3">

<div class="form-group">
    <label for="input1" class="col-sm-3 control-label">Userid</label>
    <div class="col-sm-7">
      <input type="text" name="uid"  class="form-control" id="input1" placeholder="choose userid" />
    </div>
</div>

<div class="form-group">
    <label for="input1" class="col-sm-3 control-label">Username</label>
    <div class="col-sm-7">
      <input type="text" name="uname"  class="form-control" id="input1" placeholder="choose username" />
    </div>
</div>

<div class="form-group">
    <label for="input1" class="col-sm-3 control-label">Password</label>
    <div class="col-sm-7">
      <input type="password" name="pass"  class="form-control" id="input1" placeholder="choose a strong password" />
    </div>
</div>

<div class="form-group">
    <label for="input1" class="col-sm-3 control-label">Full Name</label>
    <div class="col-sm-7">
      <input type="text" name="fname"  class="form-control" id="input1" placeholder="your full name" />
    </div>
</div>

<div class="form-group">
<label for="input1" class="col-sm-3 control-label">Mobile No</label>
          <div class="col-sm-7">
            <input type="text" name="phone"  class="form-control" id="input1" placeholder="your phone number" />
          </div>
      </div>

      <div class="form-group" class="radio">
      <label for="input1" class="col-sm-3 control-label">Gender</label>
      <div class="col-sm-7">
        <label>
          <input type="radio" name="gender" id="optionsRadios1" value="Male" checked> Male
        </label>
            <label>
          <input type="radio" name="gender" id="optionsRadios1" value="Female"> Female
        </label>

      </div>
<br><br>
  <label for="courses">Choose the course you are instructing:</label>

  <input type="checkbox" id="vehicle1" name="course[]" value="MA518">
<label for="vehicle1">Database Management Systems </label><br>
<input type="checkbox" id="vehicle2" name="course[]" value="MA506">
<label for="vehicle2"> Number Theory and Cryptography</label><br>
<input type="checkbox" id="vehicle3" name="course[]" value="MA514">
<label for="vehicle3"> Theory of Computation</label><br>
<input type="checkbox" id="vehicle4" name="course[]" value="MA543">
<label for="vehicle4">  Functional Analysis</label><br>
<input type="checkbox" id="vehicle5" name="course[]" value="MA572">
<label for="vehicle5"> Numerical Analysis</label><br>


 <!-- <select name="courses" id="course" multiple>-->
  <!--    <option value="MA518">Database Management Systems</option>-->
  <!--    <option value="MA506">Number Theory and Cryptography</option>-->
  <!--    <option value=" MA514"> Theory of Computation</option>-->
  <!--    <option value="MA543"> Functional Analysis</option>-->
 <!--     <option value="MA572">Numerical Analysis</option>-->
 <!--   </select>-->
 <!--   <p>Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.</p>-->


<input type="submit" class="btn btn-primary col-md-2 col-md-offset-8" value="Signup" name="signup" />
 </form>
  </div>
    <br>
    <p><strong>Already have an account? <a href="index.php">Login</a> here.</strong></p>

</div>

</center>

</body>
</html>
