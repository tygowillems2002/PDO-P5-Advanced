<?php
session_start();
require_once '../db.php';

$database = new Database('localhost', 'pdop5', 'root', '');
$pdo = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $email = htmlspecialchars($_POST['email']);
        $wachtwoord = htmlspecialchars($_POST['wachtwoord']);

        $user = $database->login($email);

        if ($user && password_verify($wachtwoord, $user['wachtwoord'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['naam'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = "Ongeldige inloggegevens.";
        }
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
    <title>Inloggen</title>
</head>
<body>
    <h1>Inloggen</h1>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="login.php" method="post">
        <p>
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>
        </p>
        <p>
            <label for="wachtwoord">Wachtwoord</label>
            <input type="password" id="wachtwoord" name="wachtwoord" required>
        </p>
        <p>
            <button type="submit">Inloggen</button>
        </p>
    </form>
</body>
</html>