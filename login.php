<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $korisnicko_ime = $_POST['korisnicko_ime'] ?? '';
    $lozinka = $_POST['lozinka'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM korisnik WHERE korisnicko_ime = ?");
    $stmt->bind_param("s", $korisnicko_ime);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user) {
        if (password_verify($lozinka, $user['lozinka'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['korisnicko_ime'];

            if ($user['je_admin'] == 1) {
                $_SESSION['je_admin'] = true;
                header("Location: administrator.php");
                exit;
            } else {
                $_SESSION['je_admin'] = false;
                echo "Nemate pravo pristupa administratorskoj stranici, " . htmlspecialchars($user['korisnicko_ime']) . ".";
                echo '<br><a href="index.php">Povratak na početnu</a>';
                exit;
            }
        } else {
            echo "Pogrešno korisničko ime ili lozinka. Molimo registrirajte se.";
            echo '<br><a href="registracija.php">Registracija</a>';
            exit;
        }
    } else {
        echo "Pogrešno korisničko ime ili lozinka. Molimo registrirajte se.";
        echo '<br><a href="registracija.php">Registracija</a>';
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Login - EL DEBATE</title>
</head>
<body>
    <h1>Prijava</h1>
    <form method="POST" action="login.php">
        <label>Korisničko ime:</label><br>
        <input type="text" name="korisnicko_ime" required><br><br>

        <label>Lozinka:</label><br>
        <input type="password" name="lozinka" required><br><br>

        <button type="submit">Prijavi se</button>
    </form>
    <p>Niste registrirani? <a href="registracija.php">Registrirajte se ovdje</a>.</p>
</body>
</html>
