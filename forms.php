<?php
// Read the JSON file and get the materials
$jsonData = file_get_contents('data/data.json');
$data = json_decode($jsonData, true);
$materials = array_keys($data['materials']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Material</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-page">
        <h1>Before we start</h1>
        <p>We need some information</p>

        <form action="selection.php" method="GET">
            <label for="materialSelect">Type of your building:</label>
            <select id="materialSelect" name="material">
                <?php foreach ($materials as $material): ?>
                    <option value="<?= $material ?>"><?= ucfirst($material) ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Let's Build</button>
        </form>
    </div>
</body>
</html>
