<?php
session_start();
require 'products.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
</head>
<body>
    <h1>Your Cart</h1>
    <ul>
        <?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $total = 0;
            foreach ($_SESSION['cart'] as $item) {
                echo '<li>' . htmlspecialchars($item['name']) . ' - ' . htmlspecialchars($item['price']) . ' PHP</li>';
                $total += $item['price'];
            }
            echo '<li><strong>Total: ' . htmlspecialchars($total) . ' PHP</strong></li>';
        } else {
            echo '<li>Your cart is empty.</li>';
        }
        ?>
    </ul>

    <a href="reset-cart.php">Clear my cart</a>
    <a href="place_order.php">Place the order</a>
</body>
</html>
