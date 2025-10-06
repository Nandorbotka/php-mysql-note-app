<?php
date_default_timezone_set("Europe/Budapest");

$host = "db";
$dbname = "notes_app";
$user = "root";
$pass = "root";
$charset = "utf8mb4";

try {
    $pdo = new PDO("mysql:host=$host;charset=$charset", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("
        CREATE DATABASE IF NOT EXISTS `$dbname`
        CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
    ");

    $pdo->exec("USE `$dbname`");

    $tableExists = $pdo->query("SHOW TABLES LIKE 'notes'")->rowCount() > 0;

    if (!$tableExists) {
        $pdo->exec("
            CREATE TABLE notes (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                content TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ");

        $stmt = $pdo->prepare("
            INSERT INTO notes (title, content)
            VALUES ('Üdvözöllek a Jegyzet Appban! 🎉', 'Ez egy minta jegyzet. Hozz létre újakat, szerkeszd vagy töröld őket szabadon!')
        ");
        $stmt->execute();
    }
} catch (PDOException $e) {
    // 6️⃣ Hibakezelés
    die('<p style="color:red; text-align:center; font-family:sans-serif;">
        ❌ Adatbázis hiba: ' . htmlspecialchars($e->getMessage()) . '
    </p>');
}
