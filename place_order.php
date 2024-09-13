<?php
session_start();
require 'products.php';

// Generate a random order code
$order_code = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8);
$order_file = "orders-{$order_code}.txt";

// Open the order file for writing
$order_file_handle = fopen($order_file, 'w');

// Get the cart items
$cart = $_SESSION['cart'];

// Calculate the total price
$total_price = array_sum(array_column($cart, 'price'));

// Write order details to the file
fwrite($order_file_handle, "Order Code: $order_code\n");
fwrite($order_file_handle, "Date and Time: " . date('Y-m-d H:i:s') . "\n\n");
fwrite($order_file_handle, "Order Items:\n");
foreach ($cart as $item) {
    fwrite($order_file_handle, "Product ID: " . $item['id'] . "\n");
    fwrite($order_file_handle, "Product Name: " . $item['name'] . "\n");
    fwrite($order_file_handle, "Price: " . $item['price'] . " PHP\n\n");
}
fwrite($order_file_handle, "Total Price: $total_price PHP\n");

// Close the file
fclose($order_file_handle);

// Clear the cart
$_SESSION['cart'] = [];

// Display confirmation
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Place Order</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Thank you for your order!</p>
    <p>Order Code: <?php echo htmlspecialchars($order_code); ?></p>
    <p>Total Price: <?php echo htmlspecialchars($total_price); ?> PHP</p>
</body>
</html>
