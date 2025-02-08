<?php
$orders = json_decode(file_get_contents('orders.json'), true)['orders'] ?? [];
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
</body>
</html>

<?php
function time_elapsed_string($datetime) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
    
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>