<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spice Collection - Kyosk</title>
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Link to compiled CSS -->
</head>
<body>

    <!-- Include Header -->
    <?php include('../includes/header.php'); ?>

    <!-- Spice Collection Section -->
    <section class="spice-collection">
        <h2>Our Spice Collection</h2>
        <div class="grid-container">
            <?php
            // Array of available spices
            $spices = [
                ['name' => 'Paprika', 'price' => '$5.99', 'image' => '../assets/images/paprika.jpg'],
                ['name' => 'Turmeric', 'price' => '$4.99', 'image' => '../assets/images/turmeric.jpg'],
                ['name' => 'Cumin', 'price' => '$4.99', 'image' => '../assets/images/cumin.jpg'],
                ['name' => 'Oregano', 'price' => '$3.99', 'image' => '../assets/images/oregano.jpg']
            ];

            // Loop through and display each spice
            foreach ($spices as $spice) {
                echo "<div class='product-card'>";
                echo "<img src='{$spice['image']}' alt='{$spice['name']}'>";
                echo "<h3>{$spice['name']}</h3>";
                echo "<p>{$spice['price']}</p>";
                echo "<form action='cart.php' method='POST'>";
                echo "<input type='hidden' name='product' value='{$spice['name']}'>";
                echo "<button type='submit' class='btn-add-to-cart'>Add to Cart</button>";
                echo "</form>";
                echo "</div>";
            }
            ?>
        </div>
    </section>

    <!-- Include Footer -->
    <?php include('../includes/footer.php'); ?>

</body>
</html>
