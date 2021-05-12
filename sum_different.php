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
echo 'Connected successfully';

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
// var_dump($user_check);
// echo $user_check[2];
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


		<title> Transaction </title>

    </head>
    <body>
		<div class="container">
		<div class="row centered-form">
		<div class="col-xs col-sm col-md col-sm-offset col-md-offset">
			<div class="panel panel-default">
				<div class="panel-heading" >
					<h2 class="panel-title">Réalises une transaction de groupe avec des montants différents</h2>
				</div>
					<div class="panel-body" id="debut">
					<form method="post" action="sum_different_link.php" >
          <div class="form-row">
            <div class="col-md-4 mb-3">
              <label for="utilisateur_source"> Utilisateur source </label>
                <input type="text" name="utilisateur_source" id="utilisateur_source" class="form-control input-sm" placeholder="Rentrez votre pseudo: <?php echo $_SESSION["pseudo"];?>" required>
                  <div class="valid-feedback">
                      Complétez l'ensemble des champs
                  </div>
                  <div class="invalid-feedback">
                      Veuillez rentrer votre pseudo
                  </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="Message_Explicatif">Contexte</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="email"></span>
                  </div>
                  <input type="text" name ="Message_Explicatif" class="form-control input-sm" placeholder="Contexte" required>
                  <div class="invalid-feedback">
                      Veuillez rentrer le contexte de cette transaction
                  </div>
                </div>
                </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="date_de_création"> Date ayant donné lieu à la transaction </label>
                <input class="form-control input-sm" type="date" name="date_de_création">
                <div class="invalid-feedback">
					Veuillez rentrer la date de la transaction
				</div>
            </div>
            </div>
            <div class="form-row">
              <label for="Statut">Statut </label>
                <select class="form-group" id="Statut" name="Statut">
                    <option value="opened">Ouvert</option>
                    <option value="closed">Remboursé</option>
                    <option value="canceled">Annulé</option>
                </select>
              <div class="valid-feedback">Ok !</div>
              <div class="invalid-feedback">Valeur incorrecte</div>
            </div>
            <div class="form-row">
                <label for="Message_de_fermeture">Message recommandé pour la fermeture</label>
                <input type="text" class="form-control" id="Message_de_fermeture" name="Message_de_fermeture" placeholder="Merci <?php echo $_SESSION["pseudo"];?>" required>
                <div class="valid-feedback">Ok !</div>
                <div class="invalid-feedback">Valeur incorrecte</div>
            </div>
            <div class="form-row">
                <label for="date_de_fermeture">Date recommandée pour la fermeture</label>
                <input type="date" class="form-control" id="date_de_fermeture" name="date_de_fermeture" placeholder="Rentrez la date recommandée pour la fermeture" required>
                <div class="valid-feedback">Ok !</div>
                <div class="invalid-feedback">Valeur incorrecte</div>
            </div>
            <div class="form-row">
            <label for="utilisateur_cible[]"> Utilisateurs cibles </label>
                <div class="form-check">
                <?php for ($i=1; $i <$length ; $i++) { ?>
                    <input class="form-check-input" type="checkbox" name="utilisateur_cible[]" id="utilisateur_cible" value="<?php echo $user_check[$i];?>">
                    <label class="form-check-label" for="utilisateur_cible">
                        <?php echo $user_check[$i]; ?>
                        <?php echo "<br/>";} ?>
                    </label>
                </div>
            </div>
            <input type="submit" value="Saisir les différents montants" id="payer">
          </form>
         </div>
         </div>
         </div>
         </div>
         </div>
         </div>
         <script>
           /*La fonction principale de ce script est d'empêcher l'envoi du formulaire si un champ a été mal rempli
            *et d'appliquer les styles de validation aux différents éléments de formulaire*/
           (function() {
             'use strict';
             window.addEventListener('load', function() {
               let forms = document.getElementsByClassName('needs-validation');
               let validation = Array.prototype.filter.call(forms, function(form) {
                 form.addEventListener('submit', function(event) {
                   if (form.checkValidity() === false) {
                     event.preventDefault();
                     event.stopPropagation();
                   }
                   form.classList.add('was-validated');
                 }, false);
               });
             }, false);
           })();
         </script>
      </body>

      </html>
