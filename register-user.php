<?php
require_once '../db.php'; 

$database = new Database('localhost', 'pdop5', 'root', '');
$pdo = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $naam = htmlspecialchars($_POST['naam']);
        $email = htmlspecialchars($_POST['email']);
        $wachtwoord = htmlspecialchars($_POST['wachtwoord']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Ongeldig e-mailadres.");
        }

        if (strlen($wachtwoord) < 6) {
            throw new Exception("Het wachtwoord moet minimaal 6 tekens lang zijn.");
        }

        $database->registratie($naam, $email, $wachtwoord);
        header('Location: login.php');
        exit;
    } catch (Exception $e) {
        $error = "Er is iets fout gegaan: " . $e->getMessage();
    } catch (PDOException $e) {
        $error = "Er is iets fout gegaan: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
</head>
<body>
    <div>
        <h1>Registreren</h1>
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="register-user.php" method="post">
            <div>
                <label for="naam">Gebruikersnaam</label>
                <input type="text" id="naam" name="naam" required>
            </div>
            <div>
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="wachtwoord">Wachtwoord</label>
                <input type="password" id="wachtwoord" name="wachtwoord" required>
            </div>
            <button type="submit">Registreren</button>
        </form>
    </div>
</body>
</html>