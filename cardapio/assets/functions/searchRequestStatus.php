<?php

$idPedido = $_GET['idPedido'];

include("../includes/conexao.php");

$select = "SELECT
						status, data_hora_cadastro, data_hora_atualizacao
					 FROM pedidos
					 where id = '$idPedido'";
$result = $conexao -> prepare($select);
$result -> execute();
$count = $result->rowCount();

	if ($data = $result -> fetch()) {
		do {

			$status = $data['status'];
			$dataPedido     = $data['data_hora_cadastro'];
			$dataPedido     = date("d/m/Y H:i", strtotime($dataPedido));

			$dataFimPedido  = $data['data_hora_atualizacao'];
			$dataFimPedido  = date("d/m/Y H:i", strtotime($dataFimPedido));

				/*
				status:
					1 - Novo
					2 - Pedido Confirmado
					3 - Em Produção
					4 - Pronto para Entrega
					5 - Pedido à caminho
					6 - Pedido Entregue

				*/

			switch ($status) {
				case 1:
					$viewStatus = "Pedido realizado";

					$divStatus = '

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p style="color: #292728!important; font-weight: 500; margin: 0; width: 80%; display: inline-block;">'.$viewStatus.'<br>'.$dataPedido.'
					</p>

					<hr class="hr">

					<div class="details-icon">
						<i class="far fa-2x fa-check-circle"></i>
					</div>
					<p>Pedido confirmado</p>

					<hr class="hr">

					<div class="details-icon">
						<i class="far fa-2x fa-check-circle"></i>
					</div>
					<p">Em produção</p>

					<hr class="hr">

					<div class="details-icon">
						<i class="far fa-2x fa-check-circle"></i>
					</div>
					<p>Pronto para entrega</p>

					<hr class="hr">

					<div class="details-icon">
						<i class="far fa-2x fa-check-circle"></i>
					</div>
					<p>Pedido à caminho</p>

					<hr class="hr">

					<div class="details-icon">
						<i class="far fa-2x fa-check-circle"></i>
					</div>
					<p>Pedido entregue</p>

					';

					break;

				case 2:
					$viewStatus = "Pedido confirmado";

					$divStatus = '

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p class="details-icon-p">Pedido realizado<br>'.$dataPedido.'
					</p>

					<hr class="hr">

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p style="color: #292728!important; font-weight: 500; margin: 0; width: 80%; display: inline-block; padding-top: 6px;">'.$viewStatus.'
					</p>

					<hr class="hr">

					<div class="details-icon">
						<i class="far fa-2x fa-check-circle"></i>
					</div>
					<p>Em produção</p>

					<hr class="hr">

					<div class="details-icon">
						<i class="far fa-2x fa-check-circle"></i>
					</div>
					<p>Pronto para entrega</p>

					<hr class="hr">

					<div class="details-icon">
						<i class="far fa-2x fa-check-circle"></i>
					</div>
					<p>Pedido à caminho</p>

					<hr class="hr">

					<div class="details-icon">
						<i class="far fa-2x fa-check-circle"></i>
					</div>
					<p>Pedido entregue</p>


					';

					break;

				case 3:
					$viewStatus = "Em produção";

					$divStatus = '

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p class="details-icon-p">Pedido realizado<br>'.$dataPedido.'
					</p>

					<hr class="hr">

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p class="details-icon-p">Pedido confirmado</p>

					<hr class="hr">

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p style="color: #292728!important; font-weight: 500; margin: 0; width: 80%; display: inline-block; padding-top: 6px;">'.$viewStatus.'
					</p>

					<hr class="hr">

					<div class="details-icon">
						<i class="far fa-2x fa-check-circle"></i>
					</div>
					<p>Pronto para entrega</p>

					<hr class="hr">

					<div class="details-icon">
						<i class="far fa-2x fa-check-circle"></i>
					</div>
					<p>Pedido à caminho</p>

					<hr class="hr">

					<div class="details-icon">
						<i class="far fa-2x fa-check-circle"></i>
					</div>
					<p>Pedido entregue</p>

					';

					break;

				case 4:
					$viewStatus = "Pronto para entrega";

					$divStatus = '

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p class="details-icon-p">Pedido realizado<br>'.$dataPedido.'
					</p>

					<hr class="hr">

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p class="details-icon-p">Pedido confirmado</p>

					<hr class="hr">

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p style="color: #4caf50" class="details-icon-p">Em Produção</p>

					<hr class="hr">

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p style="color: #292728!important; font-weight: 500; margin: 0; width: 80%; display: inline-block; padding-top: 6px;">'.$viewStatus.'
					</p>

					<hr class="hr">

					<div class="details-icon">
						<i class="far fa-2x fa-check-circle"></i>
					</div>
					<p>Pedido à caminho</p>

					<hr class="hr">

					<div class="details-icon">
						<i class="far fa-2x fa-check-circle"></i>
					</div>
					<p>Pedido entregue</p>

					';

					break;

				case 5:
					$viewStatus = "Pedido à caminho";

					$divStatus = '

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p class="details-icon-p">Pedido realizado<br>'.$dataPedido.'
					</p>

					<hr class="hr">

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p class="details-icon-p">Pedido confirmado</p>

					<hr class="hr">

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p class="details-icon-p">Em Produção</p>

					<hr class="hr">

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p class="details-icon-p">Pronto para entrega</p>

					<hr class="hr">

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p style="color: #292728!important; font-weight: 500; margin: 0; width: 80%; display: inline-block; padding-top: 6px;">'.$viewStatus.'
					</p>

					<hr class="hr">

					<div class="details-icon">
						<i class="far fa-2x fa-check-circle"></i>
					</div>
					<p>Pedido entregue</p>

					';

					break;

				case 6:
					$viewStatus = "Pedido Entregue";

					$divStatus = '

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p class="details-icon-p">Pedido realizado<br>'.$dataPedido.'
					</p>

					<hr class="hr">

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p class="details-icon-p">Pedido confirmado</p>

					<hr class="hr">

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p class="details-icon-p">Em Produção</p>

					<hr class="hr">

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p class="details-icon-p">Pronto para entrega</p>

					<hr class="hr">

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p class="details-icon-p">Pedido à caminho</p>

					<hr class="hr">

					<div class="details-icon">
						<i style="color: #4caf50" class="far fa-2x fa-check-circle"></i>
					</div>
					<p style="color: #292728!important; font-weight: 500; margin: 0; width: 80%; display: inline-block; padding-top: 6px;">'.$viewStatus.'<br>'.$dataFimPedido.'
					</p>

					';

					/*

					for($i == 0; $i <= 5; $i++) {

						$a = "idPedido".$i;
						if (isset($_COOKIE[$a])) {
						$idPedido = $_COOKIE[$a];

						$b = "statusPedido".$i;
						$statusPedido = $_COOKIE[$b];

						$c = "precoProduto".$i;
						$precoProduto = $_COOKIE[$c];

						$d = "precoUnitProduto".$i;
						$precoUnitProduto = $_COOKIE[$d];

						$e = "precoTotal".$i;
						if (isset($_COOKIE[$a])) {
							$precoTotal = $_COOKIE[$e];
							setcookie($precoTotal, null, "");
						}

						$f = "qtdProduto".$i;
						$qtdProduto = $_COOKIE[$f];

						setcookie($idPedido, null, -1);
						setcookie($statusPedido, null, -1);
						setcookie($precoProduto, null, -1);
						setcookie($precoUnitProduto, null, -1);

						setcookie($qtdProduto, null, -1);

						}
					}

					*/


					break;

			}

			echo '

			<div class="form-group" style="background-color: #fff; border-radius: 10px; padding: 15px">
				'.$divStatus.'
				</p>
			</div>

			';

		} while($data = $result -> fetch());
	}

?>
