<?php
// $ttl = 3600; // Une heure, en secondes
// session_set_cookie_params($ttl);
// ini_set('session.gc_maxlifetime', $ttl);
include ("modif.php");
//include ("functions.php");
session_start();
?>


<?php
$link = mysqli_connect('localhost', 'admin', 'it103','Dubnation');

if (empty($_POST["idtrans"]) || empty($_POST["mess_explicatif"]) || empty($_POST["newmontant"])){
    echo "Champs non remplis";
	}

	 elseif (isset($_POST["idtrans"]) && isset($_POST["mess_explicatif"]) && isset($_POST["newmontant"])) {
         //echo "Modifi";
		 $new_message=$_POST["mess_explicatif"];
		 $new_montant=$_POST["newmontant"];
         $idtrans=$_POST["idtrans"];
         UpdateTrans($link,$idtrans,$new_message,$new_montant);
       }

  ?>

  <form method="link" action="myprofile.php"> <input type="submit" value="Retour à l'accueil" id="submit"> </form>
      </head>
      </html>
