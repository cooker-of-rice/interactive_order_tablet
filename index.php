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
    <title>Kiosk Order Interface</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header>
        <div class="header-image">
            <img src="images/header.jpg" alt="Kiosk Header">
        </div>
        <h1>All Time Favourites</h1>
        <!-- Search Form -->
        <form method="GET" action="index.php">
            <input type="text" name="search" id="search-bar" placeholder="Search" value="<?php echo htmlspecialchars($searchQuery); ?>">
            <button type="submit">Search</button>
        </form>
    </header>

    <div class="main-content">
        <!-- Sidebar with Categories -->
        <aside class="categories">
            <ul>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <li>
                            <img src="<?php echo $category['image']; ?>" alt="<?php echo $category['name']; ?>">
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No categories available.</p>
                <?php endif; ?>
            </ul>
        </aside>

        <!-- Menu Items -->
        <section class="menu">
    <form method="POST" action="checkout.php">
        <div class="menu-items">
            <?php if (!empty($menuItems)): ?>
                <?php foreach ($menuItems as $index => $item): ?>
                    <?php
                    // Check if the search query matches the item name
                    if ($searchQuery && strpos(strtolower($item['name']), strtolower($searchQuery)) === false) {
                        continue; // Skip items that don't match the search query
                    }
                    ?>
                    <!-- Each item is wrapped in a label to make it clickable -->
                    <label for="item-<?php echo $index; ?>" class="menu-item">
                        <!-- The actual checkbox is hidden -->
                        <input type="checkbox" id="item-<?php echo $index; ?>" name="items[]" value="<?php echo $item['name']; ?>" hidden>
                        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                        <h3><?php echo $item['name']; ?></h3>
                        <p>RM <?php echo $item['price']; ?></p>
                    </label>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No menu items available.</p>
            <?php endif; ?>
        </div>
        <button type="submit" class="checkout-button">Proceed to Checkout</button>
    </form>
</section>
    </div>

    <footer>
        <button class="cancel-order">Cancel Order</button>
    </footer>
</body>
</html>
