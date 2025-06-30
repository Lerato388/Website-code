<?php
// Show all errors for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
$host = "sql210.infinityfree.com"; 
$dbname = "if0_39121248_swapify_db";  
$username = "if0_39121248";
$password = "Lerato12233"; 

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Sanitize input
  $name = $conn->real_escape_string($_POST["name"]);
  $email = $conn->real_escape_string($_POST["email"]);
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

  // Insert into users table
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

  if ($conn->query($sql) === TRUE) {
    echo "<p>✅ Registration successful! <a href='login.html'>Click here to log in</a>.</p>";
  } else {
    echo "<p>❌ Error: " . $conn->error . "</p>";
  }
}

$conn->close();
?>
