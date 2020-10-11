<?php

if (isset($_GET['id'])) {
		$idSolicitacaoAtual = $_GET['id'];
}

require('assets/includes/session.php');

?>
<!DOCTYPE html>
<html lang="en" style="overflow-x: hidden!important; ">

<head>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1, user-scalable=no">
	<title>Plantão TI Cimbessul S.A.</title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/logo.png">

	<meta name="description" content="Sistema de Atendimento de Plantão da Equipe de TI da Cimbessul S.A.">
	<meta name="author" content="Cleber Lee da Rocha">

	<!-- Font Icon css -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<!-- Effect Animate css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css" integrity="sha256-gVCm5mRCmW9kVgsSjQ7/5TLtXqvfCoxhdsjE6O1QLm8=" crossorigin="anonymous" />

	<!-- Style CSS -->
	<link href="assets/css/style.css" rel="stylesheet" type="text/css" />

	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

	<!-- Alerts Switchery css -->
	<link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

	<!-- Edit TextArea css -->
	<link rel="stylesheet" href="assets/plugins/trumbowyg/ui/trumbowyg.min.css">

	<!-- Media Fancybox -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Share+Tech&display=swap" rel="stylesheet">

	<script src="assets/js/jquery.min.js"></script>

</head>

<body style="background-color: #ffffff; z-index: 1000000000;" onload="getDateTime()">

<style>
	.menuBtn {
		font-family: 'Raleway', sans-serif;
		font-size: 10px;
		margin:5px;
		font-weight: 600;
		color: #fff;
	}

	.menuBtnEvent {
		font-family: 'Share Tech', sans-serif;
		font-size: 14px;
		margin:5px;
		font-weight: 600;
		color: #fff;
	}
	.tab-pane {
		border-radius: 4px;
		border: 0;
		padding: 15px;
		margin-top: 3px;
	}
</style>

<script>

function loading() {
	document.getElementById("loading").style.display = "block";
}

function solucao() {
	document.getElementById("infoTicket").style.display = "none";
	document.getElementById("optEdit").style.display = "none";
	document.getElementById("closeTicket").style.display = "block";
	document.getElementById("optCancel").style.display = "block";
}

function voltar() {
	document.getElementById("infoTicket").style.display = "block";
	document.getElementById("optEdit").style.display = "block";
	document.getElementById("closeTicket").style.display = "none";
	document.getElementById("optCancel").style.display = "none";
}

</script>

<div class="row">

	<?php

		$select = "SELECT glpi_users.id, glpi_users.firstname, glpi_users.realname FROM glpi_users
							 INNER JOIN
									glpi_groups_users
							 ON
									glpi_users.id = glpi_groups_users.users_id
							 where glpi_users.id = '$idUsuario'";
		$result = $conexao_glpi -> prepare($select);
		$result -> execute();
		$countAdmin = $result->rowCount();

	?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="navAtendimentos">
		<div class="card mb-3" style="background: transparent; border: 0;">
			<div class="card-header">

					<strong><h5 style="margin-bottom: 0;"><i class="fas fa-chevron-left" onclick="window.location.href = 'ui-tickets.php'; loading()" style="margin-right: 15px; color: #0064b7"></i> Atendimentos</h5></strong>

			</div>
			<div class="card-body">
				<div class="card mb-3" style="background: transparent;">
				<?php

					$selectAllTickets = "SELECT * FROM glpi_tickets where id = '$idSolicitacaoAtual'";
					$resultAllTickets = $conexao_glpi -> prepare($selectAllTickets);
					$resultAllTickets -> execute();
					$countAllTickets = $resultAllTickets->rowCount();

					if ($dataAllTickets = $resultAllTickets->fetch()) {
						do {

							$viewTicketId       = $dataAllTickets['id'];
							$viewTicketIdLocal  = $dataAllTickets['locations_id'];
							$viewTicketIdAutor  = $dataAllTickets['users_id_recipient'];
							$viewTicketMotivo   = utf8_encode($dataAllTickets['name']);
							$viewTicketIdStatus = $dataAllTickets['status'];
							$viewTicketDate     = $dataAllTickets['date_creation'];
							$viewTicketContent  = utf8_encode($dataAllTickets['content']);

							//Solução
							$viewSolucao        = utf8_encode($dataAllTickets['solution']);
							$viewDataSolucao    = date("d/m/Y H:i:s", strtotime($dataAllTickets['solvedate']));

							//Pesquisa Técnicos
							$selectTicketTec = "SELECT glpi_tickets_users.users_id, glpi_users.firstname
																	FROM glpi_tickets_users
																	INNER JOIN glpi_users
																	ON glpi_users.id = glpi_tickets_users.users_id
																	where tickets_id = '$idSolicitacaoAtual' and type = 2";
							$resultTicketTec = $conexao_glpi -> prepare($selectTicketTec);
							$resultTicketTec -> execute();
							$countTicketTec = $resultTicketTec->rowCount();

							//Pesquisa Solicitante
							$selectTicketSolicitante = "SELECT firstname FROM glpi_users where id = '$viewTicketIdAutor'";
							$resultTicketSolicitante = $conexao_glpi -> prepare($selectTicketSolicitante);
							$resultTicketSolicitante -> execute();
							$countTicketSolicitante = $resultTicketSolicitante->rowCount();

							if ($dataTicketSolicitante = $resultTicketSolicitante->fetch()) {
								do {

									$viewTicketNomeAutor = $dataTicketSolicitante['firstname'];

								} while($dataTicketSolicitante = $resultTicketSolicitante->fetch());
							}

							//Pesquisa Local
							$selectTicketLocal = "SELECT name FROM glpi_locations where id = '$viewTicketIdLocal'";
							$resultTicketLocal = $conexao_glpi -> prepare($selectTicketLocal);
							$resultTicketLocal -> execute();
							$countTicketLocal = $resultTicketLocal->rowCount();

							if ($dataTicketLocal = $resultTicketLocal->fetch()) {
								do {

									$viewTicketLocal = $dataTicketLocal['name'];

								} while($dataTicketLocal = $resultTicketLocal->fetch());
							}

							//status
							switch ($viewTicketIdStatus) {
								case 1:
									$viewTicketStatus = 'Aguardando Atendimento...';
									$statusTicket = "<img src='assets/images/process.gif' style='width: 20px' /> ".$viewTicketStatus;
									break;

								case 2:
									$viewTicketStatus = 'Processando (Atribuído)';
									$statusTicket = "<img src='assets/images/process.gif' style='width: 20px' /> ".$viewTicketStatus;
									break;

								case 3:
									$viewTicketStatus = 'Processando (Planejado)';
									$statusTicket = "<img src='assets/images/process.gif' style='width: 20px' /> ".$viewTicketStatus;
									break;

								case 4:
									$viewTicketStatus = 'Pendente';
									$statusTicket = "<img src='assets/images/process.gif' style='width: 20px' /> ".$viewTicketStatus;
									break;

								case 5:
									$viewTicketStatus = 'Solucionado';
									$statusTicket = "<i class='fas fa-check-square'></i> ".$viewTicketStatus;
									break;

								case 6:
									$viewTicketStatus = 'Fechado';
									$statusTicket = "<i class='fas fa-check-square'></i> ".$viewTicketStatus;
									break;

								default:
									$viewTicketStatus = 'Aguardando...';
									$statusTicket = "<img src='assets/images/process.gif' style='width: 20px' /> ".$viewTicketStatus;
									break;
							}

							echo  "
							<div class='card-header' style='padding-bottom: 0;'>
									<p><i style='margin-right: 10px' class='fas fa-caret-right'></i> ".$viewTicketId." - ".$viewTicketMotivo."</p>
							</div>
							<div class='card-body animated fadeIn' id='infoTicket'>
									<p><i class='fas fa-user'></i> ".$viewTicketNomeAutor."</p>
									<p><i class='fas fa-map-marker-alt'></i> ".$viewTicketLocal."</p>
									<p><i class='fas fa-calendar-alt'></i> Criado em ".date("d/m/Y H:i:s", strtotime($viewTicketDate))."</p>
									<p><i class='fas fa-info-circle'></i> ".$viewTicketMotivo."<br><i class='fas fa-quote-left'></i> ".$viewTicketContent."</p>
									<p>".$statusTicket."</p>

									<hr>";

									if ($countTicketTec > 0) { echo	"<p>Atribuído a ";

									$contagem = 1;
									if ($dataTicketTec = $resultTicketTec->fetch()) {
										do {

											$ticketIdTec = $dataTicketTec['users_id'];
											$ticketTec   = $dataTicketTec['firstname'];
											echo $ticketTec;

											if ($ticketIdTec != $idUsuario){

												$selectExistTec = "SELECT glpi_tickets_users.users_id FROM glpi_tickets_users
																						where glpi_tickets_users.users_id = '$idUsuario' and tickets_id = '$idSolicitacaoAtual' and type = 2";
												$resultExistTec = $conexao_glpi -> prepare($selectExistTec);
												$resultExistTec -> execute();
												$countExistTec = $resultExistTec->rowCount();

												if ($countExistTec == 0) {
													if ($countAdmin > 0) {
														if ($viewTicketIdStatus == 5 || $viewTicketIdStatus == 6) {
															echo "<a href='assets/functions/ticketToUser.php?nome_usuario=$nomeUsuario&email_usuario=$emailUsuario&id_usuario=$idUsuario&id_ticket=$idSolicitacaoAtual'><p><i class='fas fa-long-arrow-alt-down'></i> Associar a mim mesmo</p></a>";
														}
													}
												}
											}

											do {
												if ($contagem == $countTicketTec) {
												echo " ";
											  } else {
												echo " e ";
												}
												$contagem++;
											} while ($contagem < $countTicketTec);

										} while ($dataTicketTec = $resultTicketTec->fetch());
									}

								echo "</p>";
							} else {
								if ($countAdmin > 0) {
								echo "<a href='assets/functions/ticketToUser.php?nome_usuario=$nomeUsuario&email_usuario=$emailUsuario&id_usuario=$idUsuario&id_ticket=$idSolicitacaoAtual'><p><i class='fas fa-long-arrow-alt-down'></i> Associar a mim mesmo</p></a>";
								}
							}

							if ($countAdmin > 0) {
									$selectTicketOtherTec = "SELECT glpi_users.name, glpi_users.id, glpi_users.firstname
																					 FROM glpi_users
																					 INNER JOIN glpi_groups_users ON glpi_groups_users.users_id = glpi_users.id
																					 where glpi_users.id != '$idUsuario'";
									$resultTicketOtherTec = $conexao_glpi -> prepare($selectTicketOtherTec);
									$resultTicketOtherTec -> execute();
									$countTicketOtherTec = $resultTicketOtherTec->rowCount();

									if ($dataTicketOtherTec = $resultTicketOtherTec->fetch()) {
										do {

												$ticketIdOtherTec    = $dataTicketOtherTec['id'];
												$ticketOtherTec      = $dataTicketOtherTec['firstname'];
												$ticketEmailOtherTec = $dataTicketOtherTec['name']."@cimbessul.com.br";

												$selectValideTicket = "SELECT * FROM glpi_tickets_users
																							 where tickets_id = '$idSolicitacaoAtual'";
												$resultValideTicket = $conexao_glpi -> prepare($selectValideTicket);
												$resultValideTicket -> execute();
												$countValideTicket = $resultValideTicket->rowCount();

												if ($dataValideTicket = $resultValideTicket->fetch()) {
													do {

															$idTrueUser = $dataValideTicket['users_id'];

													} while ($dataValideTicket = $resultValideTicket->fetch());
												}

												if ($idTrueUser != $ticketIdOtherTec) {

												echo "<a href='assets/functions/ticketToOtherUser.php?nome_usuario=$nomeUsuario&id_tecnico=$ticketIdOtherTec&nome_tecnico=$ticketOtherTec&email_tecnico=$ticketEmailOtherTec&email_usuario=$emailUsuario&id_usuario=$idUsuario&id_ticket=$idSolicitacaoAtual'><p><i class='fas fa-user-plus'></i> Associar a ".$ticketOtherTec."</p></a>";

												}

										}	while ($dataTicketOtherTec = $resultTicketOtherTec->fetch());

										if ($viewSolucao != "") {

										echo "
										<hr>

										<h5>Solução</h5>

										<p><i class='fas fa-quote-left'></i> ".$viewSolucao."</p>
										<p>Solucionado em ".$viewDataSolucao."</p>

										";
										}

									} //Finaliza a pesquisa por Técnicos atribuídos - ADMIN
							}

						} while ($dataAllTickets = $resultAllTickets->fetch());
					} else {

						echo "<p><i class='far fa-frown-open'></i> Você não tem solicitações fechadas ou em andamento!</p>";

					}
					?>

					</div>
					<div class='card-body animated fadeIn' id='closeTicket' style='display: none'>

					<script>

					 function CriaRequest() {
						 try{
							 request = new XMLHttpRequest();
						 }catch (IEAtual){

							 try{
								 request = new ActiveXObject("Msxml2.XMLHTTP");
							 }catch(IEAntigo){

								 try{
									 request = new ActiveXObject("Microsoft.XMLHTTP");
								 }catch(falha){
									 request = false;
								 }
							 }
						 }

						 if (!request)
							 alert("Seu Navegador não suporta Ajax!");
						 else
							 return request;
					 }

					 function getDateTime() {

						 // Declaração de Variáveis
						 var result = document.getElementById("divDateTime");
						 var xmlreq = CriaRequest();

						 var address = "assets/functions/getDateTime.php";

						 // Iniciar uma requisição
						 xmlreq.open("GET", address, true);
						 setTimeout(getDateTime, 1000); //5s

						 // Atribui uma função para ser executada sempre que houver uma mudança de ado
						 xmlreq.onreadystatechange = function(){

							 // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
							 if (xmlreq.readyState == 4) {

								 // Verifica se o arquivo foi encontrado com sucesso
								 if (xmlreq.status == 200) {
									 result.innerHTML = xmlreq.responseText;
								 }else{
									 result.innerHTML = "Erro: " + xmlreq.statusText;
								 }
							 }
						 };
						 xmlreq.send(null);
					 }
					 </script>

					 <form action="assets/functions/closeTicket.php?id_solicitacao=<?php echo $idSolicitacaoAtual; ?>&id_usuario=<?php echo $idUsuario; ?>&nome_usuario=<?php echo $nomeUsuario; ?>" name="closeTicket" id="closeTicket" method="post">

					<div id="divDateTime"></div>

					<div class="form-group">
					<label>Tipo de Solução *</label>

					<select class="form-control" name="tipo_solucao" required="">
						<option>Selecione...</option>

					<?php

						$select = "SELECT id, name FROM glpi_solutiontypes order by name ASC";
						$result = $conexao_glpi -> prepare($select);
						$result -> execute();
						$count = $result->rowCount();

						if ($data = $result->fetch()) {
							do {
								$idTipoSolucao = $data['id'];
								$solucao       = utf8_encode($data['name']);
					?>
						<option value="<?php echo $idTipoSolucao; ?>"><?php echo $solucao; ?></option>
					<?php
							} while ($data = $result->fetch());
						}
					?>
					</select>
					</div>

					<div class='form-group'>
					<label>Solução *</label>
					<textarea class='form-control' type='text' name='descricao_solucao' required=''></textarea>
					</div>

					<script type="text/javascript">
					function verificaCloseTicket(){
						if (document.closeTicket.descricao_solucao.value == ""){
							return false;
						} else {
							document.closeTicket.submit();
							document.getElementById('btnCloseTicket').style.visibility = 'hidden';
							document.getElementById('btnCloseTicket').style.display = 'none';
							alertCloseTicket();
						}
					}
					</script>

						<button type='submit' class='btn btn-success' style='float: right;' onclick='verificaCloseTicket()' id='btnCloseTicket'><i class='fa fa-save'></i>&nbsp; Salvar</button>

					</div>

					</form>

				</div>
			</div>
		</div>

	</div>

</div>

<style>
.navbar {
  overflow: hidden;
  background-color: #333;
  position: fixed;
  bottom: 0;
	left: 0;
	right: 0;
  width: 100%;
}

.navbar a {
	margin: 10px;
  display: block;
  color: #f2f2f2;
  text-align: center;
  text-decoration: none;
  font-size: 18px;
}
.dot_save {
  height: 50px;
  width: 50px;
  background-color: #0064b7;
  border-radius: 50%;
	color: #fff;
	float: right;
	text-align: -webkit-center;
	position: fixed;
	right: 15px;
	bottom: 130px;
}
.dot_edit {
  height: 50px;
  width: 50px;
  background-color: #1faa00;
  border-radius: 50%;
	color: #fff;
	float: right;
	text-align: -webkit-center;
	position: fixed;
	right: 15px;
	bottom: 70px;
}
.dot_cancel {
  height: 50px;
  width: 50px;
  background-color: #b71c1c;
  border-radius: 50%;
	color: #fff;
	float: right;
	text-align: -webkit-center;
	position: fixed;
	right: 15px;
	bottom: 70px;
}
</style>

<img src="assets/images/load_view.gif" id="loading" style="display: none; width: 10%; top: 5px; right: 5px; float: right; position: absolute; z-index: 999999;" />

<div id="optEdit" class="animated fadeIn">
		<span class='dot_save' style="display: none" onclick="window.location.href = 'ui-change-ticket.php?id=<?php echo $viewTicketId; ?>'; loading()"><i style='margin: 15px;' class='fa fa-file-signature'></i></span>

					<?php

						$select = "SELECT status FROM glpi_tickets where id = '$idSolicitacaoAtual'";
						$result = $conexao_glpi -> prepare($select);
						$result -> execute();
						$count = $result->rowCount();

						if ($data = $result->fetch()) {
							do {

								$statusIdSolicitada = $data['status'];

								if ($statusIdSolicitada != 5 && $statusIdSolicitada != 6) {
					?>

		<span class='dot_edit' onclick="solucao()"><i style='margin: 15px;' class='fa fa-check'></i></span>

					<?php 

								}
							} while($data = $result->fetch());
						}

					?>

</div>

<div id="optCancel" class="animated fadeIn" style="display: none;">

		<span class='dot_cancel' onclick="voltar()"><i style='margin: 15px;' class='fas fa-times'></i></span>

</div>

<?php

include("assets/includes/menu.php");

?>
</body>

<script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/moment.min.js"></script>

<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>

<!-- App js -->


<script src="assets/js/pikeadmin.js"></script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

function alertCloseTicket() {

$(document).ready(function(){

       swal("Feito!", "Solicitação finalizada com sucesso!", "success");

});
};

$('#btnExit').click(function(){
		 swal({
			title: "Sair do app?",
			text: "Sua sessão será fechada!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				return location.href="?sair";
			} else {
				return false;
			;
			}
		});
	});

</script>

<!-- BEGIN Java Script for this page -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>

	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<!-- END Java Script for this page -->
<script src="assets/plugins/trumbowyg/trumbowyg.min.js"></script>
<script>
$(document).ready(function () {
    'use strict';
	$('.editor').trumbowyg();
});
</script>

<script src="assets/plugins/ion-rangeslider/ion.rangeSlider.min.js"></script>
<script>
$(function () {
    $("#range_slider").ionRangeSlider({
    	min: 0,
        max: 300
    });
});
</script>

<script>

// Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
      &&
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });

</script>
</html>
