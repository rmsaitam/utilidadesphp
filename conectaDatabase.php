<?php
/*
Autor: Reginaldo
Objetivo: Reutiliza a classe Database e aplica ao SGBD MySQL com seus dados de acesso
Data: 22/01/2017
*/
include_once "Database.php";

$sgbd = "mysql";
$host = "localhost";
$banco = "nomedobanco";
$usuario = "usuariodobanco";
$pass = "senhausuariodobanco";

$db = new Database($sgbd, $host, $banco, $usuario, $pass);
$conn = $db->conectaBanco();

?>