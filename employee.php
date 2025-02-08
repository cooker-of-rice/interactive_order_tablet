<?php
$orders = json_decode(file_get_contents('items.json'), true)['orders'] ?? [];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="refresh" content="10">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="kiosk-ui">
        <div class="header">
            <h1>📋 Order Dashboard</h1>
            <p>Latest orders - Auto-refreshing every 10 seconds</p>
        </div>
        
        <div class="order-list">
            <?php foreach ($orders as $order): ?>
            <div class="order-card">
                <div class="order-header">
                    <h3>Order #<?= $order['id'] ?></h3>
                    <span class="order-status <?= $order['status'] === 'pending' ? 'status-pending' : 'status-completed' ?>">
                        <?= ucfirst($order['status']) ?>
                    </span>
                </div>
                <p class="order-time">
                    ⏰ <?= date('H:i', strtotime($order['timestamp'])) ?> 
                    (<?= time_elapsed_string($order['timestamp']) ?>)
                </p>
                
                <div class="order-items">
                    <?php foreach ($order['items'] as $item): ?>
                    <div class="order-item">
                        <img src="<?= $item['image'] ?>" class="cart-item-image">
                        <div>
                            <h4><?= $item['name'] ?></h4>
                            <p>x<?= $item['quantity'] ?> - $<?= number_format($item['price'] * $item['quantity'], 2) ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="order-footer">
                    <p>Total: $<?= number_format($order['total'], 2) ?></p>
                    <?php if ($order['status'] === 'pending'): ?>
                    <button class="btn btn-primary" 
                            onclick="completeOrder(<?= $order['id'] ?>)">
                        ✅ Mark Complete
                    </button>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        function completeOrder(orderId) {
            fetch('complete_order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ orderId })
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                }
            });
        }
    </script>
</body>
</html>

<?php
function time_elapsed_string($datetime) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    // Calculate weeks and remaining days separately
    $weeks = floor($diff->d / 7);
    $days = $diff->d % 7;

    $string = array(
        'y' => $diff->y > 0 ? $diff->y . ' year' . ($diff->y > 1 ? 's' : '') : null,
        'm' => $diff->m > 0 ? $diff->m . ' month' . ($diff->m > 1 ? 's' : '') : null,
        'w' => $weeks > 0 ? $weeks . ' week' . ($weeks > 1 ? 's' : '') : null,
        'd' => $days > 0 ? $days . ' day' . ($days > 1 ? 's' : '') : null,
        'h' => $diff->h > 0 ? $diff->h . ' hour' . ($diff->h > 1 ? 's' : '') : null,
        'i' => $diff->i > 0 ? $diff->i . ' minute' . ($diff->i > 1 ? 's' : '') : null,
        's' => $diff->s > 0 ? $diff->s . ' second' . ($diff->s > 1 ? 's' : '') : null,
    );

    $string = array_filter($string);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>