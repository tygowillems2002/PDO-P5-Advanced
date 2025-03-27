<?php
require_once '../db.php';

$db = new Database('localhost', 'pdop5', 'root', '');
$pdo = $db->getConnection();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $db->getDataById($id);

    if ($user) {
        $db->deletedata($id);
        header('Location: select.php?message=Gebruiker+succesvol+verwijderd');
        exit;
    } else {
        echo 'Gebruiker niet gevonden.';
    }
} else {
    echo 'Geen gebruiker ID opgegeven.';
}
?>