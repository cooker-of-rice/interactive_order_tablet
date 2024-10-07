<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Kyosk</title>
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Link to compiled CSS -->
</head>
<body>

    <!-- Include Header -->
    <?php include('../includes/header.php'); ?>

    <!-- Checkout Form Section -->
    <section class="checkout">
        <h2>Checkout</h2>
        <form action="confirmation.php" method="POST">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="address">Shipping Address:</label>
                <input type="text" id="address" name="address" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <button type="submit" class="btn-primary">Place Order</button>
        </form>
    </section>

    <!-- Include Footer -->
    <?php include('../includes/footer.php'); ?>

</body>
</html>
