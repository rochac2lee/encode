<?php

	if(isset($_REQUEST['sair'])){
			include('conexao.php');

			date_default_timezone_set('America/Brasilia');
			$dateTime = date('d/m/Y H:i');

			session_destroy();
			session_unset($_SESSION['usuario_lp']);
			session_unset($_SESSION['senha_lp']);
			header("Location: login");
	}
?>
