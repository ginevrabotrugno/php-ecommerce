<?php
// Connessione al database
$host = 'localhost';
$dbname = 'php-ecommerce'; 
$username = 'root'; 
$password = 'root'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recupera tutti gli utenti
    $query = $pdo->query("SELECT id, password FROM users");
    $users = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) {
        $hashedPassword = password_hash($user['password'], PASSWORD_BCRYPT);

        // Aggiorna la password hashata
        $update = $pdo->prepare("UPDATE users SET password = :hashedPassword WHERE id = :id");
        $update->execute([
            ':hashedPassword' => $hashedPassword,
            ':id' => $user['id'],
        ]);

        echo "Password hashata per l'utente con ID {$user['id']}.\n";
    }

    echo "Tutte le password sono state aggiornate con successo!\n";

} catch (PDOException $e) {
    die("Errore di connessione: " . $e->getMessage());
}
?>
