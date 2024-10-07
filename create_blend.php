<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Your Blend - Kyosk</title>
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Link to compiled CSS -->
</head>
<body>

    <!-- Include Header -->
    <?php include('../includes/header.php'); ?>

    <!-- Create Your Blend Section -->
    <section class="create-blend">
        <h2>Create Your Custom Spice Blend</h2>
        <form action="cart.php" method="POST">
            <div class="spice-selection">
                <label for="spice1">Select Spice #1:</label>
                <select name="spices[]" id="spice1">
                    <option value="Paprika">Paprika</option>
                    <option value="Turmeric">Turmeric</option>
                    <option value="Cumin">Cumin</option>
                    <option value="Oregano">Oregano</option>
                </select>

                <label for="quantity1">Quantity (%)</label>
                <input type="range" name="quantities[]" min="0" max="100" value="50" id="quantity1">

                <label for="spice2">Select Spice #2:</label>
                <select name="spices[]" id="spice2">
                    <option value="Paprika">Paprika</option>
                    <option value="Turmeric">Turmeric</option>
                    <option value="Cumin">Cumin</option>
                    <option value="Oregano">Oregano</option>
                </select>

                <label for="quantity2">Quantity (%)</label>
                <input type="range" name="quantities[]" min="0" max="100" value="50" id="quantity2">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-create-blend">Add Blend to Cart</button>
        </form>
    </section>

    <!-- Include Footer -->
    <?php include('../includes/footer.php'); ?>

</body>
</html>
