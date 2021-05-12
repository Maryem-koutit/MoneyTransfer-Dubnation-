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
</head>

<form method="post" action="verif.php">
<body>

<title> Connexion </title>
<h1> Connecte-toi sur Debster !</h1>
<p>
    Votre pseudo :<br />
    <input id='pseudo' type="text" name="pseudo"/><br />

    votre mot de passe :<br />
    <input id='password' type="password" name="password"/><br />

    <input type="submit" value="Connexion"/><a href="deconnect.php" target="_blank"> <input type="button" value="Déconnexion"> </a>


</p>

<p class="box-register">Vous êtes nouveau ici? <a href="signup.php">S'inscrire</a></p>



</form>




</body>
</html>
