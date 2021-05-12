<?php
// $ttl = 3600; // Une heure, en secondes
// session_set_cookie_params($ttl);
// ini_set('session.gc_maxlifetime', $ttl);
  include("login.php");
    session_start();
?>

<?php
$link = mysqli_connect('localhost', 'admin', 'it103','Dubnation');
if (!$link) {
		echo "ca marche po";
		die('Could not connect: ' . mysqli_error());
}
echo 'Connected successfully';

if (empty($_POST["pseudo"]) || empty($_POST["password"])){
    echo "champs pas remplis";
    exit();
	}

		elseif (isset($_POST["pseudo"]) && isset($_POST["password"])) {
				 $pseudo=$_POST["pseudo"];
				 $password=$_POST["password"];
				 //echo $pseudo;
				 //echo $password;
				 checkPassword($pseudo,$password,$link);
		}

$_SESSION["pseudo"]=$_POST["pseudo"];
//echo $_SESSION["pseudo"];

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
         <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="../it103/rest_files.css">
		 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<form method="link" action="myprofile.php"> <input type="submit" value="Continuez vers votre profil!" id="submit"> </form>
    </head>
    </html>
