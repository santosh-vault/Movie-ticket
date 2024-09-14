<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();

$db = mysqli_connect("localhost", "root", "", "tcuts");
$_SESSION['message'] = "";
$_SESSION['username'] = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password = md5($password);

    if ($username != '' && $password != '') {
        $sql = "SELECT * FROM tbl_adminregister WHERE username='$username' AND password='$password'";
        $result = mysqli_query($db, $sql);

        if (mysqli_num_rows($result)) {
            $_SESSION['message'] = "You are logged in";
            $_SESSION['username'] = $username;
            header("location: admin\admin.php");
            exit();
        } else {
            $_SESSION['message'] = "Username and password incorrect";
        }
    } else {
        $_SESSION['message'] = "Username and password required";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
<title> Register</title>
<link rel="stylesheet" type="text/css" href="theme.css">
<style>
   body {
  background-color: #1a1a1a;
  color: #fff;
  font-family: Arial, sans-serif;
}

.header {
  background-color: #333;
  color: #fff;
  padding: 20px;
  text-align: center;
}

form {
  background-color: #333;
  width: 400px;
  margin: 20px auto;
  margin-top: 200px;
  padding: 20px;
  border-radius: 5px;
}

table {
  width: 100%;
}

td {
  padding: 10px;
}

.textInput {
  width: 100%;
  padding: 10px;
  border: none;
  border-radius: 3px;
  box-sizing: border-box;
  background-color: #444;
  color: #fff;
}

input[type="submit"] {
  background-color: #1a8cff;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #007acc;
}

.message {
  color: red;
  margin-top: 5px;
  text-align: center;
}

</style>

</head>
<body>
<div class="navbar">
        <div class="logo">
          <a href="index.php">T-Cuts</a>
        </div>
        <div class="n-c">
          <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">Location</a></li>
            <li><a href="#">My Tickets</a></li>
            <li><a href="#">Loyalty</a></li>
            <li><a href="#">Support</a></li>
            <li><button type="submit"><a href="register.php">Sign Up</a></button></li>
          </ul>
          <div class="nav-icon">
            <i class="fas fa-bars"></i>
          </div>
        </div>
      </div>
      <?php if(isset($_SESSION['message']) && $_SESSION['message'] != '') { echo $_SESSION['message']; } ?>
    <form method="post" action="#">
        <table>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" class="textInput"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" class="textInput"></td>
            </tr>
          
            <tr>
                <td></td>
                <td><input type="submit" name="login_btn" value="Login"></td>
            </tr>
        </table>
    </form>
</body>
 </html>
 