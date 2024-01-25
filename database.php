<?php
$servername = "localhost";
$username = "root";
$password = "root";

$conn = new PDO("mysql:host=$servername;dbname=poke-game", $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

