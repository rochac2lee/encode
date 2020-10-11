<?php
ob_start();
session_start();

date_default_timezone_set('America/Brasilia');
$dateTime     = date('d/m/Y H:i:s');
$dateTimeGLPI = date('Y-m-d H:i:s');

if (!isset($_SESSION['usuario_appcimbessul']) && (!isset($_SESSION['senha_appcimbessul']))){
	header("Location: index.php"); exit;
}

include('assets/includes/conexao.php');
require('assets/includes/logout.php');

$email = $_SESSION['usuario_appcimbessul'];
$senha = $_SESSION['senha_appcimbessul'];

$breakUsuario = explode("@", $email);
$usuario = $breakUsuario[0];

$select = "SELECT id, name, firstname, realname FROM glpi_users
					 where name = '$usuario' and employee = 1";
$result = $conexao_glpi -> prepare($select);
$result -> execute();
$count = $result->rowCount();

if ($data = $result->fetch()) {
	do {

		$idUsuario    = $data['id'];
		$nomeUsuario  = $data['firstname'];
		$emailUsuario = $email.".com.br";

	} while ($data = $result -> fetch());
}

?>
