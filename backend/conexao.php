<?php

class Conexao {

private  $server = "mysql:host=localhost;dbname=blueservice;port=3308";
private  $user = "root";
private  $pass = "";
private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
protected $con;
 
  public function abreConexao() {
    try {
      $this->con = new PDO($this->server, $this->user,$this->pass,$this->options);
      return $this->con;
    } catch (PDOException $e) {
      echo "There is some problem in connection: " . $e->getMessage();
    }
  }

  public function fechaConexao() {
    $this->con = null;
  }
}

?>