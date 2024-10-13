<?php
// Load the menu from the JSON file
$menuJson = file_get_contents('menu.json');
$menuItems = json_decode($menuJson, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container">
        <!-- Menu Page -->
        <div id="menuPage" class="menu">
            <!-- Two-column Layout -->
            <div class="menu-layout">
                <!-- Left Column: Categories Section -->
                <div class="category-nav">
                    <button class="category-btn" onclick="filterMenu('morning')">Morning Menu</button>
                    <button class="category-btn" onclick="filterMenu('burgers')">Burgers</button>
                    <button class="category-btn" onclick="filterMenu('drinks')">Drinks</button>
                    <button class="category-btn" onclick="filterMenu('desserts')">Desserts</button>
                    <button class="category-btn" onclick="filterMenu('sides')">Sides</button>
                </div>

                <!-- Right Column: Menu Items Section -->
                <div class="category-items" id="menuItems">
                    <!-- Menu items will be dynamically inserted here based on category -->
                </div>
            </div>
        </div>

        <!-- Footer with Checkout Button -->
        <footer>
            <button class="checkout-btn" onclick="showCheckoutPage()" id="checkoutBtn" style="display:none;">Checkout</button>
        </footer>
    </div>

    <!-- Pass PHP data to JavaScript -->
    <script>
        // Convert PHP menu items to JavaScript
        const menuItems = <?php echo json_encode($menuItems); ?>;
    </script>

    <script src="script.js"></script>
</body>
</html>
