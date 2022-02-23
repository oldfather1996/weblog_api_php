<?php

namespace app\models;

use PDO;

class User
{
  private $conn;
  private $table = 'users';

  public $id;
  public $username;
  public $pwd;
  public $email;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function signup()
  {
    $query = 'INSERT INTO ' . $this->table . ' SET username = :username, password = :password, email = :email';

    $stmt = $this->conn->prepare($query);

    $this->username = htmlspecialchars(strip_tags($this->username));
    $this->password = htmlspecialchars(strip_tags($this->password));
    $this->email = htmlspecialchars(strip_tags($this->email));

    $stmt->bindParam(':username', $this->username);
    $stmt->bindParam(':password', $this->password);
    $stmt->bindParam(':email', $this->email);

    if ($stmt->execute()) {
      return true;
    }

    printf("Error: %s.\n", $stmt->error);

    return false;
  }
  public function doLogin($username = null, $password = null)
  {
    $query = 'SELECT * FROM users where username=? and password=?';
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('s', $username);
    print_r($stmt);
    $stmt->execute();
    return $stmt;
  }

  public function isAlreadyExit()
  {
    $query = 'SELECT * FROM'  . $this->table . 'WHERE username =' . $this->username;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }
}
