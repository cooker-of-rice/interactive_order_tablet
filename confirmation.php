<?php
// Clear the session cart after checkout
session_start();
$_SESSION['cart'] = [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Kyosk</title>
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Link to compiled CSS -->
</head>
<body>

    <!-- Include Header -->
    <?php include('../includes/header.php'); ?>

    <!-- Confirmation Section -->
    <section class="confirmation">
        <h2>Thank You for Your Order!</h2>
        <p>Your order has been placed successfully. You will receive an email confirmation shortly.</p>
        <a href="../index.php" class="btn-primary">Back to Home</a>
    </section>

    <!-- Include Footer -->
    <?php include('../includes/footer.php'); ?>

</body>
</html>
