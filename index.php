<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kyosk - Spice Ordering and Mixing</title>
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Link to compiled CSS -->
</head>
<body>

    <!-- Include Header -->
    <?php include('includes/header.php'); ?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to Kyosk</h1>
            <p>Discover the finest spices and create your own custom blends.</p>
            <div class="cta-buttons">
                <a href="pages/spices.php" class="btn-primary">Shop Spices</a>
                <a href="pages/create_blend.php" class="btn-secondary">Create Your Blend</a>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="featured-products">
        <h2>Featured Spices</h2>
        <div class="products-grid">
            <?php
            // Array of featured products
            $featured_products = [
                ['name' => 'Chili Powder', 'price' => '$6.99', 'image' => 'assets/images/chili.jpg'],
                ['name' => 'Garlic Powder', 'price' => '$5.50', 'image' => 'assets/images/garlic.jpg'],
                ['name' => 'Cumin', 'price' => '$4.99', 'image' => 'assets/images/cumin.jpg']
            ];

            // Loop through products and display them
            foreach ($featured_products as $product) {
                echo "<div class='product-card'>";
                echo "<img src='{$product['image']}' alt='{$product['name']}'>";
                echo "<h3>{$product['name']}</h3>";
                echo "<p>{$product['price']}</p>";
                echo "<form action='pages/cart.php' method='POST'>";
                echo "<input type='hidden' name='product' value='{$product['name']}'>";
                echo "<button type='submit' class='btn-add-to-cart'>Add to Cart</button>";
                echo "</form>";
                echo "</div>";
            }
            ?>
        </div>
    </section>

    <!-- Footer -->
    <?php include('includes/footer.php'); ?>

</body>
</html>
