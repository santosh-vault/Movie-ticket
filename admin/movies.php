<?php
session_start();

$db = mysqli_connect("localhost", "root", "", "tcuts");

// Check if the connection was successful
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all movies with image names
$query = "SELECT moviename, genre, description, image_name, showing_time FROM tbl_movies";
$result = mysqli_query($db, $query);

// Initialize $_SESSION variable
if (!isset($_SESSION['error'])) {
    $_SESSION['error'] = "";
}

// Handle movie deletion
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $deleteMovieName = mysqli_real_escape_string($db, $_GET['delete']);

    // Delete from tbl_booknow
    $deleteBookingQuery = "DELETE FROM tbl_booknow WHERE movie = '$deleteMovieName'";
    $deleteBookingResult = mysqli_query($db, $deleteBookingQuery);

    // Delete from tbl_movies
    $deleteMovieQuery = "DELETE FROM tbl_movies WHERE moviename = '$deleteMovieName'";
    $deleteMovieResult = mysqli_query($db, $deleteMovieQuery);

    if ($deleteBookingResult && $deleteMovieResult) {
        $_SESSION['message'] = "Movie and booking records deleted successfully!";
    } else {
        $_SESSION['error'] = "Failed to delete movie and booking records. Please try again.";
    }

    // Redirect to the same page to prevent accidental resubmission
    header("Location: movies.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movie Booking Admin Dashboard - Movies</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
  <style>

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Roboto', sans-serif;
      background-color: #333;
      color: #fff;
    }

    .container {
      display: flex;
      height: 100vh;
    }

    .sidebar {
      width: 240px;
      background-color: #222;
      padding: 20px;
      display: flex;
      flex-direction: column;
    }

    .logo {
      font-size: 24px;
      font-weight: 700;
      margin-bottom: 20px;
    }

    .menu ul {
      list-style-type: none;
    }

    .menu li {
      padding: 10px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .menu li:hover,
    .menu li.active {
      background-color: rgba(255, 255, 255, 0.1);
    }

    .menu li i {
      margin-right: 10px;
    }

    .menu li a {
      text-decoration: none;
      color: white;
    }

    .content {
      flex: 1;
      padding: 20px;
    }

    .header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .add-movie-button {
      font-size: 16px;
      font-weight: 700;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      background: #1a8cff;
      transition: background-color 0.3s ease;
      color: #fff;
    }

    .movies-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      grid-gap: 20px;
    }

    .movie-card {
            background-color: #222;
            padding: 10px;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            cursor: pointer;
            height: 400px;
            width: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .movie-poster {
            width: 100%;
            height: auto;
            border-radius: 4px;
        }

        .movie-details {
            position: absolute;
            top: 0;
            left: 0;
            color: #fff;
            z-index: 1;
            text-align: center;
            align-items: center;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0));
        }

        .movie-details h2 {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .movie-details p {
            font-size: 16px;
            margin-bottom: 0;
        }

        .movie-details p.genre {
            margin-top: 7px;
        }

        .movie-details p.description {
            max-height: 60px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .movie-details p.showing-time {
              font-size: 14px;
              margin-top: 5px;
          }
        .movie-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 60px;
        }

        .movie-actions a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .movie-actions a:hover {
            color: #1a8cff;
        }

  </style>
</head>

<body>
  <div class="container">
    <aside class="sidebar">
      <div class="logo">Movie Booking</div>
      <nav class="menu">
        <ul>
          <li><i class="fas fa-home"></i><a href="admin.php">Dashboard</a></li>
          <li class="active"><i class="fas fa-film"></i><a href="movies.php">Movies</a></li>
          <li><i class="fas fa-users"></i><a href="bookeduser.php">Users</a></li>
          <li class="logout"><i class="fas fa-sign-out-alt"></i><a href="..\index.php">Logout</a></li>
        </ul>
      </nav>
    </aside>

    <main class="content">
            <header class="header">
                <h1 class="dashboard-title">Manage Movies</h1>
                <button class="add-movie-button"><a href="add_movie.php" style="color: white; text-decoration: none;">Add Movie</a></button>
            </header>

            <div class="movies-list">
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <div class="movie-card">
                        <img src="images/<?php echo $row['image_name']; ?>" alt="<?php echo $row['moviename']; ?>" class="movie-poster">
                        <div class="movie-details">
                            <h2><?php echo $row['moviename']; ?></h2>
                            <p class="genre"><?php echo $row['genre']; ?></p>
                            <p class="description"><?php echo $row['description']; ?></p>
                            <p class="showing-time">Showing Time: <?php echo $row['showing_time']; ?></p>
                            <div class="movie-actions">
                                <a href="movies.php?delete=<?php echo $row['moviename']; ?>" onclick="return confirm('Are you sure you want to delete this movie?');" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </main>
  </div>
</body>

</html>
