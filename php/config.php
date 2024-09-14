<?php
$db = mysqli_connect("localhost", "root", "", "tcuts");

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
?>