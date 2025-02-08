<?php
$menu = json_decode(file_get_contents('items.json'), true);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kiosk Ordering</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="kiosk-ui">
        <div class="header">
            <h1>🍔 Burger Palace</h1>
            <p>Order your favorite meals</p>
        </div>
        
        <div class="category-tabs">
            <?php foreach ($menu['categories'] as $category): ?>
                <button class="category-tab" onclick="showCategory('<?= $category['name'] ?>')">
                    <?= $category['name'] ?>
                </button>
            <?php endforeach; ?>
        </div>

        <?php foreach ($menu['categories'] as $category): ?>
        <div class="items-grid" id="<?= $category['name'] ?>" style="display: none;">
            <?php foreach ($category['items'] as $item): ?>
            <div class="item-card">
                <img src="<?= $item['image'] ?>" class="item-image" alt="<?= $item['name'] ?>">
                <h3><?= $item['name'] ?></h3>
                <p class="text-muted"><?= $item['description'] ?></p>
                <p class="price">$<?= number_format($item['price'], 2) ?></p>
                <button class="btn btn-primary" onclick="addToCart(<?= $item['id'] ?>)">
                    Add to Cart
                </button>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>

        <div class="cart-footer">
            <div class="cart-header">
                <h2>Your Order 🛒</h2>
                <p>Total: $<span id="cart-total">0.00</span></p>
            </div>
            <div id="cart-items" class="cart-items"></div>
            <button class="btn btn-primary" style="width: 100%; margin-top: 1rem;" 
                    onclick="submitOrder()">
                Place Order ($<span id="order-total">0.00</span>)
            </button>
        </div>
    </div>

    <script>
        // Initialize first category
        document.querySelector('.category-tab').classList.add('active');
        document.querySelector('.items-grid').style.display = 'grid';

        function showCategory(categoryName) {
            document.querySelectorAll('.items-grid').forEach(grid => {
                grid.style.display = 'none';
            });
            document.querySelectorAll('.category-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            document.getElementById(categoryName).style.display = 'grid';
            event.target.classList.add('active');
        }

        // Rest of cart logic similar to previous version but with enhanced UI
        // Add quantity controls (+/- buttons)
        // Add cart item images
        // Add smooth animations
    </script>
</body>
</html>