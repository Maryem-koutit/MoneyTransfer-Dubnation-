<?php
  // $ttl = 3600; // Une heure, en secondes
  // session_set_cookie_params($ttl);
  // ini_set('session.gc_maxlifetime', $ttl);
  include ("functions.php");
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	 <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="../it103/modif.css">
  </head>
  <body>

  <?php

$link = mysqli_connect('localhost', 'admin', 'it103','Dubnation');
if (!$link) {
		echo "Probleme de connexion";
		die('Could not connect: ' . mysqli_error());
}
echo 'Connected successfully ';
echo "<br/>";

// $_SESSION["friends_transaction"]=$_POST["friends_transaction"];
$friends_transaction = $_SESSION["friends_transaction"];
$requete0 = mysqli_query($link,"SELECT userid FROM user WHERE pseudo = \"$friends_transaction\";");
$result0 = mysqli_fetch_all($requete0, MYSQLI_ASSOC);

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
      $user_check[]=$result_3[0]["pseudo"];
  }
}
// echo $_SESSION["friends_transaction"];
// echo $user_check;
if (!(in_array($_SESSION["friends_transaction"],$user_check))) {
  echo "Le peudo rentré n'est pas votre ami";
}
else{
  // Toutes les transaction ou le user est concerné
  $requete_1 = mysqli_query($link,"SELECT * FROM Transaction_Ami WHERE  id_user_dept = \"$user_con\" OR id_user_waiting = \"$user_con\" ORDER BY date_de_creation DESC;");
  $result1 = mysqli_fetch_all($requete_1, MYSQLI_ASSOC);
  //echo $result1[4]["id_user_waiting"];
  //var_dump($result1);
  //echo $user_con;
  $id_friends_transaction = $result0[0]["userid"];
  ?> <div id="gauche"> <?php
  for ($i=0; $i <sizeof($result1) ; $i++) {
      if ($result1[$i]["statut"] != 'opened') {?>
          <div id="exigence">
          <?php
          if ($result1[$i]["id_user_dept"] == $user_con && $result1[$i]["id_user_waiting"] == $id_friends_transaction) {
              ?> <div id="Red"><?php echo "Transaction N°"; echo '&nbsp'; echo $result1[$i]["id"];?></div><?php echo '&nbsp';
              echo "DATE:"; echo '&nbsp'; echo $result1[$i]["date_de_creation"]; echo '&nbsp';
              echo "CONTEXTE:"; echo '&nbsp'; echo $result1[$i]["message_explicatif"]; echo '&nbsp';
              $useridfriend = $result1[$i]["id_user_waiting"];
              $requete2 = mysqli_query($link,"SELECT pseudo FROM user WHERE userid = \"$useridfriend\";");
              $result2 = mysqli_fetch_all($requete2, MYSQLI_ASSOC);
              echo "DONC:"; echo '&nbsp'; echo "Tu dois:"; echo '&nbsp';
              ?> <div id="Red"><?php echo $result1[$i]["sum"]; echo '&nbsp'; echo "€"; echo '&nbsp';?></div><?php
              echo "à"; echo '&nbsp';echo $result2[0]["pseudo"];
              echo "<br/>";
          }
          if ($result1[$i]["id_user_waiting"] == $_SESSION["userid"] && $result1[$i]["id_user_dept"] == $id_friends_transaction) {
              ?> <div id="Green"><?php echo "Transaction N°"; echo '&nbsp'; echo $result1[$i]["id"];?></div><?php echo '&nbsp';
              echo "DATE:"; echo '&nbsp'; echo $result1[$i]["date_de_creation"]; echo '&nbsp';
              echo "CONTEXTE:"; echo '&nbsp'; echo $result1[$i]["message_explicatif"]; echo '&nbsp';
              $useridfriend = $result1[$i]["id_user_dept"];
              $requete2 = mysqli_query($link,"SELECT pseudo FROM user WHERE userid = \"$useridfriend\";");
              $result2 = mysqli_fetch_all($requete2, MYSQLI_ASSOC);
              //var_dump($result2);
              echo "DONC:"; echo '&nbsp'; echo $result2[0]["pseudo"]; echo '&nbsp'; echo "te dois:"; echo '&nbsp';
              ?> <div id="Green"><?php echo $result1[$i]["sum"]; echo '&nbsp'; echo "€"; echo '&nbsp';?></div><?php
          } ?>
  </div><?php
      echo "<br/>";
  }
      else{
          if ($result1[$i]["id_user_dept"] == $user_con && $result1[$i]["id_user_waiting"] == $id_friends_transaction) {
              ?> <div id="Red"><?php echo "Transaction N°"; echo '&nbsp'; echo $result1[$i]["id"];?></div><?php echo '&nbsp';
              echo "DATE:"; echo '&nbsp'; echo $result1[$i]["date_de_creation"]; echo '&nbsp';
              echo "CONTEXTE:"; echo '&nbsp'; echo $result1[$i]["message_explicatif"]; echo '&nbsp';
              $useridfriend = $result1[$i]["id_user_waiting"];
              $requete2 = mysqli_query($link,"SELECT pseudo FROM user WHERE userid = \"$useridfriend\";");
              $result2 = mysqli_fetch_all($requete2, MYSQLI_ASSOC);
              echo "DONC:"; echo '&nbsp'; echo "Tu dois:"; echo '&nbsp';
              ?> <div id="Red"><?php echo $result1[$i]["sum"]; echo '&nbsp'; echo "€"; echo '&nbsp';?></div><?php
              echo "à"; echo '&nbsp';echo $result2[0]["pseudo"];
              echo "<br/>";
          }
          if ($result1[$i]["id_user_waiting"] == $_SESSION["userid"] && $result1[$i]["id_user_dept"] == $id_friends_transaction) {
              ?> <div id="Green"><?php echo "Transaction N°";echo '&nbsp'; echo $result1[$i]["id"];?></div><?php echo '&nbsp';
              echo "DATE:"; echo '&nbsp'; echo $result1[$i]["date_de_creation"]; echo '&nbsp';
              echo "CONTEXTE:"; echo '&nbsp'; echo $result1[$i]["message_explicatif"]; echo '&nbsp';
              $useridfriend = $result1[$i]["id_user_dept"];
              $requete2 = mysqli_query($link,"SELECT pseudo FROM user WHERE userid = \"$useridfriend\";");
              $result2 = mysqli_fetch_all($requete2, MYSQLI_ASSOC);
              //var_dump($result2);
              echo "DONC:"; echo '&nbsp'; echo $result2[0]["pseudo"]; echo '&nbsp'; echo "te dois:"; echo '&nbsp';
              ?> <div id="Green"><?php echo $result1[$i]["sum"]; echo '&nbsp'; echo "€"; echo '&nbsp';?></div><?php

          }

      }
  }
  ?> </div> <?php
  }
?>

  <form method="post" action="modif2.php">
  <title> Modifier une transaction </title>
  <h1> Modifier une transaction </h1>
  <p>
      Numéro de la transaction :<br />
      <input id='idtrans' type="number" name="idtrans"/><br />

      Message Explicatif :<br />
      <input id='mess_explicatif' type="text" name="mess_explicatif" /><br />

      Montant : <br />
      <input id='newmontant' type ="number" name="newmontant" /><br/>

      <input type="submit" id="submit" value="Modifier"/>


  </p>
  </form>

  </body>
  </html>
