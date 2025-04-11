<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Manufacturer</title>
</head>
<body>
<center>
    <h1>Update Manufacturer Data</h1>
    <form method="post">
        <p>
            <label for="id">ID:</label>
            <input type="number" name="id" id="id" required min="1" value="<?php echo isset($_POST['id']) ? $_POST['id'] : ''; ?>">
            <button type="submit" name="fetch">Fetch</button>
        </p>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fetch'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "usedcar";

        $id = $_POST['id'];

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Fetch existing data for the given ID
            $stmt = $conn->prepare("SELECT * FROM manufacturer WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $manufacturer = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($manufacturer) {
                // Display the rest of the form with pre-filled data
                echo '<form action="update.php" method="post">';
                echo '<input type="hidden" name="id" value="' . $manufacturer['id'] . '">';
                echo '<p><label for="name">Name:</label>';
                echo '<input type="text" name="name" id="name" value="' . $manufacturer['name'] . '" required maxlength="15"></p>';
                echo '<p><label for="email">Email:</label>';
                echo '<input type="email" name="email" id="email" value="' . $manufacturer['email'] . '" maxlength="50"></p>';
                echo '<p><label for="tel">Telephone:</label>';
                echo '<input type="tel" name="tel" id="tel" value="' . $manufacturer['tel'] . '" required maxlength="20"></p>';
                echo '<p><label for="adressline1">Address Line 1:</label>';
                echo '<input type="text" name="adressline1" id="adressline1" value="' . $manufacturer['adressline1'] . '" required maxlength="30"></p>';
                echo '<p><label for="adressline2">Address Line 2:</label>';
                echo '<input type="text" name="adressline2" id="adressline2" value="' . $manufacturer['addressline2'] . '" maxlength="30"></p>';
                echo '<p><label for="zipcode">Zipcode:</label>';
                echo '<input type="text" name="zipcode" id="zipcode" value="' . $manufacturer['zipcode'] . '" required maxlength="20"></p>';
                echo '<p><label for="city">City:</label>';
                echo '<input type="text" name="city" id="city" value="' . $manufacturer['city'] . '" required maxlength="30"></p>';
                echo '<p><label for="state">State:</label>';
                echo '<input type="text" name="state" id="state" value="' . $manufacturer['state'] . '" required maxlength="20"></p>';
                echo '<p><label for="country">Country:</label>';
                echo '<input type="text" name="country" id="country" value="' . $manufacturer['country'] . '" required maxlength="25"></p>';
                echo '<input type="submit" value="Update">';
                echo '</form>';
            } else {
                echo "<p>No manufacturer found with ID $id.</p>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $conn = null;
    }
    ?>
</center>
</body>
</html>
