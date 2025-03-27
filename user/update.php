<?php
require_once '../db.php';

$db = new Database('localhost', 'pdop5', 'root', '');
$pdo = $db->getConnection();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $db->getDataById($id);

    if (!$user) {
        die('Gebruiker niet gevonden.');
    }
} else {
    die('Geen gebruiker ID opgegeven.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];
    $email = $_POST['email'];

    $db->updateDate($id, $naam, $email);

    header('Location: select.php?message=Gebruiker+succesvol+bijgewerkt');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Gebruiker</title>
</head>
<body>
    <div>
        <h1>Update Gebruiker</h1>
        <form method="post">
            <div>
                <label for="naam">Naam</label>
                <input type="text" id="naam" name="naam" value="<?php echo htmlspecialchars($user['naam']); ?>" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>