<?php
require "../db.php";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $naam =  htmlspecialchars($_POST["naam"]);
        $prijs =  htmlspecialchars($_POST["prijs"]);
        $beschrijving = htmlspecialchars($_POST["beschrijving"]);

        $pdo->insertProduct($naam, $prijs, $beschrijving);
        echo "Product toegevoegd";
    } catch (PDOException $e) {
        echo "Product niet toegevoegd: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Toevoegen</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="naam" placeholder="Naam" required>
        <input type="text" name="prijs" placeholder="Prijs" required>
        <input type="text" name="beschrijving" placeholder="Beschrijving" required>
        <input type="submit" name="submit" value="Toevoegen">
    </form>
</body>
</html>