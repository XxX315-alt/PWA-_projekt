<?php
include 'connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Neispravan ID vijesti.");
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM vijesti WHERE id = ?");
$stmt->bind_param("i", $id);

if (!$stmt->execute()) {
    die("Greška u izvršavanju upita: " . $stmt->error);
}

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Vijest nije pronađena.");
}

$vijest = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8" />
  <title><?php echo htmlspecialchars($vijest['naslov']); ?></title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header class="header">
    <h1>debate</h1>
    <nav>
      <ul>
        <li><a href="index.php">HOME</a></li>
        <li><a href="mundo.php">MUNDO</a></li>
        <li><a href="clanak.php?id=<?php echo $vijest['id']; ?>">DEPORTE</a></li>
        <li><a href="administrator.php">ADMINISTRACJA</a></li>
        <li><a href="unos.html">UNOS</a></li>
      </ul>
    </nav>
  </header>

  <main class="main article">
    <p class="category"><?php echo htmlspecialchars($vijest['kategorija']); ?></p>

    <h1 class="article-title"><?php echo htmlspecialchars($vijest['naslov']); ?></h1>

    <p class="lead"><?php echo htmlspecialchars($vijest['sazetak']); ?></p>

    <?php if ($vijest['slika']): ?>
      <img src="slike/<?php echo htmlspecialchars($vijest['slika']); ?>" alt="<?php echo htmlspecialchars($vijest['naslov']); ?>" />
    <?php endif; ?>

    <p class="article-body"><?php echo nl2br(htmlspecialchars($vijest['tekst'])); ?></p>
</main>


  <footer class="footer">
    <p>© Copyright EL DEBATE. Todos los derechos reservados.</p>
  </footer>
</body>
</html>
