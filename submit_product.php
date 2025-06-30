<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

// DB config
$host = "sql210.infinityfree.com"; 
$dbname = "if0_39121248_swapify_db";  
$username = "if0_39121248";
$password = "Lerato12233"; 

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$category = $_POST['category'];
$condition = $_POST['condition'];
$contact_email = $_POST['contact_email'] ?? '';

// Handle image upload
$image = $_FILES['image']['name'];
$target_dir = "uploaded_products/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0755, true);
}
$target_file = $target_dir . basename($image);
move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

// Insert into DB
$stmt = $conn->prepare("INSERT INTO seller_products (name, description, price, image, category, condition, contact_email, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')");
$stmt->bind_param("ssdssss", $name, $description, $price, $image, $category, $condition, $contact_email);
if ($stmt->execute()) {
  echo "<p>Thank you! Your product has been submitted and is awaiting review.</p>";
  echo '<a href="index.html">Return Home</a>';
} else {
  echo "<p>Something went wrong. Please try again.</p>";
}
$stmt->close();
$conn->close();
?>

