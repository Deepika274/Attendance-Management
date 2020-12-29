<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
</head>
<body>
    <?php
        include('connect.php');
    ?>
    <section id="home">
        <h1 >WELCOME TO ATTENDANCE PORTAL </h1>
    </section>
    <div class="pics">
        <div class="box">
            <img src="img/pic.jpg" alt="error">
            <form action="index.php" method="get">
         <button class="btn" type="submit">Faculty Login</button>
      </form>
        </div>
        <div class="box">
            <img src="img/student.jpg" alt="error">
            <form action="index.php" method="get">
         <button class="btn" type="submit">Student Login</button>
      </form>
        </div>
        <div class="box">
            <img src="img/admin.jpg" alt="">
            <form action="index.php" method="get">
         <button class="btn" type="submit">Admin Login</button>
      </form>
        </div>
    </div>
</body>
</html>