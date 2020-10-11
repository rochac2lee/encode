<?php

	try {
		$conexao = new PDO('mysql:host=opmy0018.servidorwebfacil.com:3306;dbname=cesarl_lp', 'cesar_lp', '#0Gq6ft7');
		$conexao -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo 'Houve um Erro na conexao com o banco de dados: ' . $e -> getMessage();
	}


?>
