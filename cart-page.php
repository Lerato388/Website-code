<?php
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Swapify | Cart</title>
  <link rel="stylesheet" href="style.css" />
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
    Ready to checkout? <i class="fas fa-arrow-right"></i>
  </a>
</div>
<body>
  <div class="cart-container" style="display: flex; gap: 2rem; padding: 2rem;">
    <!-- Cart Left -->
    <div class="cart-left" style="flex: 2;">
      <h2>Your Shopping Cart</h2>
      <?php if (count($cart) > 0): ?>
        <table class="cart-table">
          <thead>
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Price</th>
              <th>Qty</th>
              <th>Subtotal</th>
              <th>Remove</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($cart as $index => $item): 
              $subtotal = $item['price'] * $item['quantity'];
              $total += $subtotal;
            ?>
              <tr>
                <td><img src="images/<?= $item['image'] ?>" width="60"></td>
                <td><?= $item['name'] ?></td>
                <td>R <?= number_format($item['price'], 2) ?></td>
                <td><?= $item['quantity'] ?></td>
                <td>R <?= number_format($subtotal, 2) ?></td>
                <td>
                  <form method="POST" action="remove_from_cart.php">
                    <input type="hidden" name="item_index" value="<?= $index ?>">
                    <button type="submit">❌</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p>Your cart is empty.</p>
      <?php endif; ?>
    </div>

    <!-- Cart Right -->
    <div class="cart-right" style="flex: 1; padding-top: 2rem;">
      <h3>Order Summary</h3>
      <p>Subtotal: <strong>R <?= number_format($total, 2) ?></strong></p>
      <p>Shipping: <strong>TBD</strong></p>
      <p>Tax: <strong>R 0.00</strong></p>
      <p>Total: <strong>R <?= number_format($total, 2) ?></strong></p>
      <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
    </div>
  </div>
</body>
</html>

