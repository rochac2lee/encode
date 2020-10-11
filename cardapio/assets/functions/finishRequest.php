<?php

include("../includes/conexao.php");

$idPedido       = $_GET['idPedido'];
$celular        = $_GET['celular'];

$select = "SELECT * FROM produtos";
$result = $conexao -> prepare($select);
$result->execute();
$qtdProdutosCadastrados = $result->rowCount();

$qtdProdutosCadastrados++;

$conexao->beginTransaction();

for($i == 0; $i <= $qtdProdutosCadastrados; $i++) {

	$x = "idProduto".$i;
	if (isset($_COOKIE[$x])) {
	$idProduto = $_COOKIE[$x];

	$y = "qtdProduto".$i;
	$qtdProduto = $_COOKIE[$y];

	$conexao->exec("INSERT INTO pedido_itens (id, idPedido, idProduto, quantidade)
														VALUES ('', '$idPedido', '$idProduto', '$qtdProduto')" );

	}
}

$rua            = $_POST['rua'];
$numero         = $_POST['numero'];
$bairro         = $_POST['bairro'];
$complemento    = $_POST['complemento'];
$formaPagamento = $_POST['formaPagamento'];
$descricao      = $_POST['descricao'];

	date_default_timezone_set('America/Brasilia');
	$dateTime      = date('d/m/Y H:i:s');
	$date          = date('Y-m-d H:i:s');

	$conexao->exec("UPDATE pedidos SET formaPagamento='$formaPagamento' WHERE id = '$idPedido'" );

	$select = "SELECT * FROM pedidos WHERE id = '$idPedido' and celular = '$celular'";
	$result = $conexao -> prepare($select);
	$result -> execute();
	$count = $result->rowCount();

	if ($count == "") {

		$select = "SELECT * FROM endereco_cliente WHERE idCliente = '$idPedido' and numero = '$numero'";
		$result = $conexao -> prepare($select);
		$result -> execute();
		$countEndereco = $result->rowCount();

		if ($countEndereco == "") {

			$conexao->exec("INSERT INTO endereco_cliente (id, idCliente, rua, numero, bairro, complemento, descricao, data_hora_cadastro)
																            VALUES ('', '$idPedido', '$rua', '$numero', '$bairro', '$complemento', '$descricao', '$date')" );
		}

		echo "<script>window.location='../../ui-checkout.php?status=1&idPedido=$idPedido';</script>";


	} else {

		echo "<script>window.location='../../ui-checkout.php?status=1&idPedido=$idPedido';</script>";

	}

	$conexao->commit();

?>
