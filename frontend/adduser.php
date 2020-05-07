<html>
<head>
    <title>
        Login
    </title>
</head>
<body>
 <?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();

include("db.php");

if(isset($_POST['submit']))
{
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$email=$_POST['email'];
$user_password=$_POST['password'];
$mobile=$_POST['phone'];
$address1=$_POST['city'];
$address2=$_POST['country'];
$user_name=$_POST['user_name'];
mysqli_query($con,"insert into user_info(first_name, last_name,email,password,mobile,address1,address2,user_name) values ('$first_name','$last_name','$email','$user_password','$mobile','$address1','$address2','$user_name')")
			or die ("Query 1 is inncorrect........");
header("location: index.php");
mysqli_close($con);
}
