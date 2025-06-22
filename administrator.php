<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['je_admin']) || $_SESSION['je_admin'] !== true) {
    echo "Nemate pravo pristupa administratorskoj stranici, " . htmlspecialchars($_SESSION['user_name'] ?? '') . ".";
    echo '<br><a href="index.php">Povratak na početnu</a>';
    exit;
}

include 'connect.php';

echo "<h1>Dobrodošli u administraciju, " . htmlspecialchars($_SESSION['user_name']) . "!</h1>";
echo '<p><a href="logout.php">Odjava</a></p>';

if (isset($_GET['delete_id'])) {
    $id = (int)$_GET['delete_id'];
    $sql = "DELETE FROM vijesti WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        header("Location: administrator.php");
        exit;
    } else {
        echo "Greška u pripremi: " . $conn->error;
    }
}

$sql = "SELECT * FROM vijesti";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Administracija</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
        }
        th, td {
            padding: 0.75rem;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #00122e;
            color: white;
        }
        a.button {
            padding: 5px 10px;
            background-color: #ff5e14;
            color: white;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        a.button:hover {
            background-color: #e65100;
        }
    </style>
</head>
<body>

<header class="header">
    <h1 class="logo">debate - Administracija</h1>
    <nav>
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="unos.html">UNOS</a></li>
        </ul>
    </nav>
</header>

<main class="main">
    <h2>Popis svih vijesti</h2>

    <?php if ($result && $result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naslov</th>
                    <th>Kategorija</th>
                    <th>Datum</th>
                    <th>Arhiva</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['naslov']) ?></td>
                        <td><?= htmlspecialchars($row['kategorija']) ?></td>
                        <td><?= htmlspecialchars($row['datum']) ?></td>
                        <td><?= $row['arhiva'] ? 'DA' : 'NE' ?></td>
                        <td>
                            <a class="button" href="uredi.php?id=<?= $row['id'] ?>">Uredi</a>
                            <a class="button" href="administrator.php?delete_id=<?= $row['id'] ?>" onclick="return confirm('Jeste li sigurni da želite obrisati ovu vijest?')">Obriši</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nema vijesti u bazi.</p>
    <?php endif; ?>

</main>

<footer class="footer">
    <p>© Copyright EL DEBATE. Todos los derechos reservados.</p>
</footer>

</body>
</html>
