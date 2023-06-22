<?php
date_default_timezone_set('America/Sao_Paulo');
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
  $pdo = new PDO("mysql:host=localhost;dbname=a3_trabalho;charset=utf8", "root", "");
} catch (PDOException $erro) {
  echo ("ERRO NA CONEXÃO:" . $erro->getMessage());
}
?>