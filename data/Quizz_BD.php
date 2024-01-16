#!/usr/bin/php

<?php

//chargement de l'intégralité de la base de données
try{
    //le fichier de BD s'appelera Quizz_BD.db
    $fichierDB=new PDO("sqlite:data/Quizz_BD.db");
    $fichierDB->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

    $contenuBD = array();
    $resRequete=$fichierDB->query("select idQuestion, idReponse, correcte, enonce, contenu from REPONSE_POSSIBLE join QUESTION join REPONSE on (REPONSE_POSSIBLE.idQuestion = QUESTION.id) AND (REPONSE_POSSIBLE.idReponse = REPONSE.id);");

    foreach($resRequete as $r){
        array_push($contenuBD, $r);
    }

    //fermeture de la connexion
    $fichierDB=null;

}catch(PDOException $e){
    echo "Problème de base de données : ".$e->getMessage();
}


//fonction d'obtention du plus grand id de question
function idQuestionMax(): int
{
    global $contenuBD;
    $idQuestionMax = 0;

    foreach ($contenuBD as $array) {
        $idQuestion = $array['idQuestion'];

        if ($idQuestion > $idQuestionMax) {
            $idQuestionMax = $idQuestion;
        }
    }

    return $idQuestionMax;
}

function questionAleatoire(): array
{
    global $contenuBD;
    $idAleatoire = random_int(1, idQuestionMax());
    $questionAlleatoire = array();

    foreach ($contenuBD as $array){
        if ($array['idQuestion'] == $idAleatoire){
            array_push($questionAlleatoire, $array);
        }
    }

    return $questionAlleatoire;

}

?>
