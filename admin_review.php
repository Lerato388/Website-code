<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'db.php'; // database connection
require 'notify_seller.php'; 

if (isset($_GET['id']) && isset($_GET['action'])) {
    $product_id = intval($_GET['id']);
    $action = $_GET['action']; // 'Approved' or 'Declined'

    // Get seller email and product name
    $result = $conn->query("SELECT email, name FROM products WHERE id = $product_id");
    if ($result && $row = $result->fetch_assoc()) {
        $email = $row['email'];
        $product_name = $row['name'];

         $conn->query("UPDATE products SET status = '$action' WHERE id = $product_id");

    
        if (sendStatusEmail($email, $product_name, $action)) {
            echo "Email sent to seller.";
        } else {
            echo "Failed to send email.";
        }
    } else {
        echo "Product not found.";
    }
}
?>

