<?php
session_start();

$db = mysqli_connect("localhost", "root", "", "tcuts");

// Check if the connection was successful
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize $_SESSION variable
if (!isset($_SESSION['error'])) {
    $_SESSION['error'] = "";
}

if (isset($_POST["register_btn"])) {
    $moviename = mysqli_real_escape_string($db, $_POST['moviename']);
    $genre = mysqli_real_escape_string($db, $_POST['genre']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $showing_time = mysqli_real_escape_string($db, $_POST['showing_time']);

    // File upload handling
    $targetDir = __DIR__ . "/images/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the "images" directory exists, if not, create it
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

   

    // Allow certain file formats
    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
        $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if image file is a valid image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        $_SESSION['error'] = "File is not an image.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $_SESSION['error'] .= " Your file was not uploaded.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            
          $sql = "INSERT INTO tbl_movies (moviename, genre, description, image_name, showing_time) VALUES ('$moviename', '$genre', '$description', '" . basename($_FILES["image"]["name"]) . "', '{$_POST["showing_time"]}')";
            mysqli_query($db, $sql);

            // Debugging: print the $_FILES array
            echo '<pre>';
            print_r($_FILES);
            echo '</pre>';

            $_SESSION['message'] = "Movie added successfully!";
            $_SESSION['moviename'] = $moviename;
            header("location: movies.php");
            exit();
        } else {
            $_SESSION['error'] = "Sorry, there was an error uploading your file.";
        }
    }
}

// Close the database connection
mysqli_close($db);
?>

<!DOCTYPE html>
<html>
<head>
   <title>Add Movie</title>
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

      .imageInput {
         width: 100%;
         padding: 10px;
         margin-top: 10px;
         border: none;
         border-radius: 3px;
         box-sizing: border-box;
         background-color: #444;
         color: #fff;
      }
   </style>
</head>
<body>
   <form method="post" enctype="multipart/form-data">
      <table>
         <tr>
            <td colspan="2" class="error-msg">
               <?php echo $_SESSION['error']; ?>
            </td>
         </tr>
         <tr>
            <td>Movie Title:</td>
            <td><input type="text" name="moviename" class="textInput"></td>
         </tr>
         <tr>
            <td>Genre:</td>
            <td><input type="text" name="genre" required class="textInput"></td>
         </tr>
         <tr>
            <td>Description:</td>
            <td><textarea name="description" placeholder="Description" class="textInput" required></textarea></td>
         </tr>
         <tr>
            <td>Movie Image:</td>
            <td><input type="file" name="image" accept="image/*" class="imageInput"></td>
         </tr>
            <td>Showing Time:</td>
            <td><input type="text" name="showing_time" class="textInput" placeholder="e.g., 7:00 PM" required></td>
         </tr>
         <tr>
            <td></td>
            <td><input type="submit" name="register_btn" value="Add Movie"></td>
         </tr>
      </table>
   </form>
</body>
</html>
