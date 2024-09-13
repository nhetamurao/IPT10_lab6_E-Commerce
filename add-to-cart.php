<?php
session_start();
require 'products.php';

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if the product_id is set in POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);

    // Find the product by ID
    $product = array_filter($products, function($p) use ($product_id) {
        return $p['id'] == $product_id;
    });

    // If the product exists, add it to the cart
    if ($product) {
        $product = array_values($product)[0];
        $_SESSION['cart'][] = $product;
    }
}

// Redirect to the cart page
header("Location: cart.php");
exit();
?>
