<?php

include("../includes/conexao.php");

$nomeUsuario    = $_POST['nome'];
$separaNome     = explode(" ", $nomeUsuario);
$primeiroNomeUsuario = $separaNome[0];
$celularUsuario   = $_POST['celular'];

$select = "SELECT celular FROM usuarios WHERE celular = '$celularUsuario'";
$result = $conexao -> prepare($select);
$result -> execute();
$count = $result->rowCount();

if ($count == "") {

	$confirmarSenha = base64_encode($_POST['confirmarSenha']);

	$permissao     = 1;
	$status        = 1;
	$redefineSenha = 0;

	switch ($permissao) {
		case 0:
			$nomePermissao = "Administrador";
			break;

		case 1:
			$nomePermissao = "Usuário Comum";
			break;
	}

	$selectUser = "SELECT id FROM usuarios ORDER BY id DESC LIMIT 1";
	$resultUser = $conexao -> prepare($selectUser);
	$resultUser -> execute();
	$countUser = $resultUser->rowCount();

	if ($dataUser = $resultUser->fetch()) {
		do {

			$lastId = $dataUser['id'];

		} while ($dataUser = $resultUser->fetch());
	}

	$lastId = $lastId + 1;

	date_default_timezone_set('America/Brasilia');
	$dateTime      = date('d/m/Y H:i:s');

	//UPLOAD
	$avatar   = $_FILES['uploadAvatar'];
	$numFile  = count(array_filter($avatar['name']));

	//REQUISITOS
	$permite 	= array('image/bmp', 'image/jpeg', 'image/jpg', 'image/gif', 'image/png');
	$maxSize	= 1024 * 1024 * 24;

	//PASTA
	$folder = '../uploads/avatar';

		$conexao->beginTransaction();

	if ($numFile > 0) {
		//Faz o upload de multiplos arquivos
		for ($count = 0; $count < $numFile; $count++) {
			$name 	= $avatar['name'][$count];
			$type	= $avatar['type'][$count];
			$size	= $avatar['size'][$count];
			$error	= $avatar['error'][$count];
			$tmp	= $avatar['tmp_name'][$count];

			$avatar = $name;

			if(move_uploaded_file($tmp, $folder.'/'.$avatar)) {

				$conexao->exec("INSERT INTO usuarios (id, nome, avatar, celular, senha, tipo, status, avaliacao, redefineSenha, data_hora_cadastro)
																	VALUES ('$lastId', '$nomeUsuario', '$avatar', '$celularUsuario', '$confirmarSenha', '$permissao', '$status', '1', '$redefineSenha', '$dateTime')" );

			}
		}
	} else {

			$avatar = 'admin.png';

				$conexao->exec("INSERT INTO usuarios (id, nome, avatar, celular, senha, tipo, status, avaliacao, redefineSenha, data_hora_cadastro)
																	VALUES ('$lastId', '$nomeUsuario', '$avatar', '$celularUsuario', '$confirmarSenha', '$permissao', '$status', '1', '$redefineSenha', '$dateTime')" );

	}

		$evento = $primeiroNomeUsuario." fez cadastro em ".$dateTime;

		$conexao->exec("INSERT INTO registros (id, evento, data_hora_evento)
										                    VALUES ('', '$evento', '$dateTime')" );

		sleep(3);
		echo "<script>window.location='../../login';</script>";

		$conexao->commit();

} else {
	echo "<script>window.location='../../login/index.php?existeUsuario=1';</script>";
}

?>
