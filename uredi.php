<?php
include 'connect.php';

if (!isset($_GET['id'])) {
    echo "Greška: nedostaje ID vijesti.";
    exit;
}

$id = (int)$_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naslov = $_POST['naslov'];
    $sazetak = $_POST['sazetak'];
    $tekst = $_POST['tekst'];
    $kategorija = $_POST['kategorija'];
    $arhiva = isset($_POST['arhiva']) ? 1 : 0;

    $stmt = $conn->prepare("UPDATE vijesti SET naslov=?, sazetak=?, tekst=?, kategorija=?, arhiva=? WHERE id=?");
    if (!$stmt) {
        die("Greška u pripremi upita: " . $conn->error);
    }
    $stmt->bind_param("ssssii", $naslov, $sazetak, $tekst, $kategorija, $arhiva, $id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();

        header("Location: administrator.php");
        exit;
    } else {
        echo "Greška prilikom ažuriranja: " . $stmt->error;
    }
}

$stmt = $conn->prepare("SELECT * FROM vijesti WHERE id = ?");
if (!$stmt) {
    die("Greška u pripremi upita: " . $conn->error);
}
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$vijest = $result->fetch_assoc();
$stmt->close();

if (!$vijest) {
    echo "Vijest nije pronađena.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Uredi vijest</title>
    <link rel="stylesheet" href="style.css">
    <style>
        form {
            max-width: 600px;
            margin: 2rem auto;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        label {
            font-weight: bold;
        }
        input, textarea, select {
            padding: 0.5rem;
            width: 100%;
        }
        button {
            padding: 0.75rem;
            background-color: #0056ff;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<header class="header">
    <h1 class="logo">Uredi vijest</h1>
</header>

<main class="main">
    <form method="POST" action="uredi.php?id=<?= $id ?>">
        <label>Naslov:</label>
        <input type="text" name="naslov" value="<?= htmlspecialchars($vijest['naslov']) ?>" required>

        <label>Sazetak:</label>
        <textarea name="sazetak" rows="3" required><?= htmlspecialchars($vijest['sazetak']) ?></textarea>

        <label>Tekst:</label>
        <textarea name="tekst" rows="6" required><?= htmlspecialchars($vijest['tekst']) ?></textarea>

        <label>Kategorija:</label>
        <select name="kategorija" required>
            <option value="mundo" <?= $vijest['kategorija'] === 'mundo' ? 'selected' : '' ?>>Mundo</option>
            <option value="deporte" <?= $vijest['kategorija'] === 'deporte' ? 'selected' : '' ?>>Deporte</option>
        </select>

        <label>
            <input type="checkbox" name="arhiva" <?= $vijest['arhiva'] ? 'checked' : '' ?>>
            Arhiviraj
        </label>

        <button type="submit">Spremi promjene</button>
    </form>
</main>

<footer class="footer">
    <p>© Copyright EL DEBATE.</p>
</footer>

</body>
</html>
