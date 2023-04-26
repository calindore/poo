<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tp Final</title>
</head>
<body>
  <form action="profil.php" method="post">
    <input type="email" name="email" placeholder="email">
    <input type="password" name="password" placeholder="password">
    <button type="submit">envoyer</button>
  </form>
  <a href="inscription.php">Inscription</a>
</body>
</html>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("bdd.php");
require_once("user.php");
if (count($_POST) == 4) {
  $connectbdd = DataBase::connect();
  
  if (empty(User::getUserByEmail($connectbdd, $_POST['email'])) === false) {
    User::createUser($connectbdd, $_POST["nom"], $_POST['prenom'], $_POST['email'], $_POST['password']);
  }
  unset($_POST);
}
?>