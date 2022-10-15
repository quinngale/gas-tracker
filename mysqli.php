<?php
require 'secrets.php';

$mysqli = new mysqli($mysqli_servername, $mysqli_username, $mysqli_password, $mysqli_database);

if ($mysqli->errno) {
    die("There was a problem connecting to the database. Please try again.");
}
