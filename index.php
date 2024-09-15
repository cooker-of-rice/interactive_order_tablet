<?php
// Load and decode the JSON file
$jsonFile = 'inc/menu-data.json';

if (!file_exists($jsonFile)) {
    die("Error: JSON file not found.");
}

$jsonData = file_get_contents($jsonFile);

if ($jsonData === false) {
    die("Error: Could not read the JSON file.");
}

$menuData = json_decode($jsonData, true);

if ($menuData === null) {
    die("Error: JSON data could not be decoded.");
}

// Extract categories and menu items from the decoded JSON data
$categories = isset($menuData['categories']) ? $menuData['categories'] : [];
$menuItems = isset($menuData['menuItems']) ? $menuData['menuItems'] : [];

// Process search query (via GET method)
$searchQuery = isset($_GET['search']) ? htmlspecialchars(trim($_GET['search'])) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order66</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header>
        <div class="header-image">
            <img src="images/header.jpg" alt="Kiosk Header">
        </div>
        <h1>All Time Favourites</h1>
        <form method="GET" action="index.php" class="search-form">
            <input type="text" name="search" id="search-bar" placeholder="Search" value="<?php echo htmlspecialchars($searchQuery); ?>">
            <button type="submit" class="search-button">Search</button>
        </form>
    </header>

    <div class="main-content">
        <aside class="categories">
            <ul>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <li class="category-item">
                            <img src="<?php echo $category['image']; ?>" alt="<?php echo $category['name']; ?>">
                            <p><?php echo $category['name']; ?></p>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No categories available.</p>
                <?php endif; ?>
            </ul>
        </aside>

        <!-- Menu Items -->
        <section class="menu">
            <div class="menu-items">
                <?php if (!empty($menuItems)): ?>
                    <?php foreach ($menuItems as $item): ?>
                        <?php
                        // Check query
                        if ($searchQuery && strpos(strtolower($item['name']), strtolower($searchQuery)) === false) {
                            continue; // Skip items that don't match
                        }
                        ?>
                        <div class="menu-item" data-name="<?php echo $item['name']; ?>" data-price="<?php echo $item['price']; ?>">
                            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                            <h3><?php echo $item['name']; ?></h3>
                            <p>€ <?php echo $item['price']; ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No menu items available.</p>
                <?php endif; ?>
            </div>
        </section>

        <aside class="order-summary">
            <h2>Order Summary</h2>
            <ul id="order-items-list">
                <li>No items selected</li>
            </ul>
            <p class="total-amount">Total: € <span id="total-price">0.00</span></p>
            <button id="place-order" class="place-order" disabled>Place Order</button>
        </aside>
    </div>

    <footer>
        <button class="cancel-order">Cancel Order</button>
    </footer>

    <script src="scripts/app.js"></script>
</body>
</html>

