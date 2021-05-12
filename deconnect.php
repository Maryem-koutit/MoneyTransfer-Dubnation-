<?php
session_start();
//session_destroy();
include("login.php");
session_unset();
//include("index.php");


  // Détruire la session.
  if (session_unset())
  {
    // Redirection vers la page de connexion
    header("Location: login.php");
  }
?>
