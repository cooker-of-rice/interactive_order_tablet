<!-- final.php -->
<?php
$selectedMaterial = isset($_GET['material']) ? $_GET['material'] : 'glass';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Tower</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="final-page">
        <h1>Your Tower</h1>
        <div class="tower">
            <div class="tower-images" id="towerImages"></div>
        </div>

        <div class="summary">
            <ul id="summaryList">
                <!-- This will be populated dynamically using JavaScript -->
            </ul>
            <p>Total: <span id="totalCost">0</span>€</p>
        </div>
    </div>

    <script>
        // Dynamically get the material from the URL
        const material = "<?= $selectedMaterial ?>";
        const floors = JSON.parse(localStorage.getItem('floors')) || [];
        const totalCost = localStorage.getItem('totalCost') || 0;

        // Render the tower images based on the material and floors
        const towerImages = document.getElementById('towerImages');
        floors.forEach(floor => {
            const floorImage = document.createElement('div');
            floorImage.classList.add('floor-image');
            floorImage.style.backgroundImage = `url(images/${material}/${floor.room}.png)`;
            towerImages.appendChild(floorImage);
        });

        // Update the total cost in the final summary
        document.getElementById('totalCost').textContent = totalCost;
    </script>
</body>
</html>
