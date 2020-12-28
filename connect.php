<?php
$servername = "localhost";
$portno = 3306;
$username = "user2";
$pswd = "password2";
$mydb = "project";
try{
    $conn = new PDO( "mysql:host=$servername;port = $portno ,dbname = $mydb",$username , $pswd );
    $conn -> setAttribute(PDO::ATTR_ERRMODE ,PDo::ERRMODE_EXCEPTION);
    echo "connected succesfully";
}
catch(PDOEXCEPTION $e)
{
    echo "connection failed".$e->getMessage();
}
?>