<?php
// fetch_times.php

include_once("php/config.php");


// Check if the movie parameter is set in the POST request
if (isset($_POST['movie'])) {
    // Get the selected movie from the POST data
    $selectedMovie = $_POST['movie'];

    // Sanitize the input to prevent SQL injection
    $selectedMovie = mysqli_real_escape_string($db, $selectedMovie);

    // Query to fetch unique showing times for the selected movie
    $query = "SELECT DISTINCT showing_time FROM tbl_movies WHERE moviename = '$selectedMovie'";
    $result = mysqli_query($db, $query);

    if ($result) {
        // Fetch times and create options
        $options = "<option value=''>Select a time</option>";
        while ($row = mysqli_fetch_assoc($result)) {
            $showingTime = $row['showing_time'];
            $options .= "<option value='$showingTime'>$showingTime</option>";
        }

        // Return the options
        echo $options;
    } else {
        // Handle the query error
        echo "<option value=''>Error fetching times</option>";
    }
} else {
    // Handle the case where the movie parameter is not set
    echo "<option value=''>Invalid request</option>";
}

// Close the database connection
mysqli_close($db);
?>
