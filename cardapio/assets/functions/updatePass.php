<?php

include("../includes/conexao.php");

$admin      = $_GET['admin'];

$idUsuario  = $_GET['idUsuario'];

$senha      = $_POST['confirmarSenha'];

$senha = base64_encode($senha);

date_default_timezone_set('America/Brasilia');
$dateTime   = date('d/m/Y H:i:s');
$date       = date('Y-m-d H:i:s');


	$conexao->beginTransaction();


  $conexao->exec("UPDATE usuarios SET senha = '$senha', redefineSenha='0' WHERE id = '$idUsuario'" );

	if ($admin == 0)
		echo "<script>window.location='../../ui-home.php';</script>";
	else
		echo "<script>window.location='../../ui-home.php?sair';</script>";

	$conexao->commit();

?>
