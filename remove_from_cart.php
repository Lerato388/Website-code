<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["item_index"])) {
    $index = $_POST["item_index"];
    unset($_SESSION["cart"][$index]);
    // Re-index the cart array
    $_SESSION["cart"] = array_values($_SESSION["cart"]);
}

header("Location: cart-page.php");
exit();

