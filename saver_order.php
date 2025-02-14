<?php
$input = json_decode(file_get_contents('php://input'), true);

if ($input) {
    $ordersFile = 'orders.json';
    $orders = file_exists($ordersFile) ? json_decode(file_get_contents($ordersFile), true) : ['orders' => []];
    $orders['orders'][] = $input;
    file_put_contents($ordersFile, json_encode($orders));
    echo json_encode(['success' => true]);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid order data']);
}