<?php
require 'data/Quizz_BD.php';

echo "<ul>";
    foreach (questionAleatoire() as $question) {
        echo "<li>". $question["enonce"] ."". $question["contenu"] ."</li>";
    }
echo "</ul>";

//initialisation des variables nécessaires au quizz
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["nom"])) {
        $nom = $_POST["nom"];
        echo "nom : ".$nom.PHP_EOL;
    }
    if (isset($_POST["numQuestion"])) {
        $numQuestion = $_POST["numQuestion"];
        echo "numQuestion : ".$numQuestion.PHP_EOL;
    }
    if (isset($_POST["nbTotalQuestions"])) {
        $nbTotalQuestions = $_POST["nbTotalQuestions"];
        echo "\nnb total de question : ".$nbTotalQuestions.PHP_EOL;
    }
    
} else {
    //redirection vers la page d'accueil si on se rend sur questionnaire.php manuellement
    header("Location: index.php");
    exit();
}


?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <?php echo "<title>Question ".$numQuestion."</title>"; ?>
    <link rel="stylesheet" href="static/css/index.css">
</head>

<body>
    <?php
        require 'static/php/header.php';
    ?>

    <main>
    <?php echo "<h1>Question n°".$numQuestion."</h1>"; ?>
        
    </main>
</body>
</html>