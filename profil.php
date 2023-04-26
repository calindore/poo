<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("bdd.php");
require_once("user.php");
if (count($_POST) > 2) {
  $connectbdd = DataBase::connect();
  $user = User::getUserByEmail($connectbdd, $_POST['email']);
  if (empty($user) === false && password_verify($_POST['password'],$user['password'])) {
    setcookie("connecte", true, time() + 3600);
  } else {
    header("Location:index.php");
  }
  unset($_POST);
}

if (isset($_COOKIE['connecte']) == false || $_COOKIE['connecte'] !== true) {
  header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil</title>
</head>
<body>
  <div>
    <p>Prénom : </p>
    <?php
    echo "<p>".$user['first_name']."</p>";
    ?>
  </div>
  <div>
    <p>Nom : </p>
    <?php
    echo "<p>".$user['last_name']."</p>";
    ?>
  </div>
  <div>
    <p>Email : </p>
    <?php
    echo "<p>".$user['email']."</p>";
    ?>
  </div>
  <div>
    <p>Password : </p>
    <?php
    echo "<p>".$user['password']."</p>";
    ?>
  </div>

</body>
</html>