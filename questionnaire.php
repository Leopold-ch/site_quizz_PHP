<?php
require 'data/Quizz_BD.php';
$nom = "";
//initialisation des variables nécessaires au quizz
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["nom"])) {$nom = $_POST["nom"];}

    if (isset($_POST["numQuestion"])) {$numQuestion = $_POST["numQuestion"];}

    if (isset($_POST["nbTotalQuestions"])) {$nbTotalQuestions = $_POST["nbTotalQuestions"];}

    if (isset($_POST["score"])) {$score = $_POST["score"];}
    else {$score = 0;}

    if (isset($_POST["choix"])) {$choix = $_POST["choix"];}

    if (isset($_POST["idQuestion"])) {$idQuestion = $_POST["idQuestion"];}
    else{$idQuestion = idQuestionAleatoire();}

    $questionPosee = getQuizz($idQuestion);

} else {
    //redirection vers la page d'accueil si on se rend sur questionnaire.php manuellement
    header("Location: index.php");
    exit();
}

if ($numQuestion > $nbTotalQuestions){      //si on est arrivé à la fin du quizz
    //enregristrement dans la base de données
    if (isset($nom)){insererResultat($nbTotalQuestions, $score, $nom);}
    else {insererResultat($nbTotalQuestions, $score);}
    //redirection vers la page d'accueil
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
    echo "<h1>Question n°".$numQuestion."</h1>
    <h2>".$questionPosee[0]["enonce"]."</h2>

    <form method='post'>
    <input type='hidden' name='nom' value='".$nom."' />
    <input type='hidden' name='score' value='$score' />
    <input type='hidden' name='numQuestion' value='".$numQuestion."' />
    <input type='hidden' name='nbTotalQuestions' value='".$nbTotalQuestions."' />
    <input type='hidden' name='idQuestion' value='".$idQuestion."' />
    
    <div class='rep'>";
    foreach ($questionPosee as $reponsePossible) {
        $coche = "";
        $disabled = "";
        if (isset($choix)){
            $disabled = "disabled";
            if (in_array($reponsePossible["idReponse"], $choix)){
                $coche = "checked";
            }
        }
        
        echo "<label for='".$reponsePossible["idReponse"]."'>
        <input type='checkbox' id='".$reponsePossible["idReponse"]."' name='choix[]' value='".$reponsePossible["idReponse"]."' ".$coche." ".$disabled."> ".$reponsePossible["contenu"]."</label><br>";
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

        $bouton = "Question suivante";
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
            <input type='submit' value='$bouton'>
            </form>
        FORM;
    }
    ?>

    </main>
</body>
</html>
