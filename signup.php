
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
        <link rel="stylesheet" href="../it103/signup_css.css">
		 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


		<title>Inscription </title>

    </head>
    <body>
		<div class="container">
		<div class="row centered-form">
		<div class="col-xs col-sm col-md col-sm-offset col-md-offset">
			<div class="panel panel-default">
				<div class="panel-heading" >
					<h2 class="panel-title">Inscris-toi sur Debster !</h2>
				</div>
					<div class="panel-body" id="debut">
					<form method="post" action="verif_sign.php" >
                        <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="firstname"> Prénom </label>
                                    <input type="text" name="firstname" id="firstname" class="form-control input-sm" placeholder="First name" required>
                                    <div class="valid-feedback">
                                        Complétez l'ensemble des champs
                                    </div>
                                    <div class="invalid-feedback">
                                        Veuillez rentrer votre prénom
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="lastname"> Nom </label>
                                    <input type="text" name="lastname" id="lastname" class="form-control input-sm" placeholder="Last name" required>
                                    <div class="valid-feedback">
                                        Complétez l'ensemble des champs
                                    </div>
                                    <div class="invalid-feedback">
                                        Veuillez rentrer votre nom
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="email">@</span>
                                        </div>
                                        <input type="text" name ="email" class="form-control input-sm" placeholder="Email" required>
                                        <div class="invalid-feedback">
                                            Veuillez rentrer votre email
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="birth"> Date de Naissance </label>
                                <input type="text"  id="birth" name="birth" placeholder="dd/mm/yyyy" class="form-control" required>
								<div class="invalid-feedback">
									Veuillez rentrer votre date de naissance
								</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="username"> Pseudo </label>
                                <input type="text" name="username" class="form-control input-sm" id="username" placeholder="Pseudo">
									<div class="invalid-feedback">
										Veuillez choisir votre pseudo
									</div>
                            </div>
                        </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label"> Mot de Passe </label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Mot de passe">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_check" class="col-sm-2 col-form-label"> Mot de passe à confirmer </label>
                                <div class="col-sm-10">
                                    <input type="password" name="password_check" class="form-control" id="password_check" placeholder="Mot de passe">
                                </div>
                            </div>
                            <input type="submit" value="S'inscrire" id="submit">
						</form>
						</div>
					</div>
				</div>


			</div>
        </div>

        <script>

//source pour le script: https://www.pierre-giraud.com/bootstrap-apprendre-cours/formulaire/

			(function() {
				'use strict';
				window.addEventListener('load', function() {
					// Fetch all the forms we want to apply custom Bootstrap validation styles to
					let forms = document.getElementsByClassName('needs-validation');
					// Loop over them and prevent submission
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
