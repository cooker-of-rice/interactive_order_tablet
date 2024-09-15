<?php
// Load and decode the JSON file
$jsonFile = 'inc/menu-data.json';

if (!file_exists($jsonFile)) {
    die("Error: JSON file not found. Please ensure the file is in the 'inc' directory.");
}

$jsonData = file_get_contents($jsonFile);

if ($jsonData === false) {
    die("Error: Could not read the JSON file.");
}

$menuData = json_decode($jsonData, true);

if ($menuData === null) {
    die("Error: JSON data could not be decoded. Please check the JSON file format.");
}

// json data
$categories = isset($menuData['categories']) ? $menuData['categories'] : [];
$menuItems = isset($menuData['menuItems']) ? $menuData['menuItems'] : [];

// search query
$searchQuery = isset($_GET['search']) ? htmlspecialchars(trim($_GET['search'])) : '';

// Process selection
$selectedItem = isset($_POST['item_name']) ? $_POST['item_name'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>order66</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header>
        <div class="header-image">
            <img src="images/header.jpg" alt="Kiosk Header">
        </div>
        <h1>All Time Favourites</h1>
        <form method="GET" action="index.php">
            <input type="text" name="search" id="search-bar" placeholder="Search" value="<?php echo htmlspecialchars($searchQuery); ?>">
            <button type="submit">Search</button>
        </form>
    </header>

    <div class="main-content">
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
            <div class="menu-items">
                <?php if (!empty($menuItems)): ?>
                    <?php foreach ($menuItems as $item): ?>
                        <?php
                        // Check if the search query matches the item name
                        if ($searchQuery && strpos(strtolower($item['name']), strtolower($searchQuery)) === false) {
                            continue; // Skip items that don't match the search query
                        }
                        ?>
                        <form method="POST" action="index.php">
                            <div class="menu-item">
                                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                                <h3><?php echo $item['name']; ?></h3>
                                <p>RM <?php echo $item['price']; ?></p>
                                <input type="hidden" name="item_name" value="<?php echo $item['name']; ?>">
                                <button type="submit">Select</button>
                            </div>
                        </form>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No menu items available.</p>
                <?php endif; ?>
            </div>
        </section>
    </div>

    <footer>
        <button class="cancel-order">Cancel Order</button>
    </footer>

    <?php if ($selectedItem): ?>
        <script>alert('You selected: <?php echo $selectedItem; ?>');</script>
    <?php endif; ?>
</body>
</html>
