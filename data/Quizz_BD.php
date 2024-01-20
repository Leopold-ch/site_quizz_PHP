<?php

//fonction d'obtention du plus grand id d'une table donnée'
function idMax(string $nomTable): int
{   
    $idMax = 0;
    try{
        //établissement de la connexion avec la base de données
        $fichierDB=new PDO("sqlite:data/Quizz_BD.db");
        $fichierDB->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    
        $resRequete=$fichierDB->query("select max(id) from ".$nomTable.";");
    
        foreach($resRequete as $r){
            if (!is_null($r[0])){
                $idMax = $r[0];
            } else {$idMax = 0;}
        }
    
        //fermeture de la connexion
        $fichierDB=null;
    
    }catch(PDOException $e){
        echo "Problème de base de données : ".$e->getMessage();
    }
    return $idMax;
}

function idQuestionAleatoire(): int
{
    return random_int(1, idMax("QUESTION"));
}

//fonction d'obtention d'un quizz (une question et ses réponses)
function getQuizz(int $id): array
{
    $question = array();
    try{
        //établissement de la connexion avec la base de données
        $fichierDB=new PDO("sqlite:data/Quizz_BD.db");
        $fichierDB->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    
        
        $resRequete=$fichierDB->query("select idQuestion, idReponse, correcte, enonce, contenu
        from REPONSE_POSSIBLE join QUESTION join REPONSE on (REPONSE_POSSIBLE.idQuestion = QUESTION.id) AND (REPONSE_POSSIBLE.idReponse = REPONSE.id)
        WHERE idQuestion=".$id.";");
    
        foreach($resRequete as $r){
            array_push($question, $r);
        }

        //fermeture de la connexion
        $fichierDB=null;

    }catch(PDOException $e){
        echo "Problème de base de données : ".$e->getMessage();
    }
    return $question;

}

//fonction déterminant si une question a été correctement répondue ou non
function reponseCorrectes(int $idQuestion, array $reponses): bool
{
    $bonnesReponses = array();
    foreach (getQuizz($idQuestion) as $array){
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

//fonction d'insertion d'un résultat dans la base de données
function insererResultat(int $nbQuestions, int $score, string $utilisateur="null"): void
{
    try{
        //établissement de la connexion avec la base de données
        $fichierDB=new PDO("sqlite:data/Quizz_BD.db");
        $fichierDB->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
        
        $id = idMax("RESULTAT") +1;


        $insertion="INSERT INTO RESULTAT (id, utilisateur, nbQuestions, nbReponsesCorrectes) VALUES (:id, :utilisateur, :nbQuestions, :nbReponsesCorrectes)";
        $stmt=$fichierDB->prepare($insertion);
        $stmt->bindParam(":id",$id);
        $stmt->bindParam(":utilisateur",$utilisateur);
        $stmt->bindParam(":nbQuestions",$nbQuestions);
        $stmt->bindParam(":nbReponsesCorrectes",$score);

        $stmt->execute(); 

        //fermeture de la connexion
        $fichierDB=null;

    }catch(PDOException $e){
        echo "L'insertion a échoué. ".$e->getMessage();
    }
}

//fonction d'insertion d'un quizz dans la base de données
function insererQuestion(string $enonce, array $questions, array $corrections): void
{
    try{
        //établissement de la connexion avec la base de données
        $fichierDB=new PDO("sqlite:data/Quizz_BD.db");
        $fichierDB->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
        

        $idQuestion = idMax("QUESTION") +1;

        $insertion="INSERT INTO QUESTION (id, enonce) VALUES (:id, :enonce)";
        $stmt=$fichierDB->prepare($insertion);
        $stmt->bindParam(":id",$idQuestion);
        $stmt->bindParam(":enonce",$enonce);
        //insertion de la question
        $stmt->execute();
        
        $idReponse = idMax("REPONSE");
        foreach ($questions as $cle => $valeur){
            
            //s'il y a la réponse comporte des caractère, elle est insérée
            if (!empty(trim($valeur))){
                $idReponse += 1;

                if (in_array($cle+1, $corrections)){
                    $correcte = 1;
                } else{$correcte = 0;}

                $insertion="INSERT INTO REPONSE (id, contenu) VALUES (:id, :contenu)";
                $stmt=$fichierDB->prepare($insertion);
                $stmt->bindParam(":id", $idReponse);
                $stmt->bindParam(":contenu", $valeur);
                //insertion de la réponse
                $stmt->execute();

                $insertion="INSERT INTO REPONSE_POSSIBLE (idQuestion, idReponse, correcte) VALUES (:idQuestion, :idReponse, :correcte)";
                $stmt=$fichierDB->prepare($insertion);
                $stmt->bindParam(":idQuestion", $idQuestion);
                $stmt->bindParam(":idReponse", $idReponse);
                $stmt->bindParam(":correcte", $correcte);
                //insertion de l'association question - réponse
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
