<?php
require 'data/Quizz_BD.php';

$nbMaxReponses = 5;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["enonce"])) {
        $enonce = $_POST["enonce"];
    }

    if (isset($_POST["reponses"])) {
        $reponses = $_POST["reponses"];
    }

    if (isset($_POST["corrections"])) {
        $corrections = $_POST["corrections"];
    }
    
    //si l'utilisateur a saisi des réponses et à coché des cases
    if (!empty($reponses) && !empty($corrections)){
        $valide = true;
        foreach ($corrections as $indiceCorrect){
            if (empty($reponses[intval($indiceCorrect)-1])){
                $valide = false;
            }
        }
        //si les données sont correctes, on insère le quizz dans la base de données
        if ($valide){insererQuestion($enonce, $reponses, $corrections);}
    }
}

?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <?php echo "<title>Question ".$numQuestion."</title>"; ?>
    <link rel="stylesheet" href="static/css/creation_quizz.css">
</head>

<body>
    <?php
        require 'static/php/header.php';
    ?>

    <main>
        <h1>Création d'un quizz :</h1>
        <p>Ecrivez l'énoncé de votre question, renseignez une à cinq réponses, et cochez les réponses correctes.<p>

        <?php //action='index.php
        echo "<form  method='post'>
            <input type='text' name='enonce' placeholder='Énoncé de la question' required /><br>";
            
            for ($i=1; $i < $nbMaxReponses+1; $i++){
                echo "<label for='".$i."'>
                <input type='checkbox' id='check".$i."' name='corrections[]' value='".$i."'>
                <input type='text' name='reponses[]' placeholder='Réponse n°".$i."' />
                </label><br>";
            }

            echo "<input type='submit' value='Enregistrer'>
            </form>";
        ?>
        
    </main>
</body>
</html>