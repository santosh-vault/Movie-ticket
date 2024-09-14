<?php
session_start();

$db = mysqli_connect("localhost", "root", "", "tcuts");

// Check if the connection was successful
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
  $movieId = mysqli_real_escape_string($db, $_GET['id']);

  // Retrieve the movie details from the database
  $query = "SELECT * FROM tbl_movies WHERE moviename = '$moviename'";
  $result = mysqli_query($db, $query);

  // Check if the movie exists
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $moviename = $row['moviename'];
    $genre = $row['genre'];
    $description = $row['description'];
  } else {
    $_SESSION['error'] = "Movie not found.";
    header("location: movies.php");
    exit();
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $moviename = mysqli_real_escape_string($db, $_POST['moviename']);
  $genre = mysqli_real_escape_string($db, $_POST['genre']);
  $description = mysqli_real_escape_string($db, $_POST['description']);

  // Update the movie details in the database
  $query = "UPDATE tbl_movies SET genre = '$genre', description = '$description' WHERE moviename = '$moviename'";
  if (mysqli_query($db, $query)) {
    $_SESSION['message'] = "Movie updated successfully!";
    header("location: movies.php");
    exit();
  } else {
    $_SESSION['error'] = "Failed to update the movie. Please try again.";
  }
}

// Close the database connection
mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Movie</title>
  <style>
    /* CSS styles for the Edit Movie page */
    /* ... */
  </style>
</head>

<body>
  <div class="container">
    <h1>Edit Movie</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    ?>
      <form action="edit_movie.php" method="POST">
        <input type="hidden" name="moviename" value="<?php echo $moviename; ?>">
        <div class="form-group">
          <label for="genre">Genre:</label>
          <input type="text" name="genre" id="genre" value="<?php echo $genre; ?>" required>
        </div>
        <div class="form-group">
          <label for="description">Description:</label>
          <textarea name="description" id="description" required><?php echo $description; ?></textarea>
        </div>
        <div class="form-group">
          <button type="submit">Update Movie</button>
        </div>
      </form>
    <?php
    }
    ?>
  </div>
</body>

</html>
