<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <div>
        <h1>Welkom, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
        <p><a href="logout.php">Uitloggen</a></p>
        <a href="../Producten/insert.php">Insert Data</a>
        <a href="select.php">View Data</a>
    </div>
</body>
</html>