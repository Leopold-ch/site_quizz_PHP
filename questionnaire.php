<?php
require 'data/Quizz_BD.php';
$nom = "";
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
        echo "nb total de question : ".$nbTotalQuestions.PHP_EOL;
    }

    if (isset($_POST["score"])) {
        $score = $_POST["score"];
        echo "score : ".$score.PHP_EOL;
    } else {
        $score = 0;
    }

    if (isset($_POST["idQuestion"])) {
        $idQuestion = $_POST["idQuestion"];
        echo "idQuestion : ".$idQuestion.PHP_EOL;
    } else{
        $idQuestion = idAleatoire();
    }
    $questionPosee = getQuestion($idQuestion);

    if (isset($_POST["choix"])) {
        $choix = $_POST["choix"];
        echo "reponses :".print_r($choix).PHP_EOL;
    }

    echo "<ul>";
    foreach ($questionPosee as $question) {
        echo "<li>". $question["enonce"] ." - ". $question["contenu"] ." - ". $question["idQuestion"] ." - ". $question["idReponse"] ."</li>";
    }
    echo "</ul>";


} else {
    //redirection vers la page d'accueil si on se rend sur questionnaire.php manuellement
    header("Location: index.php");
    exit();
}

if ($numQuestion > $nbTotalQuestions){
    //redirection vers la page d'accueil si on est arrivé au bout des questions
    header("Location: index.php?nom=".$nom);
    exit();
}


?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <?php echo "<title>Question ".$numQuestion."</title>"; ?>
    <link rel="stylesheet" href="static/css/questionnaire.css">
</head>

<body>
    <?php
        require 'static/php/header.php';
    ?>

    <main>
    <?php
    echo "<h1>Question n°".$numQuestion."</h1>";
    echo "<h2>".$questionPosee[0]["enonce"]."</h2>";


    echo "<form method='post'>
    <input type='hidden' name='nom' value='".$nom."' />
    <input type='hidden' name='score' value='$score' />
    <input type='hidden' name='numQuestion' value='".$numQuestion."' />
    <input type='hidden' name='nbTotalQuestions' value='".$nbTotalQuestions."' />
    <input type='hidden' name='idQuestion' value='".$idQuestion."' />
    <input type='hidden' name='repondu' value='".$repondu."' />";
    
    echo "<div>";
    foreach ($questionPosee as $reponsePossible) {
        $coche = "";
        if (isset($choix) && in_array($reponsePossible["idReponse"], $choix)){
            $coche = "checked";
        }
        
        echo "<label for='".$reponsePossible["idReponse"]."'>
        <input type='checkbox' id='".$reponsePossible["idReponse"]."' name='choix[]' value='".$reponsePossible["idReponse"]."' ".$coche."> ".$reponsePossible["contenu"]."</label><br>";
    }
    echo "</div>";
    if (!isset($choix)){
        echo "<input type='submit' value='Valider'>";
    }

    echo "</form>";
    
    if (isset($choix)){
        if (reponseCorrectes($idQuestion, $choix)){
            echo "<p>Bien joué ".$nom." !</p><p>Vous avez correctement répondu.</p>";
            $score += 1;
        } else {
            echo "<p>Dommage, la bonne était réponse était :</p><br>";
            foreach ($questionPosee as $reponsePossible){
                if ($reponsePossible["correcte"] == 1){
                    echo "<p>".$reponsePossible["contenu"]."</p>";
                }
            }
        }
        echo "<br><p><b>Score atteint : ".$score." / ".$numQuestion."</b></p>"; 

        $bouton = "Passer à la question suivante";
        if ($numQuestion == $nbTotalQuestions){
            $bouton = "Terminer";
        }
        $numQuestion += 1;
        echo <<<FORM
            <form method='post'>
            <input type='hidden' name='nom' value='$nom' />
            <input type='hidden' name='numQuestion' value='$numQuestion' />
            <input type='hidden' name='nbTotalQuestions' value='$nbTotalQuestions' />
            <input type='hidden' name='score' value='$score' />
            <input type='hidden' name='repondu' value='$repondu' />
            <input type='submit' value='$bouton'>
            </form>
        FORM;
    }
    ?>
    

    </main>
</body>
</html>