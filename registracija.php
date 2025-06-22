<?php
include 'connect.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = $_POST['lozinka'];
    $lozinka_hash = password_hash($lozinka, PASSWORD_DEFAULT);

    // Provjeri postoji li već korisnik s tim imenom
    $stmt = $conn->prepare("SELECT id FROM korisnik WHERE korisnicko_ime = ?");
    $stmt->bind_param("s", $korisnicko_ime);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $message = "Korisničko ime već postoji.";
    } else {
        $stmt->close();
        // Unesi novog korisnika, default je_admin=0
        $stmt = $conn->prepare("INSERT INTO korisnik (korisnicko_ime, lozinka) VALUES (?, ?)");
        $stmt->bind_param("ss", $korisnicko_ime, $lozinka_hash);
        if ($stmt->execute()) {
            $message = "Registracija uspješna! Možete se prijaviti.";
        } else {
            $message = "Greška prilikom registracije.";
        }
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Registracija korisnika</title>
</head>
<body>
    <h1>Registracija</h1>
    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <form method="POST" action="registracija.php">
        <label>Korisničko ime:</label><br>
        <input type="text" name="korisnicko_ime" required><br><br>
        <label>Lozinka:</label><br>
        <input type="password" name="lozinka" required><br><br>
        <button type="submit">Registriraj se</button>
    </form>
</body>
</html>
