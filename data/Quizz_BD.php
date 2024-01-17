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

function idAleatoire(): int
{
    return random_int(1, idQuestionMax());
}

function getQuestion($id): array
{
    global $contenuBD;
    $questionAlleatoire = array();

    foreach ($contenuBD as $array){
        if ($array['idQuestion'] == $id){
            array_push($questionAlleatoire, $array);
        }
    }

    return $questionAlleatoire;

}

function reponseCorrectes($idQuestion, $reponses): bool
{
    $bonnesReponses = array();
    foreach (getQuestion($idQuestion) as $array){
        if ($array["correcte"] == 1){
            array_push($bonnesReponses, $array["idReponse"]);
        }
    }
    
    if (count($reponses) != count($bonnesReponses)) {return false;}

    for($i = 0; $i<count($reponses); $i++) {
        if (!in_array($reponses[$i], $bonnesReponses)) {
            return false;
        }
    }
    return true;
}

?>
