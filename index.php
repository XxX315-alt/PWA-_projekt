<?php
include 'connect.php';

$sql = "SELECT * FROM vijesti WHERE arhiva = 1 ORDER BY datum DESC";
$result = $conn->query($sql);

$mundo = [];
$deporte = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if (strtolower($row['kategorija']) === 'mundo') {
            $mundo[] = $row;
        } elseif (strtolower($row['kategorija']) === 'deporte') {
            $deporte[] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Naslovnica</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header">
    <h1 class="logo">debate</h1>
    <nav>
        <ul>
            <li><a class="active" href="index.php">HOME</a></li>
            <li><a href="mundo.php">MUNDO</a></li>
            <li><a href="deporte.php">DEPORTE</a></li>
            <li><a href="unos.html">UNOS</a></li>
            <li><a href="administrator.php">ADMINISTRACJA</a></li>
        </ul>
    </nav>
</header>

<main class="main">

    <section class="section">
        <h2>Mundo</h2>
        <div class="grid">
            <?php foreach ($mundo as $news): ?>
                <div class="card">
                    <img src="slike/<?= htmlspecialchars($news['slika']) ?>" alt="Slika vijesti">
                    <h3><?= htmlspecialchars($news['naslov']) ?></h3>
                    <p><?= htmlspecialchars($news['sazetak']) ?></p>
                    <a class="button" href="clanak.php?id=<?= $news['id'] ?>">Pročitaj više</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section">
        <h2>Deporte</h2>
        <div class="grid">
            <?php foreach ($deporte as $news): ?>
                <div class="card">
                    <img src="slike/<?= htmlspecialchars($news['slika']) ?>" alt="Slika vijesti">
                    <h3><?= htmlspecialchars($news['naslov']) ?></h3>
                    <p><?= htmlspecialchars($news['sazetak']) ?></p>
                    <a class="button" href="clanak.php?id=<?= $news['id'] ?>">Pročitaj više</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</main>

<footer class="footer">
    <p>© Copyright EL DEBATE. Todos los derechos reservados.</p>
</footer>

</body>
</html>
