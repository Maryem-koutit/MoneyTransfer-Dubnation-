<?php
    // $ttl = 3600; // Une heure, en secondes
    // session_set_cookie_params($ttl);
    // ini_set('session.gc_maxlifetime', $ttl);
    session_start();
    include("functions.php");
?>

<?php

$link = mysqli_connect('localhost', 'admin', 'it103','Dubnation');
if (!$link) {
		echo "Probleme de connexion";
		die('Could not connect: ' . mysqli_error());
}
echo 'Connected successfully ';

$pseudo_1 = $_SESSION["pseudo"];
//echo $pseudo_1;
$Requete = mysqli_query($link,"SELECT userid FROM user WHERE pseudo = \"$pseudo_1\";");
$result = mysqli_fetch_all($Requete, MYSQLI_ASSOC);

//echo $result[0]["userid"];
$_SESSION["userid"] = $result[0]["userid"];
//echo $_SESSION["userid"];
$user_con = $result[0]["userid"];
//echo $_SESSION["userid"];

$tab_solde = array (
    array("$pseudo_1",0),
);
//var_dump($tab_solde);


                            ///////////////

// Toutes les relations d'amis en lien avec le user connecté
$Requete_1 = mysqli_query($link,"SELECT * FROM Reach_my_friend WHERE id_username_1 = \"$user_con\" OR id_username_2 = \"$user_con\";");
$result_1 = mysqli_fetch_all($Requete_1, MYSQLI_ASSOC);
//var_dump($result_1);

                            /////////////

if ($_SESSION["pseudo"]){
    $user_check[]=$_SESSION["pseudo"];
    //var_dump($user_check);
}


?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
         <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="../it103/carnet_amis.css">

		 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    </head>
    <body>
      <title> Carnet d'amis </title>


    <h1> Bienvenue sur ton carnet d'amis: <?php echo $_SESSION["pseudo"];?> </h1>
        <h2> Liste d'amis</h2>
        <div id="debut">
        <?php
            for ($i=0; $i<sizeof($result_1) ; $i++) {
                if ($result_1[$i]["id_username_1"] == $_SESSION["userid"]) {
                    //echo $result_1[$i]["id_username_2"];
                    $friend = $result_1[$i]["id_username_2"];
                    //echo $friend;
                    $Requete_2 = mysqli_query($link,"SELECT first_name, last_name, pseudo FROM user WHERE userid = \"$friend\";");
                    $result_2 = mysqli_fetch_all($Requete_2, MYSQLI_ASSOC);
                    //var_dump($result_2);
                    echo $result_2[0]["last_name"]; echo '&nbsp';
                    echo $result_2[0]["first_name"]; echo '&nbsp';
                    $user_check[]=$result_2[0]["pseudo"]; ?>
                    <div id="exigence"> <?php echo"Pseudo:"?> <?php echo $result_2[0]["pseudo"];echo "<br/>"; ?> </div>
                <?php
                    $Requete_5 = mysqli_query($link,"SELECT sum FROM Transaction_Ami WHERE id_user_dept = \"$friend\" AND id_user_waiting = \"$user_con\";");
                    $result_5 = mysqli_fetch_all($Requete_5, MYSQLI_ASSOC);
                    //var_dump($result_5);
                    $Requete_7 = mysqli_query($link,"SELECT sum FROM Transaction_Ami WHERE  id_user_waiting = \"$friend\" AND id_user_dept = \"$user_con\" ;");
                    $result_7 = mysqli_fetch_all($Requete_7, MYSQLI_ASSOC);
                    //var_dump($result_7);
                    $solde_amis = 0;
                    for ($k=0; $k <sizeof($result_5) ; $k++) {
                        $solde_amis = $solde_amis - $result_5[$k]["sum"];
                    }
                    for ($k=0; $k <sizeof($result_7) ; $k++) {
                        $solde_amis = $solde_amis + $result_7[$k]["sum"];
                    }
                    echo "Solde:"; echo '&nbsp'; echo $solde_amis;
                    $nouvelleLigne = array($result_2[0]["pseudo"],$solde_amis);
                    $tab_solde[] = $nouvelleLigne;
                    // $tab_solde[]=$result_2[0]["pseudo"];
                    // $tab_solde[]=$solde_amis;
                    // $tab_solde["friend"]=$result_2[0]["pseudo"];
                    // $tab_solde["solde"]=$solde_amis;
                    //var_dump($tab_solde);
                    echo "<br/>";
                }
                if ($result_1[$i]["id_username_2"] == $_SESSION["userid"]) {
                    $friend_bis = $result_1[$i]["id_username_1"];
                    $Requete_3 = mysqli_query($link,"SELECT userid, first_name, last_name, pseudo FROM user WHERE userid = \"$friend_bis\";");
                    $result_3 = mysqli_fetch_all($Requete_3, MYSQLI_ASSOC);
                    //var_dump($result_3);
                    echo $result_3[0]["last_name"]; echo '&nbsp';
                    echo $result_3[0]["first_name"]; echo '&nbsp';
                    $user_check[]=$result_3[0]["pseudo"];?>
                    <div id="exigence"> <?php echo"Pseudo:"?> <?php echo $result_3[0]["pseudo"];echo "<br/>"; ?> </div>
                    <?php
                    $Requete_6 = mysqli_query($link,"SELECT sum FROM Transaction_Ami WHERE id_user_dept = \"$friend_bis\" AND id_user_waiting = \"$user_con\";");
                    $result_6 = mysqli_fetch_all($Requete_6, MYSQLI_ASSOC);
                    //var_dump($result_5);
                    $Requete_8 = mysqli_query($link,"SELECT sum FROM Transaction_Ami WHERE  id_user_waiting = \"$friend_bis\" AND id_user_dept = \"$user_con\" ;");
                    $result_8 = mysqli_fetch_all($Requete_8, MYSQLI_ASSOC);
                    //var_dump($result_7);
                    $solde_amis = 0;
                    for ($k=0; $k <sizeof($result_6) ; $k++) {
                        $solde_amis = $solde_amis - $result_6[$k]["sum"];
                    }
                    for ($k=0; $k <sizeof($result_8) ; $k++) {
                        $solde_amis = $solde_amis + $result_8[$k]["sum"];
                    }
                    echo "Solde:"; echo '&nbsp'; echo $solde_amis;
                    $nouvelleLigne = array($result_2[0]["pseudo"],$solde_amis);
                    $tab_solde[] = $nouvelleLigne;
                    echo "<br/>";
                }
            }
$_SESSION["tab_solde"]=$tab_solde;
// var_dump($_SESSION["tab_solde"]);
//echo sizeof($_SESSION["tab_solde"]);
        ?>
        </div>

        <div class="panel-body">
			<form method="post" action="delete_friends.php" >
                <div class="form-row">
                    <div class="col-md-4 mb-3" id="ajout">
                        <label for="friends_deleted"> Supprimer un ami </label>
                        <input type="text" name="friends_deleted" id="friends_deleted" class="form-control input-sm" placeholder="Pseudo" required>
                    </div>
                    </div>
                    <input class="btn btn-primary btn-sm" type="submit" value="Supprimer" id="submit">

        </form>
        </div>


        <h2> Autres utilisateurs </h2>
        <div id="debut">
    <?php
        //var_dump($user_check);
        $Requete_4 = mysqli_query($link, "SELECT userid, pseudo FROM user");
        $result_4 = mysqli_fetch_all($Requete_4, MYSQLI_ASSOC);
        //var_dump($result_4);
        //echo $result_4[1]["pseudo"];
        for ($i=0; $i < sizeof($result_4); $i++) {
            if (!in_array($result_4[$i]["pseudo"],$user_check)) {
                echo $result_4[$i]["pseudo"];
                //echo $result_4[$i]["userid"];


            }
            echo "<br/>";
        }
    ?>

    </div>
    <div class="panel-body">
			<form method="post" action="add_friends.php" >
                <div class="form-row">
                    <div class="col-md-4 mb-3" id="ajout">
                        <label for="friends_name"> Ajouter un ami </label>
                        <input type="text" name="friends_name" id="friends_name" class="form-control input-sm" placeholder="Pseudo" required>
                    </div>
                    </div>
                    <input class="btn btn-primary btn-sm" type="submit" value="Ajouter" id="submit">

    </form>
    </div>
    </body>
    </html>
