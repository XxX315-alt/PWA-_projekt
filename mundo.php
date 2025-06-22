<?php
include 'connect.php';

$sql = "SELECT * FROM vijesti WHERE kategorija = 'mundo' ORDER BY datum DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Greška u upitu: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Mundo - EL DEBATE</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header">
    <h1 class="logo">EL DEBATE - Mundo</h1>
    <nav>
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="mundo.php" class="active">MUNDO</a></li>
            <li><a href="deporte.php">DEPORTE</a></li>
            <li><a href="unos.html">UNOS</a></li>
            <li><a href="administrator.php">ADMINISTRACIJA</a></li>
        </ul>
    </nav>
</header>

<main class="main">
    <h2>Vijesti - Mundo</h2>

    <?php if ($result->num_rows > 0): ?>
        <div class="grid">
            <?php while ($news = $result->fetch_assoc()): ?>
                <div class="card">
                    <?php if (!empty($news['slika'])): ?>
                        <img src="slike/<?= htmlspecialchars($news['slika']) ?>" alt="Slika vijesti">
                    <?php endif; ?>
                    <h3><?= htmlspecialchars($news['naslov']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($news['sazetak'])) ?></p>
                    <a href="clanak.php?id=<?= $news['id'] ?>">Pročitaj više</a>
                    <div class="date"><?= htmlspecialchars($news['datum']) ?></div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>Nema vijesti za kategoriju Mundo.</p>
    <?php endif; ?>
</main>

<footer class="footer">
    <p>© Copyright EL DEBATE. Todos los derechos reservados.</p>
</footer>

</body>
</html>
