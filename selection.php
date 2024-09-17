<?php
// Load the JSON data
$jsonData = file_get_contents('data/data.json');
$data = json_decode($jsonData, true);

// Set default selected material
$selectedMaterial = 'glass'; // Default material

// Handle form submission to get the selected material
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['material'])) {
        $selectedMaterial = $_POST['material'];
    }
}

// Get room data for the selected material
$rooms = $data['materials'][$selectedMaterial]['rooms'];

// Initialize total cost and selected floors array
$totalCost = 0;
$selectedRooms = [];

// Handle room selections and cost calculation
if (isset($_POST['rooms'])) {
    $selectedRooms = $_POST['rooms'];
    foreach ($selectedRooms as $floor => $room) {
        $totalCost += $rooms[$room]['cost'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Build Your House</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Material Selection Form -->
<form method="post" action="">
    <label for="materialSelect">Select Material:</label>
    <select id="materialSelect" name="material" onchange="this.form.submit()">
        <option value="glass" <?php echo $selectedMaterial == 'glass' ? 'selected' : ''; ?>>Glass</option>
        <option value="steel" <?php echo $selectedMaterial == 'steel' ? 'selected' : ''; ?>>Steel</option>
        <option value="concrete" <?php echo $selectedMaterial == 'concrete' ? 'selected' : ''; ?>>Concrete</option>
        <option value="brick" <?php echo $selectedMaterial == 'brick' ? 'selected' : ''; ?>>Brick</option>
        <option value="wooden" <?php echo $selectedMaterial == 'wooden' ? 'selected' : ''; ?>>Wooden</option>
    </select>
</form>

<!-- Room Selection and Floors -->
<form method="post" action="">
    <input type="hidden" name="material" value="<?php echo $selectedMaterial; ?>">
    
    <div id="floors">
        <h2>Select Rooms for Each Floor</h2>

        <?php
        // Dynamically generate room options for each floor
        for ($floor = 1; $floor <= 5; $floor++) {
            echo "<div class='floor'>";
            echo "<h3>Floor $floor</h3>";

            echo "<select name='rooms[$floor]'>";
            foreach ($rooms as $roomName => $roomData) {
                $selected = (isset($selectedRooms[$floor]) && $selectedRooms[$floor] == $roomName) ? 'selected' : '';
                echo "<option value='$roomName' $selected>{$roomName} ({$roomData['cost']}€)</option>";
            }
            echo "</select>";
            echo "</div>";
        }
        ?>
    </div>

    <button type="submit">Calculate Total</button>
</form>

<!-- Summary of Costs -->
<div id="summary">
    <h2>Summary</h2>
    <ul>
        <?php
        // Display selected rooms and costs
        foreach ($selectedRooms as $floor => $room) {
            echo "<li>Floor $floor: $room - {$rooms[$room]['cost']}€</li>";
        }
        ?>
    </ul>

    <h3>Total Cost: <?php echo $totalCost; ?>€</h3>
</div>

</body>
</html>
