
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $product_image = $_POST["product_image"];

    $item = [
        "id" => $product_id,
        "name" => $product_name,
        "price" => $product_price,
        "image" => $product_image,
        "quantity" => 1
    ];

    // Check if cart already exists
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }

    // Check if item already exists in cart
    $found = false;
    foreach ($_SESSION["cart"] as &$cart_item) {
        if ($cart_item["id"] == $product_id) {
            $cart_item["quantity"]++;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $_SESSION["cart"][] = $item;
    }

  header("Location: cart-page.php");
exit();
} else {
    echo "Invalid request.";
}
?>

