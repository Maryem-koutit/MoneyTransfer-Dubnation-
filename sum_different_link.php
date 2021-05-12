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
//var_dump($_POST);
$_SESSION["utilisateur_source"]=$_POST["utilisateur_source"];
$_SESSION["Statut"]=$_POST["Statut"];
$_SESSION["Message_Explicatif"]=$_POST["Message_Explicatif"];
$_SESSION["date_de_création"]=$_POST["date_de_création"];
$_SESSION["Message_de_fermeture"]=$_POST["Message_de_fermeture"];
$_SESSION["date_de_fermeture"]=$_POST["date_de_fermeture"];
$_SESSION["utilisateur_cible"]=$_POST["utilisateur_cible"];
//var_dump($_SESSION);

if (($_SESSION["utilisateur_source"])!=$_SESSION["pseudo"]){
    echo 'Vous ne pouvez pas réaliser les transactions pour d autres utilisateurs';
    exit();
  }
  else {
    if($_SESSION["date_de_fermeture"]<$_SESSION["date_de_création"]){
        echo "La date de création doit être inférieure à celle de fermeture";
        exit();
    }
}

///////////////////////////////////////

$pseudo_1 = $_SESSION["pseudo"];
//echo $pseudo_1;
$Requete = mysqli_query($link,"SELECT userid FROM user WHERE pseudo = \"$pseudo_1\";");
$result = mysqli_fetch_all($Requete, MYSQLI_ASSOC);

//echo $result[0]["userid"];
$_SESSION["userid"] = $result[0]["userid"];
//echo $_SESSION["userid"];
$user_con = $result[0]["userid"];
//echo $_SESSION["userid"];

                            ///////
// Toutes les relations d'amis en lien avec le user connecté
$Requete_1 = mysqli_query($link,"SELECT * FROM Reach_my_friend WHERE id_username_1 = \"$user_con\" OR id_username_2 = \"$user_con\";");
$result_1 = mysqli_fetch_all($Requete_1, MYSQLI_ASSOC);
//var_dump($result_1);
                            /////////////

if ($_SESSION["pseudo"]){
    $user_check[]=$_SESSION["pseudo"];
    //var_dump($user_check);
}

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
$length=sizeof($user_check);
                        ////////////
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
         <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="../it103/transaction_ami.css">
		 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


		<title> Transaction Groupe </title>

    </head>
    <body>
		<div class="container">
		<div class="row centered-form">
		<div class="col-xs col-sm col-md col-sm-offset col-md-offset">
			<div class="panel panel-default">
				<div class="panel-heading" >
					<h2 class="panel-title">Saisissez les différents montants pour chacun de vos amis</h2>
				</div>
					<div class="panel-body" id="debut">
					<form method="post" action="sum_different_action.php" >
        <div class="form-row">
            <?php for ($i=1; $i <$length ; $i++) { ?>
            <div class="form-group col-md-6">
                <label for="montant[]"> Montant pour <?php echo $user_check[$i];?> </label>
                <input class="form-control input-sm" type="number" name="montant[]">
            </div>
            <?php echo "<br/>";}?>
        </div>
        <input type="submit" value="Ajoutez ces transactions" id="payer">



</body>
</html>
