<?php
include("functions.php");

$qDb = "CREATE DATABASE IF NOT EXISTS `Dubnation`;";

$qSelDb = "USE `Dubnation`;";

$qTbUsers = "CREATE TABLE IF NOT EXISTS `user` (
    `userid` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `first_name` varchar(55)  NOT NULL,
    `last_name` varchar(55) NOT NULL,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `birthday` date NOT NULL,
    `pseudo`varchar(255) NOT NULL,
    PRIMARY KEY (`userid`)
    );";


  $insertUsers = "INSERT INTO `user` (`userid`, `first_name`,`last_name`,`email`, `password`, `birthday`,`pseudo`) VALUES
  (1, 'Jean','Nowomansky','jnowo@gmail.com', 'Bordeaux13', '1999-03-10','Jnowomanski'),
  (2, 'Marie','Mallard','mlala@gmail.com', 'MarieParis', '1990-01-22','Mmallard'),
  (3, 'Pierre','Christophe','pc@gmail.com', 'Toulon83', '2004-09-15','PilouRCT');";




$qTbFriends = "CREATE TABLE IF NOT EXISTS `Reach_my_friend`(
    `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_username_1` int(20) UNSIGNED NOT NULL ,
    `id_username_2` int(20) UNSIGNED NOT NULL ,
    PRIMARY KEY (id),
    FOREIGN KEY (id_username_1) REFERENCES user (userid),
    FOREIGN KEY (id_username_2) REFERENCES user (userid)
    );";

$insertFriends = "INSERT INTO `Reach_my_friend` (`id`,`id_username_1`,`id_username_2`) VALUES
  (1, 1, 2),
  (2, 1, 3),
  (3, 2, 3);";

$qTbTransaction = "CREATE TABLE IF NOT EXISTS `Transaction_Ami`(
    `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_user_dept` int(20) UNSIGNED  NOT NULL,
    `id_user_waiting` int(20) UNSIGNED NOT NULL,
    `statut` enum('opened','closed','canceled') COLLATE ascii_bin NOT NULL DEFAULT 'opened',
    `date_de_creation` date NOT NULL,
    `message_explicatif` varchar(256) DEFAULT NULL,
    `date_de_fermeture` date NOT NULL,
    `message_de_fermeture` varchar(256) DEFAULT NULL,
    `sum` int(20) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_user_dept) REFERENCES user (userid),
    FOREIGN KEY (id_user_waiting) REFERENCES user (userid)
  );";

$insertTransactions = "INSERT INTO `Transaction_Ami` (`id`, `id_user_dept`, `id_user_waiting`, `statut`, `date_de_creation`,`message_explicatif`,`date_de_fermeture`,`message_de_fermeture`, `sum`) VALUES
  (1, 1, 2, 'opened', '2020-01-02', 'Vodka à Varsovie','2020-02-03','Merci pour le remboursement', 21),
  (2, 1, 2, 'opened', '2020-04-04', 'Kangourou à Sydney','2020-05-05','Merci pour le remboursement', 15),
  (3, 1, 2, 'closed', '2018-01-07', 'Pool-Party bebeww','2020-08-02','Merci pour le remboursement', 100),
  (4, 1, 2, 'canceled', '2019-09-08', 'Vins rouges de Bordeaux','2020-01-05','Merci pour le remboursement', 50),
  (5, 2, 1, 'opened', '2020-05-06', 'Avions pour Malte','2020-06-07','Merci pour le remboursement', 75),
  (6, 2, 3, 'closed', '2020-08-03', 'Turn-up à Cannes','2020-09-09','Merci pour le remboursement', 150);";


echo "Connexion au serveur MySQL.";

$con = mysqli_connect('localhost', 'admin', 'it103');
mysqli_set_charset($con, "utf8");


echo "création de la db";
mysqli_query($con, $qDb);
echo mysqli_info($con);
echo mysqli_error($con);

mysqli_query($con, $qSelDb);
echo mysqli_info($con);
echo mysqli_error($con);



echo "Création de la table Transaction Ami";
mysqli_query($con, $qTbUsers);
echo mysqli_info($con);
echo mysqli_error($con);

echo "insert users in database";
mysqli_query($con, $insertUsers);
echo mysqli_info($con);
echo mysqli_error($con);

echo "Création de la table Reach_my_friend.";
mysqli_query($con, $qTbFriends);
echo mysqli_info($con);
echo mysqli_error($con);


echo "insert friends";
mysqli_query($con, $insertFriends);
echo mysqli_info($con);
echo mysqli_error($con);

echo "Création de la table Transactions.";
mysqli_query($con, $qTbTransaction);
echo mysqli_info($con);
echo mysqli_error($con);

echo "insert Transactions";
mysqli_query($con, $insertTransactions);
echo mysqli_info($con);
echo mysqli_error($con);


mysqli_close($con);
?>
