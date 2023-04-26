<?php
class User
{
  public static function createUser(PDO $bdd, string $first_name, string $last_name, string $email, string $password)
  {
    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)";
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(':first_name', $first_name);
    $stmt->bindValue(':last_name', $last_name);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', password_hash($password,PASSWORD_DEFAULT));
    $stmt->execute();
  }
  public static function getUserByEmail(PDO $bdd, string $email)
  {
    $sql = "SELECT * FROM users WHERE `email` = :email";
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(":email", $email);
    $stmt->execute();
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $user;
  }
  public static function getUserById(PDO $bdd, string $id)
  {
    $sql = "SELECT * FROM users WHERE `id` = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $user;
  }
  public static function updateUser(PDO $bdd, string $new_email, int $user_id)
  {
    $sql = "UPDATE users SET email = :email WHERE id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(':email', $new_email);
    $stmt->bindValue(':id', $user_id);
    $stmt->execute();
  }
  public static function deleteUser(PDO $bdd, int $user_id)
  {
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(':id', $user_id);
    $stmt->execute();
  }
}

?>