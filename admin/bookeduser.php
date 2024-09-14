<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movie Booking - Registered Users</title>
  <link rel="stylesheet" type="text/css" href="dark-theme.css">
  <style>
    /* Additional CSS styles for the Users Page */
    body {
      font-family: Arial, sans-serif;
      background-color: #333;
      color: #fff;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
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

    .user-list {
      margin-top: 20px;
    }

    .user-card {
      background-color: #222;
      color: #fff;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 4px;
    }

    .user-card h3 {
      margin-bottom: 10px;
      font-size: 20px;
    }

    .user-card p {
      margin-bottom: 5px;
    }

    .user-card span {
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h1>Registered Users</h1>
      <div class="profile">
        <span class="username">Admin</span>
      </div>
    </div>

    <h2>Registered Users List</h2>

    <?php
    $db = mysqli_connect("localhost", "root", "", "tcuts");

    // Check if the connection was successful
    if (!$db) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch registered users from the database
    $query = "SELECT * FROM tbl_contact";
    $result = mysqli_query($db, $query);

    // Check if there are any registered users
    if (mysqli_num_rows($result) > 0) {
      echo '<div class="user-list">';
      while ($row = mysqli_fetch_assoc($result)) {
        $username = $row['username'];
        $email = $row['email'];


        // Display the user details in a card
        echo '<div class="user-card">';
        echo '<h3>User: <span>' . $username . '</span></h3>';
        echo '<p>Email: ' . $email . '</p>';
     
        echo '</div>';
      }
      echo '</div>';
    } else {
      echo "<p>No registered users found.</p>";
    }

    // Close the database connection
    mysqli_close($db);
    ?>
  </div>
</body>

</html>
