<?php
class Database {
    private $pdo;

    public function __construct($host, $dbname, $username, $password) {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
        $this->pdo = new PDO($dsn, $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection() {
        return $this->pdo;
    }

    public function registratie($naam, $email, $wachtwoord) {
        $hashedPassword = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (naam, email, wachtwoord) VALUES (?, ?, ?)");
        $stmt->execute([$naam, $email, $hashedPassword]);
    }

    public function login($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function selectData() {
        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDataById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateDate($id, $naam, $email) {
        $stmt = $this->pdo->prepare("UPDATE users SET naam = ?, email = ? WHERE id = ?");
        $stmt ->execute([$naam, $email, $id]); 
    }

    public function deletedata($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>
