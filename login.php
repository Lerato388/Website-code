<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

$host = "sql210.infinityfree.com"; 
$dbname = "if0_39121248_swapify_db";  
$username = "if0_39121248";
$password = "Lerato12233"; 

$conn = new mysqli($host, $username, $password, $dbname);

// Check 
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $conn->real_escape_string($_POST["email"]);
  $password = $_POST["password"];

  // Find user by email
  $sql = "SELECT * FROM users WHERE email = '$email'";
  $result = $conn->query($sql);

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verifying password
    if (password_verify($password, $user["password"])) {
      // Saveing user info in session
      $_SESSION["user_id"] = $user["id"];
      $_SESSION["username"] = $user["username"];

      echo "<p>✅ Login successful! Welcome, " . htmlspecialchars($user["username"]) . ".</p>";
      echo "<p><a href='products.html'>Go to Products</a></p>";
    } else {
      echo "<p>❌ Incorrect password.</p>";
    }
  } else {
    echo "<p>❌ No user found with that email address.</p>";
  }
}

$conn->close();
?>

