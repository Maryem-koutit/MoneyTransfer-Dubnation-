<?php
		// $ttl = 3600; // Une heure, en secondes
		// session_set_cookie_params($ttl);
		// ini_set('session.gc_maxlifetime', $ttl);
		include("functions.php");
    session_start();
?>
<?php

$link = mysqli_connect('localhost', 'admin', 'it103','Dubnation');
if (!$link) {
		echo "Probleme de connexion";
		die('Could not connect: ' . mysqli_error());
}
echo 'Connected successfully ';
echo "<br/>";

$pseudo_1 = $_SESSION["pseudo"];
$Requete = mysqli_query($link,"SELECT userid FROM user WHERE pseudo = \"$pseudo_1\";");
$result = mysqli_fetch_all($Requete, MYSQLI_ASSOC);

$_SESSION["userid"] = $result[0]["userid"];
$user_con = $result[0]["userid"];

$Requete_1 = mysqli_query($link,"SELECT * FROM Reach_my_friend WHERE id_username_1 = \"$user_con\" OR id_username_2 = \"$user_con\";");
$result_1 = mysqli_fetch_all($Requete_1, MYSQLI_ASSOC);

if ($_SESSION["pseudo"]){
    $user_check[]=$_SESSION["pseudo"];
}
?>

<!DOCTYPE html>
<html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dette_creance.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body>
	<title> Dettes & Créances </title>
    <h1> Voici tes listes de dettes et de créances </h1>



<?php
    $requete_1 = mysqli_query($link,"SELECT * FROM Transaction_Ami WHERE  id_user_dept = \"$user_con\" OR id_user_waiting = \"$user_con\" ORDER BY sum DESC;");
    $result1 = mysqli_fetch_all($requete_1, MYSQLI_ASSOC);
    //echo $result1[4]["id_user_waiting"];
    //var_dump($result1);?>
    <h2> Liste des dettes </h2>
        <div id="exigence1"><?php
    $dette = 0;
    for ($i=0; $i <sizeof($result1) ; $i++) {
        if ($result1[$i]["statut"] == 'opened') {
            if ($result1[$i]["id_user_dept"] == $user_con) {
                echo "DATE:"; echo '&nbsp'; echo $result1[$i]["date_de_creation"]; echo '&nbsp';
                echo "CONTEXTE:"; echo '&nbsp'; echo $result1[$i]["message_explicatif"]; echo '&nbsp';
                $useridfriend = $result1[$i]["id_user_waiting"];
                $requete2 = mysqli_query($link,"SELECT pseudo FROM user WHERE userid = \"$useridfriend\";");
                $result2 = mysqli_fetch_all($requete2, MYSQLI_ASSOC);
                echo "DONC:"; echo '&nbsp'; echo "Tu dois:"; echo '&nbsp';
                echo $result1[$i]["sum"]; echo '&nbsp'; echo "€"; echo '&nbsp';
                echo "à"; echo '&nbsp';echo $result2[0]["pseudo"];
                $dette -= $result1[$i]["sum"];
                echo "<br/>";
            }
        }
    }?> </div>
            <h2> Liste des créances </h2>
            <div id="exigence2">
            <?php
            $creance = 0;
            for ($i=0; $i <sizeof($result1) ; $i++) {
                if ($result1[$i]["statut"] == 'opened') {
                    if ($result1[$i]["id_user_waiting"] == $user_con) {
                        echo "DATE:"; echo '&nbsp'; echo $result1[$i]["date_de_creation"]; echo '&nbsp';
                        echo "CONTEXTE:"; echo '&nbsp'; echo $result1[$i]["message_explicatif"]; echo '&nbsp';
                        $useridfriend = $result1[$i]["id_user_dept"];
                        $requete2 = mysqli_query($link,"SELECT pseudo FROM user WHERE userid = \"$useridfriend\";");
                        $result2 = mysqli_fetch_all($requete2, MYSQLI_ASSOC);
                        //var_dump($result2);
                        echo "DONC:"; echo '&nbsp'; echo $result2[0]["pseudo"]; echo '&nbsp'; echo "te dois:"; echo '&nbsp';
                        echo $result1[$i]["sum"]; echo '&nbsp'; echo "€"; echo '&nbsp';
                        $creance += $result1[$i]["sum"];
                }
        echo "<br/>";
    }
    }
    ?>
    </div> <?php
    $encours = $dette+$creance;
    ?>
    <div id="encours"><?php
    echo "Ton encours est de:"; echo '&nbsp'; echo $encours; echo "€";
    ?>
    </div>
    </body>
