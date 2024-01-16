<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["nom"])) {
        $nom = $_POST["nom"];
        echo $nom;
    }
    if (isset($_POST["num_question"])) {
        $num_question = $_POST["num_question"];
        echo $num_question;
    }
    if (isset($_POST["nbTotalQuestions"])) {
        $nbTotalQuestions = $_POST["nbTotalQuestions"];
        echo $nbTotalQuestions;
    }
    
}

try{
    //le fichier de BD s'appelera Quizz_BD.db
    $file_db=new PDO("sqlite:data/Quizz_BD.db");
    $file_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

    $result=$file_db->query("SELECT * from QUESTION");
    echo "<ul>";
    foreach($result as $r){
        //echo "<li>".$r["idQuestion"]." - ".$r["enonce"]."</li>";
    }
    echo "</ul>";

    //fermeture de la connexion
    $file_db=null;

}catch(PDOException $e){
    echo $e->getMessage();
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <?php echo "<title>Question ".$num_question."</title>"; ?>
    <link rel="stylesheet" href="static/css/index.css">
</head>

<body>
    <?php
        require 'static/php/header.php';
    ?>

    <main>
    <?php echo "<h1>Question n°".$num_question."</h1>"; ?>
        
    </main>
</body>
</html>