<link rel="stylesheet" href="static/css/header.css">
<?php
$nom = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["nom"])) {$nom = $_POST["nom"];}

}
if (!empty($_GET['nom'])){$nom = $_GET['nom'];}
?>


<header>
    <nav>
        <ul>
            <?php
            echo "<li><a href='../../index.php?nom=".$nom."' >Accueil</a></li>
            <li><a href='../../creation_quizz.php?nom=".$nom."'>Créer une question</a></li>
            <li><a href='../../resultats.php?nom=".$nom."'>Mes résultats</a></li>";
            ?>
        </ul>
    </nav>
</header>
