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


?>

<!DOCTYPE html>
<html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/inter_historique.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body>
	<title> Historique de vos transactions </title>
    <h2> Consultez vos transactions avec un ami </h2>

    <div class="panel-body">
		<form method="post" action="historique.php" >
            <div class="form-row">
                <div class="col-md-4 mb-3" id="ajout">
                    <label for="friends_transaction"> Rentrer le pseudo de l'ami dont vous voulez consulter les transactions </label>
                    <input type="text" name="friends_transaction" id="friends_transaction" class="form-control input-sm" placeholder="Pseudo" required>
                </div>
            </div>
                <input class="btn btn-primary btn-sm" type="submit" value="Voir l'ensemble des transactions" id="submit">
        </form>
        <form method="post" action="historique_2.php" >
            <div class="form-row">
                <div class="col-md-4 mb-3" id="ajout">
                        <label for="friends_transaction"> Rentrer le pseudo de l'ami dont vous voulez consulter les transactions </label>
                        <input type="text" name="friends_transaction_alive" id="friends_transaction_alive" class="form-control input-sm" placeholder="Pseudo" required>
                </div>
            </div>
                <input class="btn btn-primary btn-sm" type="submit" value="Voir seulement les transactions ouvertes" id="submit">

        </form>
        </div>










</body>
</html>
