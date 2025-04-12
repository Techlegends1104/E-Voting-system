<?php 
$host ="localhost";
$user = "root";
$pass = "";
$db = "evoting";
$conn = mysqli_connect($host, $user, $pass,$db);
// check connection 
// if (mysqli_connect_errno()) {
//     die("connection error". mysqli_connect_error());
// }
// else {
//     echo"";
// }