<?php
// $ttl = 3600; // Une heure, en secondes
// session_set_cookie_params($ttl);
// ini_set('session.gc_maxlifetime', $ttl);
	include("functions.php");
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	 <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="../it103/rest_files.css">

	<body>
		<title> Statut de votre transaction </title>

<?php
$link = mysqli_connect('localhost', 'admin', 'it103','Dubnation');
if (!$link) {
		echo "Probleme de connexion";
		die('Could not connect: ' . mysqli_error());
}
echo 'Connected successfully ';

if (($_POST["utilisateur_source"])!=$_SESSION["pseudo"]){
  echo 'Vous ne pouvez pas réaliser les transactions pour d autres utilisateurs';
  exit();
}
else {
  if($_POST["date_de_fermeture"]<$_POST["date_de_création"]){
      echo "La date de création doit être inférieure à celle de fermeture";
      exit();
  }
  else{
    if($_POST["Montant"]<=0){
      echo "Le montant doit être positif";
      exit();
  }
}
}

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
$length=sizeof($user_check)-1;
// echo $length;
// echo $_POST["montant"][1];


$friend_to_transaction = $_POST["utilisateur_cible"][0];
//echo $friend_to_transaction;
$Requete_4 = mysqli_query($link,"SELECT userid FROM user WHERE pseudo = \"$friend_to_transaction\";");
$result_4 = mysqli_fetch_all($Requete_4, MYSQLI_ASSOC);
//var_dump($result_4);
//echo $result_4[0]["userid"];
$id_friends[]=$result_4[0]["userid"];
//var_dump($id_friends);
//var_dump($_SESSION);
//var_dump($_POST);
for ($i=1; $i <$length ; $i++) {
    $friend_group = $_POST["utilisateur_cible"][$i];
    //var_dump($friend_group);
    $Requete_5 = mysqli_query($link,"SELECT userid FROM user WHERE pseudo = \"$friend_group\";");
    $result_5 = mysqli_fetch_all($Requete_5, MYSQLI_ASSOC);
    //var_dump($result_5[0]["userid"]);
    $id_friends[]=$result_5[0]["userid"];
}

//var_dump($id_friends);


for ($i=0; $i <$length ; $i++) {
      //echo $id_friends[$i];
      addtransactiongroup($_SESSION["userid"], $id_friends[$i], $_POST["Statut"], $_POST["date_de_création"], $_POST["Message_Explicatif"], $_POST["date_de_fermeture"],$_POST["Message_de_fermeture"],$_POST["Montant"],$link);
}
?>

<form method="link" action="myprofile.php"> <input type="submit" value="Retour à l'accueil" id="submit"> </form>
</body>
</html>
