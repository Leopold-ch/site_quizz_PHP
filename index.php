<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["nom"])) {
        $nom = $_POST["nom"];
        echo $nom;
    }
}
?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="static/css/index.css">
</head>

<body>
    <?php
        require 'static/php/header.php';
    ?>

    <main>
        <h1>Quizz de culture générale !</h1>
        <h2>Testez vos connaissances à travers des quizz divers et variés</h2>

        <div class="nom">
            <p>Saisissez votre nom :</p>
            
            <form method='post'>
                <?php echo "<input type='text' id='nom' name='nom' maxlength='20' value='".$nom."' placeholder='Votre nom' />"; ?>

                <input type='submit' value='Envoyer'>
            </form>
        </div>

        <div class="lancement">
            <?php
            for ($nbQuestions = 5; $nbQuestions < 16; $nbQuestions+= 5){
                echo "<form action='questionnaire.php' method='post'>";
                echo "<input type='text' id='nbTotalQuestions' name='nbTotalQuestions' value='".$nbQuestions."' required />";
                echo "<input type='submit' value='Quizz de ".$nbQuestions." questions'>";
                echo "</form>";
            }
            ?>
        </div>
    </main>
</body>
</html>