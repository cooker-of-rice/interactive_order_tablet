<?php
// JSON data for menu items
$jsonData = '[
    {"id": 1, "name": "Burger", "price": 5.99},
    {"id": 2, "name": "Pizza", "price": 8.99},
    {"id": 3, "name": "Soda", "price": 1.99}
]';

// Decode JSON data to PHP array
$menuItems = json_decode($jsonData, true);

// Handle form submission
$orderSummary = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item'];
    $quantity = $_POST['quantity'];

    // Find selected item
    $selectedItem = array_filter($menuItems, fn($i) => $i['id'] == $item);
    $selectedItem = array_shift($selectedItem);

    if ($selectedItem) {
        $totalPrice = $selectedItem['price'] * $quantity;
        $orderSummary = "<h2>Order Summary</h2>
                         <p>Item: {$selectedItem['name']}</p>
                         <p>Quantity: $quantity</p>
                         <p>Total Price: $" . number_format($totalPrice, 2) . "</p>
                         <p>Thank you for your order!</p>";
    } else {
        $orderSummary = "<p>Invalid item selected.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Kiosk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .logo {
            max-width: 100px;
        }
        main {
            padding: 20px;
        }
        .menu ul {
            list-style: none;
            padding: 0;
        }
        .menu li {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
        .order-form {
            margin-top: 20px;
        }
        label, select, input, button {
            display: block;
            margin: 10px 0;
        }
        button {
            padding: 10px 20px;
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #555;
        }
        .order-summary {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Our Kiosk</h1>
    </header>

    <main>
        <section class="menu">
            <h2>Menu</h2>
            <ul>
                <?php foreach ($menuItems as $item): ?>
                    <li><?php echo htmlspecialchars($item['name']) . " - $" . number_format($item['price'], 2); ?></li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section class="order-form">
            <h2>Place Your Order</h2>
            <form action="" method="POST">
                <label for="item">Select Item:</label>
                <select id="item" name="item" required>
                    <?php foreach ($menuItems as $item): ?>
                        <option value="<?php echo htmlspecialchars($item['id']); ?>">
                            <?php echo htmlspecialchars($item['name']) . " - $" . number_format($item['price'], 2); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" required>

                <button type="submit">Submit Order</button>
            </form>
        </section>

        <?php if ($orderSummary): ?>
            <section class="order-summary">
                <?php echo $orderSummary; ?>
            </section>
        <?php endif; ?>
    </main>
</body>
</html>
