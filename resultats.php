<?php
require 'data/Quizz_BD.php';
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Résultats</title>
    <link rel="stylesheet" href="static/css/resultats.css">
</head>

<body>
    <?php
        require 'static/php/header.php';
    ?>

    <main>
        <?php
        $appartenance = "tous les quizz";
        if (isset($nom)) {
            $appartenance = $nom;
        }
        echo "<h1>Résultats de ".$appartenance."</h1>";
        ?>

        <table>
            <tr>
                <?php if (!isset($nom)){echo "<th>Utilisateur</th>";} ?>
                <th>Nombre de questions</th>
                <th>Réponses correctes</th>
                <th>Pourcentage de réussite</th>
            </tr>

            <?php

            if (isset($nom)) {
                $resultats = getResultats($nom);}
            else {$resultats = getResultats();}

            foreach ($resultats as $res) {
                echo "<tr>";
                if (!isset($nom)){
                    echo "<td>".$res["utilisateur"]."</td>";
                }
                echo "<td>".$res["nbQuestions"]."</td>
                <td>".$res["nbReponsesCorrectes"]."</td>
                <td>".round($res["nbReponsesCorrectes"] / $res["nbQuestions"] *100)."% </td>
                </tr>";

            }

            ?>
        </table>
    </main>
</body>
</html>
