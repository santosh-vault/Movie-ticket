<?php
session_start();

$db = mysqli_connect("localhost", "root", "", "tcuts");
$_SESSION['message'] = "";
$_SESSION['username'] = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password2 = mysqli_real_escape_string($db, $_POST['password2']);

    // Check if passwords match
    if ($password == $password2) {
        // Check username length
        if (strlen($username) > 40) {
            $_SESSION['message'] = "Username should be less than 40 characters.";
        } else {
            // Check password length
            if (strlen($password) < 8) {
                $_SESSION['message'] = "Password should be at least 8 characters long.";
            } else {
                // Check if the email already exists in the database
                $query = "SELECT * FROM tbl_contact WHERE email='$email'";
                $result = mysqli_query($db, $query);
                if (mysqli_num_rows($result) > 0) {
                    $_SESSION['message'] = "Email already exists. Please use a different email.";
                } else {
                    // Check if the username is valid
                    if (!isValidUsername($username)) {
                        $_SESSION['message'] = "Invalid username format.";
                    } else {
                        // Check if the username already exists in the database
                        $query = "SELECT * FROM tbl_contact WHERE username='$username'";
                        $result = mysqli_query($db, $query);

                        if (mysqli_num_rows($result) > 0) {
                            $_SESSION['message'] = "Username already exists. Please choose a different username.";
                        } else {
                            // Hash the password
                            $password = md5($password);

                            // Insert the data into the database
                            $sql = "INSERT INTO tbl_contact (username, email, password) VALUES ('$username', '$email', '$password')";
                            mysqli_query($db, $sql);

                            $_SESSION['message'] = "Registration successful!";
                            $_SESSION['username'] = $username;
                            header("location: login.php");
                            exit();
                        }
                    }
                }
            }
        }
    } else {
        $_SESSION['message'] = "Passwords do not match";
    }
}

// Function to validate the username
function isValidUsername($username) {
    // Check if the username contains only letters and numbers
    if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        return false;
    }

    // Check if the username starts with a letter or number
    if (!preg_match('/^[a-zA-Z0-9]/', $username)) {
        return false;
    }

    return true;
}

// Additional code to handle error dialog box
$error_message = "";
if (isset($_SESSION['message'])) {
    $error_message = $_SESSION['message'];
    unset($_SESSION['message']);
}


function isValidEmail($email) {
   // Add a regular expression pattern for email validation
   return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>
   <link rel="stylesheet" type="text/css" href="style.css">
   <style>
      body {
         background-color: #1a1a1a;
         color: #fff;
         font-family: Arial, sans-serif;
      }

      /* Add other necessary CSS styles here */

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

      .error-msg {
         color: red;
         margin-top: 5px;
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

<form method="post" onsubmit="return validateForm()">
    <table>
        <tr>
            <td colspan="2" class="error-msg">
                <?php echo $error_message; ?>
            </td>
        </tr>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" class="textInput"></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type="email" name="email" required class="textInput"></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password" class="textInput"></td>
        </tr>
        <tr>
            <td>Password Again:</td>
            <td><input type="password" name="password2" class="textInput"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="register_btn" value="Register"></td>
        </tr>
    </table>
    <tr>
        <td></td>
        <p> <a href="admin_login.php" style="text-decoration:none; color: #1a8cff; text-align:center;">Admin Login</a></p>
        <p>Already Have an account? <a href="login.php" style="text-decoration:none; color: #1a8cff;">Login Here</a></p>
    </tr>
</form>

<script>
    function validateForm() {
        var username = document.forms["registrationForm"]["username"].value;
        var email = document.forms["registrationForm"]["email"].value;
        var password = document.forms["registrationForm"]["password"].value;
        var password2 = document.forms["registrationForm"]["password2"].value;

        // Check if passwords match
        if (password !== password2) {
            alert("Passwords do not match.");
            return false;
        }

        // Check username length
        if (username.length > 40) {
            alert("Username should be less than 40 characters.");
            return false;
        }

        // Check password length
        if (password.length < 8) {
            alert("Password should be at least 8 characters long.");
            return false;
        }

        // Add a regular expression pattern for email validation
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            alert("Invalid email address.");
            return false;
        }

        return true;
    }

    // Function to show the error message in a dialog box
    function showErrorDialog(message) {
        alert(message);
    }

    // Check if there's any error message from PHP session
    var errorMessage = "<?php echo $error_message; ?>";
    if (errorMessage.trim() !== "") {
        // Show the error message in a dialog box
        showErrorDialog(errorMessage);

        // Clear the error message variable in JavaScript to avoid showing it again on page refresh
        errorMessage = "";
    }
</script>
</body>
</html>

