
<?php
// Get the selected material
$selectedMaterial = isset($_GET['material']) ? $_GET['material'] : 'glass';

// Read the room data from the JSON
$jsonData = file_get_contents('data/data.json');
$data = json_decode($jsonData, true);

// Get the rooms for the selected material
$rooms = $data['materials'][$selectedMaterial];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Selection</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="selection-page">
        <div class="logo"></div>
        <div class="floor-controls">
            <button id="addFloorBtn" class="add-floor-btn">+ Floor</button>
            <div id="floorList"></div>
        </div>

        <div class="room-selection">
            <?php foreach ($rooms as $room => $price): ?>
                <button class="room-btn" data-room="<?= $room ?>" data-price="<?= $price ?>">
                    <?= ucfirst($room) ?> (<?= $price ?>€)
                </button>
            <?php endforeach; ?>
        </div>

        <div class="summary">
            <ul id="summaryList"></ul>
            <p>Total: <span id="totalCost">0</span>€</p>
            <button id="discardBtn">Discard Selection</button>
            <a href="final.php?material=<?= $selectedMaterial ?>" class="build-btn">Build My House</a>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
