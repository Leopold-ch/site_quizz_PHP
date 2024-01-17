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

//fonction d'obtention du plus grand id de reponse
function idReponseMax(): int
{
    global $contenuBD;
    $idReponseMax = 0;

    foreach ($contenuBD as $array) {
        $idReponse = $array['idReponse'];

        if ($idReponse > $idReponseMax) {
            $idReponseMax = $idReponse;
        }
    }

    return $idReponseMax;
}

function idAleatoire(): int
{
    return random_int(1, idQuestionMax());
}

function getQuestion(int $id): array
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

function reponseCorrectes(int $idQuestion, array $reponses): bool
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

function insererResultat(int $nbQuestions, int $score): void
{
    try{
        //le fichier de BD s'appelera Quizz_BD.db
        $fichierDB=new PDO("sqlite:data/Quizz_BD.db");
        $fichierDB->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

        $insertion="INSERT INTO RESULTAT (id, nbQuestions, nbReponsesCorrectes) VALUES (:id, :nbQuestions, :nbReponsesCorrectes)";
        $stmt=$fichierDB->prepare($insertion);
        $stmt->bindParam(":id",$id);
        $stmt->bindParam(":nbQuestions",$nbQuestions);
        $stmt->bindParam(":nbReponsesCorrectes",$nbReponsesCorrectes);

        $stmt->execute(); 

        //fermeture de la connexion
        $fichierDB=null;

    }catch(PDOException $e){
        echo "L'insertion a échoué. ".$e->getMessage();
    }
}

function insererQuestion(string $enonce, array $questions, array $corrections): void
{
    try{
        //le fichier de BD s'appelera Quizz_BD.db
        $fichierDB=new PDO("sqlite:data/Quizz_BD.db");
        $fichierDB->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
        

        $idQuestion = idQuestionMax() +1;

        $insertion="INSERT INTO QUESTION (id, enonce) VALUES (:id, :enonce)";
        $stmt=$fichierDB->prepare($insertion);
        $stmt->bindParam(":id",$idQuestion);
        $stmt->bindParam(":enonce",$enonce);

        $stmt->execute();
        
        $idReponse = idReponseMax();
        foreach ($questions as $cle => $valeur){
            
            //s'il y a des caractères, on insère
            if (!empty(trim($valeur))){
                $idReponse += 1;

                if (in_array($cle+1, $corrections)){
                    $correcte = 1;
                } else{$correcte = 0;}

                $insertion="INSERT INTO REPONSE (id, contenu) VALUES (:id, :contenu)";
                $stmt=$fichierDB->prepare($insertion);
                $stmt->bindParam(":id", $idReponse);
                $stmt->bindParam(":contenu", $valeur);

                $stmt->execute();

                $insertion="INSERT INTO REPONSE_POSSIBLE (idQuestion, idReponse, correcte) VALUES (:idQuestion, :idReponse, :correcte)";
                $stmt=$fichierDB->prepare($insertion);
                $stmt->bindParam(":idQuestion", $idQuestion);
                $stmt->bindParam(":idReponse", $idReponse);
                $stmt->bindParam(":correcte", $correcte);

                $stmt->execute();
            }
        }

        //fermeture de la connexion
        $fichierDB=null;

    }catch(PDOException $e){
        echo "L'insertion a échoué. ".$e->getMessage();
    }
}


?>
