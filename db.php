<?php
$host = "sql210.infinityfree.com"; 
$dbname = "if0_39121248_swapify_db";  
$username = "if0_39121248";
$password = " Lerato12233";


$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Swapify - Products</title>
  <link rel="stylesheet" href="style.css"> <!-- Your CSS file -->
</head>
<body>
  <main>
    <h2>Available Products</h2>
    <section class="product-grid">

    <?php
    // Fetch products
    $sql = "SELECT * FROM products ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '<div class="product-card">';
        echo '<img class="vase" src="' . $row["image"] . '" alt="' . $row["name"] . '" width="200">';
        echo '<div class="Description">' . $row["name"] . '</div>';
        echo '<p>R ' . number_format($row["price"], 2) . '</p>';
        echo '<button>Add to Cart</button>';
        echo '</div>';
      }
    } else {
      echo "<p>No products found.</p>";
    }

    $conn->close();
    ?>

    </section>
  </main>

  <footer>
    <p>&copy; 2025 Swapify. All rights reserved.</p>
  </footer>
</body>
</html>
