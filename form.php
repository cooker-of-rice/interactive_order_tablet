<!-- form.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <a href="index.php" class="logo">Logo</a>
        </header>
        <h1>Before we start</h1>
        <p>we need some information</p>

        <form id="buildForm">
            <label for="landSize">Size of the land:</label>
            <input type="number" id="landSize" name="landSize" required> m²

            <label for="buildingType">Type of your building:</label>
            <select id="buildingType" name="buildingType" required>
                <option value="glass">Glass</option>
                <option value="steel">Steel</option>
                <option value="concrete">Concrete</option>
                <option value="brick">Brick</option>
                <option value="wooden">Wooden</option>
            </select>

            <button type="submit" class="btn">Let's build</button>
        </form>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
