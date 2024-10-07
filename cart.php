<?php
session_start();

// Handle product submission from other pages
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = $_POST['product'] ?? 'Custom Blend';
    
    // Add the selected product to the session cart
    $_SESSION['cart'][] = $product;
}

// Retrieve cart items from the session
$cart_items = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - Kyosk</title>
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Link to compiled CSS -->
</head>
<body>

    <!-- Include Header -->
    <?php include('../includes/header.php'); ?>

    <!-- Cart Section -->
    <section class="cart">
        <h2>Your Cart</h2>
        <?php if (empty($cart_items)): ?>
            <p>Your cart is empty. Go back to <a href="spices.php">Spice Collection</a> to add items.</p>
        <?php else: ?>
            <ul class="cart-items">
                <?php foreach ($cart_items as $item): ?>
                    <li><?= htmlspecialchars($item) ?></li>
                <?php endforeach; ?>
            </ul>
            <a href="checkout.php" class="btn-primary">Proceed to Checkout</a>
        <?php endif; ?>
    </section>

    <!-- Include Footer -->
    <?php include('../includes/footer.php'); ?>

</body>
</html>
