<?php
session_start();

$db = mysqli_connect("localhost", "root", "", "tcuts");

// Check if the connection was successful
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize $_SESSION variables
if (!isset($_SESSION['message'])) {
    $_SESSION['message'] = "";
}
if (!isset($_SESSION['error'])) {
    $_SESSION['error'] = "";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $movie = mysqli_real_escape_string($db, $_POST['movie']);
    $date = mysqli_real_escape_string($db, $_POST['date']);
    $seats = mysqli_real_escape_string($db, $_POST['seats']);
    
    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email address.";
        header("location: users.php");  
        exit();
    }

    // Additional seats availability validation
    if ($seats > 64) {
        $_SESSION['error'] = "Cannot book more than 64 seats.";
        header("location: users.php");  // Replace with the actual page
        exit();
    }

    if (empty($name) || empty($email) || empty($phone) || empty($movie) || empty($date) || empty($seats)) {
        $_SESSION['error'] = "All fields are required";
    } else {
        // Insert the data into the database
        $sql = "INSERT INTO tbl_booknow (name, email, phone, movie, date, seats) VALUES ('$name', '$email', '$phone', '$movie', '$date', '$seats')";
        if (mysqli_query($db, $sql)) {
            $_SESSION['message'] = "Booking successful!";
            header("location: users.php");
            exit();
        } else {
            $_SESSION['error'] = "Failed to book the movie. Please try again.";
        }
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
  <title>Movie Booking Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
  <style>
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Roboto', sans-serif;
      background: linear-gradient(to bottom, #222, #333);
      color: #fff;
    }

    .container {
      max-width: 500px;
  margin: 80px auto; /* Adjust the margin to your preference */
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
  background: linear-gradient(to bottom, #333, #444);

    }

    .container:hover {
  margin: 60px auto; /* Adjust the margin on hover */
  box-shadow: 0 0 30px rgba(0, 0, 0, 0.7);
}

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      color: #fff;
      font-weight: bold;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="number"],
    .form-group select {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 4px;
      background-color: rgba(255, 255, 255, 0.1);
      color: #fff;
    }
    /* CSS styles for the date and time inputs */
input[type="date"],
input[type="time"] {
  width: 100%;
  padding: 10px;
  border: none;
  border-radius: 4px;
  background-color: rgba(255, 255, 255, 0.1);
  color: #fff;
}

/* Remove default arrow icon on date input */
input[type="date"]::-webkit-calendar-picker-indicator {
  display: none;
}

/* Add custom icon for date input */
input[type="date"]::before {
  content: "\f073";
  font-family: "Font Awesome 5 Free";
  font-weight: 900;
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  color: #fff;
  pointer-events: none;
}

/* Add custom icon for time input */
input[type="time"]::before {
  content: "\f017";
  font-family: "Font Awesome 5 Free";
  font-weight: 900;
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  color: #fff;
  pointer-events: none;
}
/* CSS styles for the movie dropdown */
select[name="movie"] {
  width: 100%;
  padding: 10px;
  border: none;
  border-radius: 4px;
  background-color: rgba(255, 255, 255, 0.1);
  color: #fff;
}

/* Remove default arrow icon on select dropdown */
select[name="movie"]::-ms-expand {
  display: none;
}

/* Add custom icon for select dropdown */
select[name="movie"]::after {
  content: "\f078";
  font-family: "Font Awesome 5 Free";
  font-weight: 900;
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  color: #fff;
  pointer-events: none;
}

/* Style the dropdown options */
select[name="movie"] option {
  background-color: #222;
}
    .form-group textarea {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 4px;
      background-color: rgba(255, 255, 255, 0.1);
      color: #fff;
      resize: none;
    }

    .form-group button[type="submit"] {
      font-size: 16px;
      font-weight: 700;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      background: #166e00;
      transition: background-color 0.3s ease;
      color: #fff;
    }

    .form-group button[type="submit"]:hover {
      background-color: #125700;
    }
    .seat-map {
            display: grid;
            grid-template-columns: repeat(3, 80px);
            gap: 10px;
            margin-top: 20px;
        }

        .seat {
            width: 80px;
            height: 80px;
            background-color: #bdc3c7;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            user-select: none;
            font-size: 1.2em;
            color: #333;
        }

        .seat.selected {
            background-color: #3498db;
            color: #fff;
        }

        .seat:not(.available) {
            background-color: #ecf0f1;
            cursor: not-allowed;
        }
  </style>
</head>

<body>
    <div class="container">
        <header class="header">
            <h1><i class="fas fa-ticket-alt"></i> Movie Booking Form</h1>
        </header>

        <!-- Seat Selection Form -->
        <form method="POST">
            <div class="form-group">
                <label for="movie"><i class="fas fa-film"></i> Movie:</label>
                <select name="movie" id="movie" required>
                    <option value="">Select a movie</option>
                    <?php
                    // Connect to the database
                    $db = mysqli_connect("localhost", "root", "", "tcuts");

                    // Check if the connection was successful
                    if (!$db) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    // Fetch movies from the database
                    $query = "SELECT * FROM tbl_movies";
                    $result = mysqli_query($db, $query);

                    // Check if there are any movies available
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $movieName = $row['moviename'];
                            echo '<option value="' . $movieName . '">' . $movieName . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <!-- Seat Booking Section -->
            <div class="form-group">
                <label for="seats"><i class="fas fa-chair"></i> Choose Seats (Up to 6):</label>
                <div class="seat-map">
                    <?php
                    // Generate 6 seat options
                    $seatOptions = range('A', 'F');
                    foreach ($seatOptions as $seat) {
                        echo '<div class="seat available" data-seat="' . $seat . '">' . $seat . '</div>';
                    }
                    ?>
                </div>
            </div>

            <div class="form-group">
                <button type="submit"><i class="fas fa-ticket-alt"></i> Book Now</button>
            </div>
        </form>
        <!-- End Seat Selection Form -->

        <?php
        // Display messages or errors
        if (!empty($_SESSION['message'])) {
            echo '<div style="color: #4CAF50;">' . $_SESSION['message'] . '</div>';
        }
        if (!empty($_SESSION['error'])) {
            echo '<div style="color: #f44336;">' . $_SESSION['error'] . '</div>';
        }

        // Reset session variables
        $_SESSION['message'] = "";
        $_SESSION['error'] = "";
        ?>
    </div>

    <script>
        // JavaScript for seat selection
        document.addEventListener('DOMContentLoaded', function () {
            const seats = document.querySelectorAll('.seat');

            seats.forEach(seat => {
                seat.addEventListener('click', function () {
                    if (seat.classList.contains('available')) {
                        seat.classList.toggle('selected');
                    }
                });
            });
        });
    </script>
</body>


</html>



