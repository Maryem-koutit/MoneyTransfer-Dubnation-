<?php
// $ttl = 3600; // Une heure, en secondes
// session_set_cookie_params($ttl);
// ini_set('session.gc_maxlifetime', $ttl);
	include("functions.php");
    session_start();
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
					<h2 class="panel-title">Réalises une transaction simple vers un ami</h2>
				</div>
					<div class="panel-body" id="debut">
					<form method="post" action="transaction_ami_action.php" >
          <div class="form-row">
            <div class="col-md-4 mb-3">
              <label for="utilisateur_source"> Utilisateur source </label>
                <input type="text" name="utilisateur_source" id="utilisateur_source" class="form-control input-sm" placeholder="Rentrez votre pseudo:<?php echo $_SESSION["pseudo"];?>" required>
                  <div class="valid-feedback">
                      Complétez l'ensemble des champs
                  </div>
                  <div class="invalid-feedback">
                      Veuillez rentrer votre pseudo
                  </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="utilisateur_cible"> Utilisateur cible </label>
                <input type="text" name="utilisateur_cible" id="utilisateur_cible" class="form-control input-sm" placeholder="Rentrez le pseudo de votre ami" required>
                  <div class="valid-feedback">
                      Complétez l'ensemble des champs
                  </div>
                  <div class="invalid-feedback">
                      Veuillez rentrer le pseudo de votre ami
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
                <label for="Montant">Montant</label>
                <input type="number" class="form-control" id="Montant" name="Montant" placeholder="Montant >0" required>
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
                <label for="date_de_fermeture">Date recommandée pour une fermeture</label>
                <input type="date" class="form-control" id="date_de_fermeture" name="date_de_fermeture" placeholder="Rentrez la date recommandée pour la fermeture" required>
                <div class="valid-feedback">Ok !</div>
                <div class="invalid-feedback">Valeur incorrecte</div>
            </div>
            <input type="submit" value="Saisir la transaction" id="payer">
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
