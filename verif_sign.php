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
if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password_check"]) && isset($_POST["birth"]) ){


    if (empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]) || empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["password_check"]) || empty($_POST["birth"]) ){
		echo 'L INSCRIPTION A ÉCHOUÉ: Tous les champs ne sont pas remplis ';
    }
    $condition=0;

        if (empty($_POST["username"])){
            echo 'Remplissez le champ Pseudo ';
        }
        else {
            checkSignPseudo($_POST["username"],$link);
            $condition+=1;
            echo $condition;
        }

    	if (empty($_POST["email"])){
            echo 'Remplissez le champ Email';
        }
        else {
            checkSignMail($_POST["email"],$link);
            $condition+=1;
            echo $condition;
            }

    	if ($_POST["password"]!=$_POST["password_check"] || empty($_POST["password"]) || strlen($_POST["firstname"])<2 || strlen($_POST["lastname"])<2){
            echo 'Vos prénoms et noms ont-ils plus de deux caractères ?';
            echo 'ERREUR: Merci de bien confirmer votre mot de passe ';
        }
        else{
            $condition+=1;
            echo 'Mot de passe validé';
            echo $condition;
        }

        // Change date format
        $Date = $_POST['birth'];
        $newDate = implode('-', array_reverse (explode('/',$Date)));

        if ($condition==3)
        {
            echo 'L INCRIPTION EST RÉUSSIE: Continuez Vers la connexion';
            $user_id=addUser($_POST["firstname"],$_POST["lastname"],$_POST["email"],crypt($_POST["password"]),$newDate,$_POST["username"],$link);
			// $_SESSION["userid"]=$user_id;
			// $_SESSION["first_name"]=$_POST["firstname"];
			// $_SESSION["last_name"]=$_POST["lastname"];
			// $_SESSION["email"]=$_POST["email"];
			// $_SESSION["birthday"]=$_POST["birth"];
			// $_SESSION["pseudo"]=$_POST["username"];
			// $_SESSION["password"]=$_POST["password"];
		}

	//}
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
         <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="../it103/signup_css.css">
		 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<form method="link" action="login.php"> <input type="submit" value="Continuez !" id="submit"> </form>
    </head>
    </html>
