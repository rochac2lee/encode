<?php
ob_start();
session_start();

if (isset($_GET[forgotPassword])) {
	$forgotPassword = $_GET[forgotPassword];
}

date_default_timezone_set('America/Brasilia');
$dateTime     = date('d/m/Y H:i:s');
$dateTimeGLPI = date('Y-m-d H:i:s');

if (!isset($_SESSION['usuario_lp']) && (!isset($_SESSION['senha_lp']))){
	header("Location: login"); exit;
}

include('assets/includes/conexao.php');
require('assets/includes/logout.php');

$celular = $_SESSION['usuario_lp'];
$senha = $_SESSION['senha_lp'];

if ($forgotPassword == 1) {
	$select = "SELECT id, nome, avatar, tipo, celular, status, avaliacao, redefineSenha FROM usuarios where celular = '$celular'";
} else {
	$select = "SELECT id, nome, avatar, tipo, celular, status, avaliacao, redefineSenha FROM usuarios where celular = '$celular' and senha = '$senha'";
}
$result = $conexao -> prepare($select);
$result -> execute();
$count = $result->rowCount();

if ($data = $result->fetch()) {
	do {

		$idUsuario           = $data['id'];
		$celularUsuario      = $data['celular'];
		$avatarUsuario       = $data['avatar'];
		$redefineSenha       = $data['redefineSenha'];
		$status              = $data['status'];
		$admin               = $data['tipo'];
		$avaliacao           = $data['avaliacao'];
		$nomeCompletoUsuario = $data['nome'];
		$separaNome          = explode(" ", $nomeCompletoUsuario);
		$nomeUsuario         = $separaNome[0];

		if ($status == 0) {
			echo "<script>window.location='?sair';</script>";
		}

	} while ($data = $result -> fetch());
}

?>
