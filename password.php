<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="main.php" method="post">
    <input type="text" name="first_name">
    <input type="text" name="last_name">
    <input type="email" name="email">
    <input type="password" name="password">
    <input type="submit" value="Envoyer">
  </form>
    
    <table>
      <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    const DB_HOST = 'localhost';
    const DB_NAME = 'cours_php';
    const DB_USER = 'root';
    const DB_MDP  = 'root';

    $bdd = DataBase::connect();
    $users = DataBase::select($bdd);
    foreach ($users as $key => $value) {
      echo "<tr>";
      foreach ($value as $subkey => $subvalue) {
        echo "<td>".$subvalue."</td>";
      }
        echo "<td><a href='edit.php?user_id=" . $value["id"] . "'>Editer</a></td>";
      echo "<td>" . '<a href="index.php?action=delete&user_id=' . $value["id"] . '">Supprimer</a>' . "</td>";
      echo "</tr>";
    }
    
    if ($_GET["action"] == "editer") {
      echo $_GET['email'];
      DataBase::update($bdd, $_GET["email"], strval($_GET["user_id"]));
    }
    if ($_GET["action"] == "delete") {
      DataBase::delete($bdd, $_GET["user_id"]);
    }

    if (count($_POST) > 3) {
      $utilisateur = new users();
      $utilisateur->first_name = $_POST["first_name"];
      $utilisateur->last_name = $_POST["last_name"];
      $utilisateur->email = $_POST["email"];
      $utilisateur->setPassword($_POST['password']);

      $bdd = DataBase::connect();
      DataBase::insert($bdd, $utilisateur->first_name, $utilisateur->last_name, $utilisateur->email, $utilisateur->getPassword());
    }
    ?>
  </table>
</body>
</html>

<?php
class users
{
  public string $first_name;
  public string $last_name;
  public string $email;
  private string $password;

	/**
	 * @return string
	 */
	public function getPassword(): string {
		return $this->password;
	}
	
	/**
	 * @param string $password 
	 * @return self
	 */
	public function setPassword(string $password): self {
		$this->password = $password;
		return $this;
	}
}

class DataBase 
{
  public static function connect():PDO
  {
    try {
      $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ];
      return new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_MDP, $options);
    } catch (PDOException $e) {
      die("Erreur de connexion : " . $e->getMessage());
    }
  }
  public static function insert(PDO $bdd, string $first_name, string $last_name, string $email, string $password)
  {
    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)";
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(':first_name', $first_name);
    $stmt->bindValue(':last_name', $last_name);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', password_hash($password,PASSWORD_DEFAULT));
    $stmt->execute();
  }
  public static function select(PDO $bdd)
  {
    $sql = "SELECT * FROM users";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $users;
  }
  public static function update(PDO $bdd, string $new_email, int $user_id)
  {
    $sql = "UPDATE users SET email = :email WHERE id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(':email', $new_email);
    $stmt->bindValue(':id', $user_id);
    $stmt->execute();
  }
  public static function delete(PDO $bdd, int $user_id)
  {
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(':id', $user_id);
    $stmt->execute();
  }
}

?>