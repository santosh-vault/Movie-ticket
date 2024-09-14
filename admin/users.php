<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movie Booking - Users Page</title>
  <link rel="stylesheet" type="text/css" href="dark-theme.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
  <style>
    body {
  font-family: Arial, sans-serif;
  background-color: #333;
  color: #fff;
  margin: 0;
  padding: 0;
}

.container {
  display: flex;
  margin: 0 auto;
  padding: 20px;
}

.top-bar {
  background-color: #444;
  color: #fff;
  padding: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  animation: slideDown 0.5s ease;
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 80px;
}

@keyframes slideDown {
  from {
    transform: translateY(-50px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

.top-bar .logo {
  font-size: 24px;
  font-weight: bold;
}
.profile {
  display: flex;
  align-items: center;
}
.sidebar {
  width: 20%;
  background-color: #444;
  padding: 20px;
  border-radius: 4px;
  height: 100vh;
  margin-top: -10px;
  margin-left: -20px;
  box-shadow:0 4px 8px rgba(0, 0, 0, 0.1) ;
}

.sidebar h2 {
  font-size: 24px;
  margin-bottom: 20px;
  color: #fff;
}

.sidebar ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.sidebar li {
  margin-bottom: 10px;
}

.sidebar a {
  color: #fff;
  text-decoration: none;
  display: flex;
  align-items: center;
  transition: text-decoration 0.3s ease;
}

.sidebar ul li a:hover {
  text-decoration: underline;
}

.sidebar i {
  margin-right: 10px;
}


.content {
  width: 80%;
  padding: 20px;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.header h1 {
  font-size: 24px;
  color: #fff;
}

.profile {
  display: flex;
  align-items: center;
  color: #fff;
}

.profile img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin-right: 10px;
}

.profile .username {
  font-weight: bold;
}

.search-bar {
  display: flex;
  align-items: center;
  background-color: #555;
  padding: 5px;
  border-radius: 4px;
  width: 60%;
  margin: 0 auto; 
}

.search-bar input {
  border: none;
  background-color: transparent;
  color: #fff;
  padding: 5px;
  font-size: 14px;
  width: 80%;
}

.search-bar input:focus {
  outline: none;
}

.search-bar i {
  color: #fff;
  font-size: 20px;
  margin-right: 8px;
}

.search-bar button {
  background-color: #777;
  color: #fff;
  padding: 5px 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.search-bar button:hover {
  background-color: #444;
}
.content {
  width: 100%;
  padding: 20px;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}
.movie-card {
  background-color: #222;
  color: #fff;
  padding: 0;
  height: 400px;
  width: calc(33.33% - 80px); /* Adjust the width and margin as needed */
  margin-bottom: 20px;
  border-radius: 4px;
  overflow: hidden;
  position: relative;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  box-sizing: border-box;
}

.movie-card img {
  width: 100%;
  height: auto;
}

.movie-card .overlay {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  width: 100%;
  padding: 20px;
  box-sizing: border-box;
  background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.3));
}

.movie-card h2 {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
}

.movie-card p {
  font-size: 16px;
  margin-bottom: 5px;
}

.book-now-btn {
  background-color: #1a8cff;
  color: #fff;
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  text-decoration: none;
  cursor: pointer;
  transition: background-color 0.3s ease;
  display: inline-block;
}

.book-now-btn:hover {
  background-color: #007acc;
}

  </style>
</head>

<body>
<?php


$db = mysqli_connect("localhost", "root", "", "tcuts");

// Check if the connection was successful
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if a user is logged in
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];

  // Fetch administrator username from the database
  $admin_query = "SELECT username FROM tbl_adminregister WHERE id = $user_id";
  $admin_result = mysqli_query($db, $admin_query);

  if ($admin_result) {
    $admin_row = mysqli_fetch_assoc($admin_result);
    $admin_username = $admin_row['username'];
  } else {
    // Handle the case where the query fails
    $admin_username = "Guest";
  }
} else {
  // Handle the case where no user is logged in
  $admin_username = "Guest";
}
?>
  <div class="top-bar">
    <div class="logo">Tcuts</div>
    <div class="profile">
      <div class="search-bar">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search...">
        <button><i class="fas fa-search"></i></button>
        </div>
      <div class="username"><?php echo "Welcome, $admin_username!"; ?></div>
    </div>
  </div>

  <div class="container">
    <div class="sidebar">
      <h2>Menu</h2>
      <ul>
        <li><a href="#" style="text-decoration: none;"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="#" style="text-decoration: none;"><i class="fas fa-film"></i> Movies</a></li>
        <li class="logout"><a href="..\index.php" style="text-decoration: none;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      </ul>
    </div>

    <div class="content">


      <?php
      // Fetch movies from the database
      $query = "SELECT * FROM tbl_movies";
      $result = mysqli_query($db, $query);

      // Check if there are any movies available
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $moviename = $row['moviename'];
          $genre = $row['genre'];
          $description = $row['description'];
          $image_name = $row['image_name'];
      ?>

          <div class="movie-card">
            <img src="images/<?php echo $image_name; ?>" alt="<?php echo $moviename; ?>">
            <div class="overlay">
              <h2><?php echo $moviename; ?></h2>
              <p class="genre"><?php echo $genre; ?></p>
              <p class="description"><?php echo $description; ?></p>
              <a href="booknow.php" class="book-now-btn">BOOK</a>
            </div>
          </div>

      <?php
        }
      }
      // Close the database connection
      mysqli_close($db);
      ?>
    </div>
  </div>
</body>

</html>
