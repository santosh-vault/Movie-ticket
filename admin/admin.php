<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movie Booking Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
  <style>
    /* General styles */
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

    .search-bar {
      position: relative;
    }

    .search-bar input {
      padding: 10px 40px 10px 10px;
      background-color: rgba(255, 255, 255, 0.1);
      border: none;
      border-radius: 4px;
      color: #fff;
      width: 200px;
    }

    .search-bar button {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      background-color: transparent;
      border: none;
      cursor: pointer;
    }

    .user-profile img {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      margin-left: 10px;
    }

    .user-profile span {
      margin-left: 5px;
    }

    .main-content {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-gap: 20px;
    }

    .card {
      background-color: #222;
      padding: 20px;
      border-radius: 4px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .card-header {
      font-size: 16px;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .card-body h2 {
      font-size: 32px;
      font-weight: 700;
    }

  </style>
</head>

<body>
  <div class="container">
    <aside class="sidebar">
      <div class="logo">Movie Booking</div>
      <nav class="menu">
        <ul>
          <li class="active"><i class="fas fa-home"></i><a href="admin.php">Dashboard</a></li>
          <li><i class="fas fa-film"></i><a href="movies.php">Movies</a></li>
          <li><i class="fas fa-users"></i><a href="bookeduser.php">Users</a></li>
          <li class="logout"><i class="fas fa-sign-out-alt"></i><a href="..\index.php">Logout</a></li>
        </ul>
      </nav>
    </aside>

    <main class="content">
      <header class="header">
        <div class="search-bar">
          <input type="text" placeholder="Search...">
          <button><i class="fas fa-search"></i></button>
        </div>
        <div class="user-profile">
          <span>Admin User</span>
        </div>
      </header>

      <section class="main-content">
        <?php
        $db = mysqli_connect("localhost", "root", "", "tcuts");

        // Check if the connection was successful
        if (!$db) {
          die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch total movies from the database
        $query_movies = "SELECT COUNT(*) AS total_movies FROM tbl_movies";
        $result_movies = mysqli_query($db, $query_movies);
        $row_movies = mysqli_fetch_assoc($result_movies);
        $total_movies = $row_movies['total_movies'];

        // Fetch total bookings from the database
        $query_bookings = "SELECT COUNT(*) AS total_bookings FROM tbl_booknow";
        $result_bookings = mysqli_query($db, $query_bookings);
        $row_bookings = mysqli_fetch_assoc($result_bookings);
        $total_bookings = $row_bookings['total_bookings'];

        // Fetch total users from the database
        $query_users = "SELECT COUNT(*) AS total_users FROM tbl_contact";
        $result_users = mysqli_query($db, $query_users);
        $row_users = mysqli_fetch_assoc($result_users);
        $total_users = $row_users['total_users'];

        // Close the database connection
        mysqli_close($db);
        ?>

        <div class="card">
          <div class="card-header">Total Movies</div>
          <div class="card-body">
            <h2><?php echo $total_movies; ?></h2>
          </div>
        </div>

        <div class="card">
          <div class="card-header">Total Bookings</div>
          <div class="card-body">
            <h2><?php echo $total_bookings; ?></h2>
          </div>
        </div>

        <div class="card">
          <div class="card-header">Total Users</div>
          <div class="card-body">
            <h2><?php echo $total_users; ?></h2>
          </div>
        </div>
      </section>
    </main>
  </div>
</body>

</html>
