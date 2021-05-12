<?php
function con(){
  echo "test";
  $con =  mysqli_connect('localhost', 'admin', 'it103','Dubnation');
  echo $con;
  if ($con){
    echo " connexion au site";
  }
  mysqli_set_charset($con, "utf8");
  return $con;
}

//Fct qui ajoute un utilisateur après inscription
function addUser($first_name, $last_name, $email, $password, $birthday, $pseudo,$link) {
  $stmt = mysqli_prepare($link, "INSERT INTO user (first_name, last_name, email, password, birthday, pseudo) VALUES (?,?,?,?,?,?)");
  mysqli_stmt_bind_param($stmt, 'ssssss', $first_name, $last_name, $email, $password, $birthday, $pseudo);
  mysqli_stmt_execute($stmt);
  printf("%d ligne insérée.\n", mysqli_stmt_affected_rows($stmt));
  printf("Erreur : %s.\n", mysqli_stmt_error($stmt));
  $id_final = mysqli_insert_id($link);
  mysqli_close($link);
  return $id_final;
}


//Fct qui check si l'email est déjà utilisée
function checkSignMail($email,$link){
  $Requete = mysqli_query($link,"SELECT * FROM user WHERE email = \"$email\";");
  $result = mysqli_fetch_all($Requete, MYSQLI_ASSOC);
  if (!$result) {
    echo "Email Validé";
  }
  else{
    echo "Email déjà utilisé, veuillez-le changer";
    exit();
  }

}




//Fct qui check si le pseudo est déjà utilisé
function checkSignPseudo($pseudo,$link){
  $Requete = mysqli_query($link,"SELECT * FROM user WHERE pseudo = \"$pseudo\";");
  $result = mysqli_fetch_all($Requete, MYSQLI_ASSOC);
  if (!$result) {
    echo "Pseudo Validé";
  }
  else{
    echo "Pseudo déjà utilisé, veuillez-le changer";
    exit();
  }

}



//fct qui verifie la correspondance pseudo-mot de Passe
function checkPassword($pseudo,$password,$link){
  $Requete = mysqli_query($link,"SELECT * FROM user WHERE pseudo = \"$pseudo\";");
  // echo "SELECT * FROM user WHERE pseudo = \"$pseudo\";";
  $result = mysqli_fetch_all($Requete, MYSQLI_ASSOC);
  // var_dump($result);
  // while ($row = mysqli_fetch_row($Requete)) {
  //       printf ("%s (%s)\n", $row[0], $row[1]);
  //   }

  if (!$result) {
     echo "L'utilisateur est incorrect.";
     exit();
} else {
	 $hash = $result[0]["password"];
   // echo $hash;
   //echo $password;

	if ($password == $hash) {
		echo "Connexion réussie";
	} else {
    echo "Le mot de passe est incorrect.";
    exit();
	}

}
}


//fct qui ajoute une relation d'amitié
function addfriendship($id_user,$id_friend,$link){
  $stmt = mysqli_prepare($link, "INSERT INTO Reach_my_friend (id_username_1, id_username_2) VALUES (?,?)");
  mysqli_stmt_bind_param($stmt, 'ii', $id_user,$id_friend);
  mysqli_stmt_execute($stmt);
  printf("%d ligne insérée.\n", mysqli_stmt_affected_rows($stmt));
  printf("Erreur : %s.\n", mysqli_stmt_error($stmt));
  mysqli_close($link);
}

//fct qui supprime une relation d'amitié
function delete_friendship($id_user,$id_friend,$link){
  //echo "zac";
  $Requete = mysqli_query($link, "DELETE FROM Reach_my_friend  WHERE id_username_1 = \"$id_user\" AND id_username_2 = \"$id_friend\" OR id_username_1 = \"$id_friend\" AND id_username_2 = \"$id_user\" ;");
  $result = mysqli_fetch_all($Requete, MYSQLI_ASSOC);
  //var_dump($result);
  mysqli_close($link);
}

//Fct qui ajoute une transaction
function addtransaction($id_user_dept, $id_user_waiting, $statut, $date_de_creation, $message_explicatif, $date_de_fermeture,$message_de_fermeture,$sum,$link) {
  $stmt = mysqli_prepare($link, "INSERT INTO Transaction_Ami (id_user_dept, id_user_waiting, statut, date_de_creation, message_explicatif, date_de_fermeture, message_de_fermeture, sum) VALUES (?,?,?,?,?,?,?,?)");
  mysqli_stmt_bind_param($stmt, 'iisssssi', $id_user_dept, $id_user_waiting, $statut, $date_de_creation, $message_explicatif, $date_de_fermeture,$message_de_fermeture,$sum);
  mysqli_stmt_execute($stmt);
  printf("%d ligne insérée.\n", mysqli_stmt_affected_rows($stmt));
  printf("Erreur : %s.\n", mysqli_stmt_error($stmt));
  $id_final = mysqli_insert_id($link);
  mysqli_close($link);
  return $id_final;
}

//Fct qui ajoute une transaction de groupe
function addtransactiongroup($id_user_dept, $id_user_waiting, $statut, $date_de_creation, $message_explicatif, $date_de_fermeture,$message_de_fermeture,$sum,$link) {
  $stmt = mysqli_prepare($link, "INSERT INTO Transaction_Ami (id_user_dept, id_user_waiting, statut, date_de_creation, message_explicatif, date_de_fermeture, message_de_fermeture, sum) VALUES (?,?,?,?,?,?,?,?)");
  mysqli_stmt_bind_param($stmt, 'iisssssi', $id_user_dept, $id_user_waiting, $statut, $date_de_creation, $message_explicatif, $date_de_fermeture,$message_de_fermeture,$sum);
  mysqli_stmt_execute($stmt);
  printf("%d ligne insérée.\n", mysqli_stmt_affected_rows($stmt));
  printf("Erreur : %s.\n", mysqli_stmt_error($stmt));
  $id_final = mysqli_insert_id($link);
  //mysqli_close($link);
  return $id_final;
}

function UpdateTrans($link,$idtrans,$new_message,$new_montant){
  //echo $idtrans;
  //echo $new_message;
  //echo $new_montant;
  $Requete = mysqli_query($link,"SELECT * FROM Transaction_Ami WHERE id = \"$idtrans\";");
  $result = mysqli_fetch_all($Requete, MYSQLI_ASSOC);
  if (!$result) {
     echo "Le numéro de transaction est incorrect";
     exit();
   }
  if ($result[0]["statut"]=="closed" || $result[0]["statut"]=="canceled"){
    echo "Vous ne pouvez pas modifier une transaction fermée ou annulée";
    exit();
  }


  $sql="UPDATE Transaction_Ami SET message_explicatif= \"$new_message\" , sum = \"$new_montant\" WHERE id = \"$idtrans\"";
  mysqli_query($link,$sql);
  echo "Modification effectuée";



  //if (mysqli_query($link, $sql)) {
  //echo "Record updated successfully";
//} else {
  //echo "Error updating record: "
//}
}

function AnnulTrans($link,$idtrans,$mess_fermeture,$date_fermeture){
  //echo $idtrans;
  //echo $mess_fermeture;
  $Requete = mysqli_query($link,"SELECT * FROM Transaction_Ami WHERE id = \"$idtrans\";");
  $result = mysqli_fetch_all($Requete, MYSQLI_ASSOC);
  if (!$result) {
     echo "Le numéro de transaction est incorrect";
     exit();
   }
  if ($result[0]["statut"]=="closed" || $result[0]["statut"]=="canceled"){
    echo "Vous ne pouvez pas annuler une transaction déjà fermée ou annulée";
    exit();
  }
  
  if ($result[0]["date_de_creation"]>$date_fermeture){
    echo "La date de création doit être inférieure à la date de fermeture";
    exit();
  }


  $sql="UPDATE Transaction_Ami SET message_de_fermeture= \"$mess_fermeture\" , statut = 'canceled' WHERE id = \"$idtrans\"";
  mysqli_query($link,$sql);
  $sql_bis="UPDATE Transaction_Ami SET date_de_fermeture= \"$date_fermeture\" , statut = 'canceled' WHERE id = \"$idtrans\"";
  mysqli_query($link,$sql_bis);
  echo "Annulation effectuée";



  //if (mysqli_query($link, $sql)) {
  //echo "Record updated successfully";
//} else {
  //echo "Error updating record: "
//}


}

function FermeTrans($link,$idtrans,$mess_fermeture,$date_fermeture){
  //echo $idtrans;
  //echo $mess_fermeture;
  $Requete = mysqli_query($link,"SELECT * FROM Transaction_Ami WHERE id = \"$idtrans\";");
  $result = mysqli_fetch_all($Requete, MYSQLI_ASSOC);
  if (!$result) {
     echo "Le numéro de transaction est incorrect";
     exit();
   }
  if ($result[0]["statut"]=="closed" || $result[0]["statut"]=="canceled"){
    echo "Vous ne pouvez pas fermer une transaction déjà fermée ou annulée";
    exit();
  }
  if ($result[0]["date_de_creation"]>$date_fermeture){
    echo "La date de création doit être inférieure à la date de fermeture";
    exit();
  }


  $sql="UPDATE Transaction_Ami SET message_de_fermeture= \"$mess_fermeture\" , statut = 'closed' WHERE id = \"$idtrans\"";
  mysqli_query($link,$sql);
  $sql_bis="UPDATE Transaction_Ami SET date_de_fermeture= \"$date_fermeture\" , statut = 'closed' WHERE id = \"$idtrans\"";
  mysqli_query($link,$sql_bis);
  echo "Fermeture effectuée";



  //if (mysqli_query($link, $sql)) {
  //echo "Record updated successfully";
//} else {
  //echo "Error updating record: "
//}


}
