<?php

include("../includes/conexao.php");

$idUsuario  = $_GET['idUsuario'];

$avaliacao  = $_POST['rating'];
$comentario = $_POST['comentario'];

date_default_timezone_set('America/Brasilia');
$dateTime   = date('d/m/Y H:i:s');
$date       = date('Y-m-d H:i:s');

$selectUser = "SELECT nome FROM usuarios where id = '$idUsuario'";
$resultUser = $conexao -> prepare($selectUser);
$resultUser -> execute();
$countUser = $resultUser->rowCount();

if ($dataUser = $resultUser->fetch()) {
	do {

		$nomeUsuario  = utf8_encode($dataUser['nome']);
		$separaNome = explode(" ", $nomeUsuario);
		$nomeUsuario  = $separaNome[0];

	} while ($dataUser = $resultUser->fetch());
}


	$conexao->beginTransaction();

	$conexao->exec("INSERT INTO avaliacoes (id, idUsuario, nota, comentario, data_hora_cadastro)
														VALUES ('', '$idUsuario', '$avaliacao', '$comentario', '$dateTime')" );

  $conexao->exec("UPDATE usuarios SET avaliacao = '0' WHERE id = '$idUsuario'" );

	$evento = $nomeUsuario." avaliou o aplicativo coma a nota ".$avaliacao." em ".$dateTime;

	$conexao->exec("INSERT INTO registros(id, evento, data_hora_evento)
																			VALUES ('', '$evento', '$dateTime')" );

	echo "<script>window.location='../../ui-home.php';</script>";

	$conexao->commit();

?>
