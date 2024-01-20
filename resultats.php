<?php
$nom = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["nom"])) {$nom = $_POST["nom"];}
}

if (!empty($_GET['nom'])){$nom = $_GET['nom'];}
?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Résultats</title>
    <link rel="stylesheet" href="static/css/resultats.css">
</head>

<body>
    <?php
        require 'static/php/header.php';
    ?>

    <main>
    </main>
</body>
</html>