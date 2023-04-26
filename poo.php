<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TP POO</title>
</head>
<body>
  
</body>
</html>

<?php

class Animal
{
  private string $_nom;
  private int $_age;
  private string $_type;

	/**
	 * @return string
	 */
	public function get_type(): string {
		return $this->_type;
	}
	
	/**
	 * @param string $_type 
	 * @return self
	 */
	public function set_type(string $_type): self {
    $authorizedAnimals = array("mammifère", "oiseau", "reptile");
    if (in_array($_type, $authorizedAnimals)) {
      $this->_type = $_type;
    } else {
      $this->_type = "Ce type d'animal n'est pas reconnu ou pris en compte";
    }
		return $this;
	}

	/**
	 * @return string
	 */
	public function get_nom(): string {
		return $this->_nom;
	}
	
	/**
	 * @param string $_nom 
	 * @return self
	 */
	public function set_nom(string $_nom): self {
		$this->_nom = $_nom;
		return $this;
	}

	/**
	 * @return int
	 */
	public function get_age(): int {
		return $this->_age;
	}
	
	/**
	 * @param int $_age 
	 * @return self
	 */
	public function set_age(int $_age): self {
    if ($_age < 0) {
      $this->_age = 999;
    } else {
      $this->_age = $_age;
    }
		return $this;
	}

  public function __toString()
  {
    return "Cet animal s'appelle $this->_nom. Il a $this->_age ans. C'est un $this->_type";
  }

  public function faireDuBruit()
  {
    echo "L'animal fait du bruit";
  }

}

class Mammifère extends Animal
{
  public function voler()
  {
    echo $this->get_nom()." tente de voler et échoue lamentablement";
  }
  public function faireDuBruit()
  {
    echo "Le mammifère rugit";
  }
}
class Oiseau extends Animal
{
  public function voler()
  {
    echo $this->get_nom()." s'envole dans le ciel";
  }
  public function faireDuBruit()
  {
    echo "L'oiseau gazouille";
  }
}
class Reptile extends Animal
{
  public function voler()
  {
    echo $this->get_nom()." n'a pas d'aile et n'en a rien à faire.";
  }
  public function faireDuBruit()
  {
    echo "Le reptile siffle";
  }
}

$oiseau = new Mammifère();
$oiseau->set_nom("Thumb");
$oiseau->faireDuBruit();

?>