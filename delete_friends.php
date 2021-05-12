<?php
    // $ttl = 3600; // Une heure, en secondes
    // session_set_cookie_params($ttl);
    // ini_set('session.gc_maxlifetime', $ttl);
    session_start();
    include("functions.php");
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
      <title> Statut du retrait d'ami </title>



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

$condition=0;
if (isset($_POST["friends_deleted"])){
    if (empty($_POST["friends_deleted"])){
        echo "Veuillez rentrer le pseudo de l'ami que vous voulez ajouter";
    }
    // if ($_POST["friends_name"]=$_SESSION["pseudo"]){
    //     echo "Vous ne pouvez pas vous ajouter";
    // }

    for ($i=0; $i<sizeof($result_1) ; $i++) {
        if ($result_1[$i]["id_username_1"] == $_SESSION["userid"]) {
            $friend = $result_1[$i]["id_username_2"];
            $Requete_2 = mysqli_query($link,"SELECT first_name, last_name, pseudo FROM user WHERE userid = \"$friend\";");
            $result_2 = mysqli_fetch_all($Requete_2, MYSQLI_ASSOC);
            $user_check[]=$result_2[0]["pseudo"];

        }
        if ($result_1[$i]["id_username_2"] == $_SESSION["userid"]) {
            $friend_bis = $result_1[$i]["id_username_1"];
            $Requete_3 = mysqli_query($link,"SELECT userid, first_name, last_name, pseudo FROM user WHERE userid = \"$friend_bis\";");
            $result_3 = mysqli_fetch_all($Requete_3, MYSQLI_ASSOC);
            //var_dump($result_3);
            $user_check[]=$result_3[0]["pseudo"];
        }
    }
    //var_dump($user_check);
    if (!(in_array($_POST["friends_deleted"],$user_check))) {
        echo "Vous ne pouvez pas supprimer une personne qui n'est pas votre ami";
    }
    else {
        $condition+=1;
        $friend_added=$_POST["friends_deleted"];
        $Requete_finale = mysqli_query($link,"SELECT userid FROM user WHERE pseudo = \"$friend_added\";");
        $result_final = mysqli_fetch_all($Requete_finale, MYSQLI_ASSOC);
        //echo $result_final[0]["userid"];
        //echo $_SESSION["userid"];
        //var_dump($_SESSION["tab_solde"][2][0]);
        foreach($_SESSION["tab_solde"] as list($a,$b)) {
            //echo $a;
            //echo $b;
            if ($a == $friend_added){
                if ($b != 0){
                    echo "Le solde doit être égal à 0 pour supprimer un ami";
                    exit();
                }
                else{
                    if ($condition == 1 ){
                            delete_friendship($_SESSION["userid"],$result_final[0]["userid"],$link);
                        }
                }
            }
        }
    }
}



?>
<form method="link" action="carnet_amis.php"> <input type="submit" value="Retour au carnet d'amis" id="submit"> </form>
<form method="link" action="myprofile.php"> <input type="submit" value="Retour à l'accueil" id="submit"> </form>

</body>
</html>
