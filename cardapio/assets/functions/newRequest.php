<?php

include("../includes/conexao.php");

$nomeCliente    = $_POST['nomeCompleto'];
$separaNome     = explode(" ", $nomeCliente);
$primeiroNomeCliente = $separaNome[0];
$celular        = $_POST['celular'];

$valorTotal = $_COOKIE['precoTotal'];

	date_default_timezone_set('America/Brasilia');
	$dateTime      = date('d/m/Y H:i:s');
	$date          = date('Y-m-d H:i:s');

	/*

	status:
		1 - Novo
		2 - Pedido Confirmado
		3 - Em Produção
		4 - Pronto para Entrega
		5 - Pedido está com o Motoboy
		6 - Pedido Entregue

	*/

	$conexao->beginTransaction();

	$select = "SELECT nome, celular FROM usuarios WHERE nome = '$nomeCliente' || celular = '$celular'";
	$result = $conexao -> prepare($select);
	$result -> execute();
	$count = $result->rowCount();

	if ($count == "") {

		$conexao->exec("INSERT INTO usuarios (id, nome, avatar, celular, tipo, status, data_hora_cadastro)
															    VALUES ('', '$nomeCliente', 'admin.png', '$celular', '1', '1', '$date')" );

	}


	$select = "SELECT id FROM pedidos WHERE celular = '$celular' and status = 1";
	$result = $conexao -> prepare($select);
	$result -> execute();
	$count = $result->rowCount();

	if ($count == "") {

		$selectPedido = "SELECT id FROM pedidos ORDER BY id DESC LIMIT 1";
		$resultPedido = $conexao -> prepare($selectPedido);
		$resultPedido -> execute();
		$countPedido = $resultPedido->rowCount();

		if ($dataPedido = $resultPedido->fetch()) {
			do {

				$lastPedido = $dataPedido['id'];

			} while ($dataPedido = $resultPedido->fetch());
		}

			$lastPedido = $lastPedido + 1;

		$conexao->exec("INSERT INTO pedidos (id, nome, celular, status, avaliacao, formaPagamento, valorTotal, data_hora_cadastro, data_hora_atualizacao)
															VALUES ('$lastPedido', '$nomeCliente', '$celular', '1', '0', '0', '$valorTotal', '$date', '$date')" );

		echo "<script>window.location='../../ui-checkout.php?idPedido=$lastPedido&celular=$celular';</script>";


	} else {

		if ($data = $result->fetch()) {
			do {

				$lastPedido = $data['id'];

			} while ($data = $result->fetch());
		}

		echo "<script>window.location='../../ui-checkout.php?idPedido=$lastPedido';</script>";

	}

	$conexao->commit();

?>
