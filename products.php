<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "sql210.infinityfree.com"; 
$dbname = "if0_39121248_swapify_db";  
$username = "if0_39121248";
$password = "Lerato12233"; 

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

<?php
$search = "";
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
  $search = $conn->real_escape_string($_GET['search']);
  $sql = "SELECT * FROM products WHERE name LIKE '%$search%' ORDER BY created_at DESC";
} else {
  $sql = "SELECT * FROM products ORDER BY created_at DESC";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Swapify | Products</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search"/>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
</head>
<body>
<header class="header-main">
  <div class="logo">
    <h1><a href="index.html">Swapify</a></h1>
  </div>
</header>
<nav class="main-nav">
  <ul>
    <li><a href="index.html">Home</a></li>
    <li><a href="products.html">Products</a></li>
    <li><a href="register.html">register</a></li>
    <li><a href="wishlist.html"><i class="fas fa-heart"></i></a>
    <li><a href="login.html"><i></i>Sign in</a></li>
  </ul>
</nav>
<div class="promo-banner">
<a href="products.html">
  Shop from our wide selection of stylish and affordable home decor items. <i class="fas fa-arrow-right"></i>
</a>
</div>
  <main>
     <h2 class="product-title">Available Products</h2>
    <section class="product-grid">
     <?php
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo '<div class="product-card">';
    echo '  <div class="product-image">';
    echo '    <img src="images/' . $row["image"] . '" alt="' . $row["name"] . '">';
    echo '    <span class="wishlist">&#9825;</span>';
    echo '  </div>';
    echo '  <div class="Description">' . $row["name"] . '</div>';
    echo '  <p>R ' . number_format($row["price"], 2) . '</p>';
    echo '  <form action="add_to_cart.php" method="POST">';
    echo '    <input type="hidden" name="product_id" value="' . $row["id"] . '">';
    echo '    <input type="hidden" name="product_name" value="' . $row["name"] . '">';
    echo '    <input type="hidden" name="product_price" value="' . $row["price"] . '">';
    echo '    <input type="hidden" name="product_image" value="' . $row["image"] . '">';
    echo '    <button type="submit">Add to Cart</button>';
    echo '  </form>';
    echo '</div>'; // Closing product-card
  }
} else {
  echo "<p>No products found.</p>";
}

$conn->close();
?>  
    </section>
  </main>
<section class="newsletter">
  <div class="newsletter-content">
    <div class="newsletter-text">
      <h3>Sign Up for Email</h3>
      <p>Receive early access to new arrivals, sales, exclusive content, events and much more!</p>
      <small>
        By signing up, you agree to receive Swapify promotions and commercial messages.
      </small>
    </div>
    <form class="newsletter-form">
      <label for="email">Email Address*</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>
      <button type="submit">Submit</button>
    </form>
  </div>
</section>
<footer>
  <p>&copy; 2025 Swapify. All rights reserved. 
     | <a href="faqs.html">FAQs</a> 
     | <a href="terms.html">Terms & Conditions</a> 
     | <a href="terms.html">Privacy Policy</a>
     | <a href="sell-my-products.html">SMA</a>
  </p>
</footer>
</body>
</html>
