<?php
  include ("FormFermeture.php");
//include ("functions.php");
// $ttl = 3600; // Une heure, en secondes
// session_set_cookie_params($ttl);
// ini_set('session.gc_maxlifetime', $ttl);
session_start();
?>


<?php
$link = mysqli_connect('localhost', 'admin', 'it103','Dubnation');

if (isset($_POST["remboursement"])){
  //echo "rem";

  if (isset($_POST["MessFerm"])){
    $Mf=$_POST["MessFerm"];
    //echo $Mf;
  }

  if (isset($_POST["DateFerm"])){
    $Df=$_POST["DateFerm"];
  }


  if (isset($_POST["Tr1"]) && ($_POST["Tr1"]>0)){
    $Tr1=$_POST["Tr1"];
    //echo $Tr1;
    FermeTrans($link,$Tr1,$Mf,$Df);
  }

  if (isset($_POST["Tr2"]) && ($_POST["Tr2"]>0)){
    $Tr2=$_POST["Tr2"];
    //echo $Tr2;
    FermeTrans($link,$Tr2,$Mf,$Df);
  }

  if (isset($_POST["Tr3"]) && ($_POST["Tr3"]>0)){
    $Tr3=$_POST["Tr3"];
    //echo $Tr3;
    FermeTrans($link,$Tr3,$Mf,$Df);
  }

  if (isset($_POST["Tr4"]) && ($_POST["Tr4"]>0)){
    $Tr4=$_POST["Tr4"];
    //echo $Tr4;
    FermeTrans($link,$Tr4,$Mf,$Df);
  }

  if (isset($_POST["Tr5"]) && ($_POST["Tr5"]>0)){
    $Tr5=$_POST["Tr5"];
    //echo $Tr5;
    FermeTrans($link,$Tr5,$Mf,$Df);
  }

}

if (isset($_POST["annulation"])){
  //echo "ann";

  if (isset($_POST["MessFerm"])){
    $Mf=$_POST["MessFerm"];
    //echo $Mf;
  }

  if (isset($_POST["DateFerm"])){
    $Df=$_POST["DateFerm"];
  }

  if (isset($_POST["Tr1"]) && ($_POST["Tr1"]>0)){
    $Tr1=$_POST["Tr1"];
    //echo $Tr1;
    AnnulTrans($link,$Tr1,$Mf,$Df);
  }

  if (isset($_POST["Tr2"]) && ($_POST["Tr2"]>0)){
    $Tr2=$_POST["Tr2"];
    //echo $Tr2;
    AnnulTrans($link,$Tr2,$Mf,$Df);
  }

  if (isset($_POST["Tr3"]) && ($_POST["Tr3"]>0)){
    $Tr3=$_POST["Tr3"];
    //echo $Tr3;
    AnnulTrans($link,$Tr3,$Mf,$Df);
  }

  if (isset($_POST["Tr4"]) && ($_POST["Tr4"]>0)){
    $Tr4=$_POST["Tr4"];
    //echo $Tr4;
    AnnulTrans($link,$Tr4,$Mf,$Df);
  }

  if (isset($_POST["Tr5"]) && ($_POST["Tr5"]>0)){
    $Tr5=$_POST["Tr5"];
    //echo $Tr5;
    AnnulTrans($link,$Tr5,$Mf,$Df);
  }


}



?>
