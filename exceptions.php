<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
set_error_handler("exceptions_error_handler");

function divide($a, $b) //J'utilise php 7.4 et en cette version, la division par 0 renvoie un Warning. Warning n'étant pas attrapé par les catch.
{
  try {
    echo $a / $b;
  } catch (\Throwable $th) {
      throw $th;
  }
}

try {
  //file_get_contents("lol");
} catch (\ErrorException $th) {
  throw $th;
}

function exceptions_error_handler($severity, $message, $filename, $lineno) {
  throw new ErrorException($message, 0, $severity, $filename, $lineno);
}

class InvalidEmailException extends Exception
{
  function __construct($e)
  {
    parent::__construct($e);
  }
}

function validateEmail(string $email)
{
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return $email;
  } else {
    new InvalidEmailException($email);
  }
}

try {
  echo validateEmail("faux");
} catch (\Throwable $th) {
  throw $th;
} finally {
  echo "Validation de l'email terminé";
}




?>