<?php
include 'connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $about = $_POST['about'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $archive = isset($_POST['archive']) ? 1 : 0; 

    $image = '';
    if (isset($_FILES['pphoto']) && $_FILES['pphoto']['error'] == 0) {
        $image = $_FILES['pphoto']['name'];
        move_uploaded_file($_FILES['pphoto']['tmp_name'], "slike/" . $image);
    }

    $date = date("Y-m-d");

   $stmt = $conn->prepare("INSERT INTO vijesti (datum, naslov, sazetak, tekst, slika, kategorija, arhiva) VALUES (?, ?, ?, ?, ?, ?, ?)");


    if (!$stmt) {
        die("Greška u pripremi SQL upita: " . $conn->error);
    }

    $stmt->bind_param("ssssssi", $date, $title, $about, $content, $image, $category, $archive);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <title>Prikaz vijesti</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="header">
    <h1 class="logo">debate</h1>
    <nav>
      <ul>
        <li><a href="index.php">HOME</a></li>
        <li><a href="#">MUNDO</a></li>
        <li><a href="clanak.php">DEPORTE</a></li>
        <li><a href="#">ADMINISTRACJA</a></li>
        <li><a href="unos.html">UNOS</a></li>
      </ul>
    </nav>
  </header>

  <main class="main">
    <section class="section">
      <p class="category"><?php echo htmlspecialchars($category); ?></p>
      <h1><?php echo htmlspecialchars($title); ?></h1>
      <p><strong>Kratki sadržaj:</strong> <?php echo htmlspecialchars($about); ?></p>
      <p><strong>Sadržaj:</strong></p>
      <p><?php echo nl2br(htmlspecialchars($content)); ?></p>
      <p><strong>Prikazati na stranici:</strong> <?php echo $archive ? "DA" : "NE"; ?></p>
      <?php if ($image): ?>
        <img src="slike/<?php echo htmlspecialchars($image); ?>" alt="Slika vijesti" style="width:100%; max-width:600px;">
      <?php endif; ?>
      <p><a href="index.php">Povratak na početnu</a></p>
    </section>
  </main>

  <footer class="footer">
    <p>© Copyright EL DEBATE. Todos los derechos reservados.</p>
  </footer>
</body>
</html>
