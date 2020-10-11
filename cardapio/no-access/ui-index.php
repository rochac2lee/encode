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

	<!-- <script src="assets/js/jquery.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.js"></script>
</head>

<body style="background-color: #ffffff; z-index: 1000000000;">

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
	.sugestoes {
		width: 100%;
		height: 100%;
		background: #000000a6;
		position: absolute;
		z-index: 1;
		text-align: center;

	}
</style>

<script>

function loading() {
	document.getElementById("loading").style.display = "block";
}

</script>

<div class="animated fadeIn sugestoes" id="sugestoes">

		<i onclick="document.getElementById('sugestoes').style.display = 'none'" style="color: #fff; position: fixed; right: 15px; top: 15px;" class="fa fa-times"></i>
		<div class="col-md-12" style="position: fixed; top: 15%!important">

				<h5 style="color: #fff; margin-bottom: 5%">Sugestões</h5>

				<?php

				$sugestoes = ["'Câmeras Offline'",
											"'Impressora com defeito'",
											"'Problemas com Cancela'",
											"'Caminhão 25 metros'",
											"'Falha na Captura do OCR'",
											"'Falha no Controle de Acesso'"];

				$inputSug = "'motivo'";
				$divSug = "'sugestoes'";
				$disableSug = "'none'";

				for($i = 0; $i < count($sugestoes); $i++) {
					 echo '<button style="margin: 5px" class="btn btn-info" onclick="document.getElementById('.$inputSug.').value=';
					 echo $sugestoes[$i];
					 echo '; document.getElementById('.$divSug.').style.display = '.$disableSug.'">';
					 echo $sugestoes[$i];
					 echo '</button><br>';
				}

				?>

		</div>
</div>


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

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 animated fadeIn" id="navSolicitacao">
		<div class="card mb-3" style="background: transparent; border: 0;">
			<div class="card-header">

<?php if ($countAdmin > 0) { ?>
					<strong><h5 style="margin-bottom: 0;"><i class="fas fa-plus"></i> Atendimento</h5></strong>
<?php } else { ?>
					<strong><h5 style="margin-bottom: 0;"><i class="fas fa-plus"></i> Atendimento para <?php echo $nomeUsuario; ?></h5></strong>
<?php } ?>
			</div>
			<div class="card-body">
					<form action="assets/functions/newTicket.php?id_usuario=<?php echo $idUsuario; ?>&nome_solicitante=<?php echo $nomeUsuario; ?>&email_usuario=<?php echo $emailUsuario; ?>" name="newTicket" id="newTicket" method="post">

						<div class="row">

							<div class="col-lg-2">
							<div class="form-group">
							<label>Data e Hora da Solicitação</label>
							<input readonly class="form-control" type="text" name="data_criacao" value="<?php echo $dateTime; ?> " />
							<input readonly style="display: none" class="form-control" type="text" name="data_criacao_glpi" value="<?php echo $dateTimeGLPI; ?> " />
							</div>
							</div>

							<div class="col-lg-2">
							<div class="form-group">
							<label>Setor *</label>

							<select class="form-control" name="setor" required="">
								<option>Selecione...</option>

							<?php

								$select = "SELECT id, name FROM glpi_locations
													 where locations_id = 0 order by name ASC";
								$result = $conexao_glpi -> prepare($select);
								$result -> execute();
								$count = $result->rowCount();

								if ($data = $result->fetch()) {
									do {
										$idLocal = $data['id'];
										$local   = utf8_encode($data['name']);
							?>
								<option value="<?php echo $idLocal; ?>"><?php echo $local; ?></option>
							<?php
									} while ($data = $result->fetch());
								}
							?>
							</select>
							</div>
							</div>

<?php

if ($countAdmin > 0) {

?>

							<div class="col-lg-2">
							<div class="form-group">
							<label>Solicitante *</label>

							<select class="form-control" name="solicitante" required="">
								<option value="0">Selecione...</option>

							<?php

								$select = "SELECT id, firstname, realname FROM glpi_users
													 where id != '$idUsuario' and employee = 1 order by firstname ASC";
								$result = $conexao_glpi -> prepare($select);
								$result -> execute();
								$count = $result->rowCount();

								if ($data = $result->fetch()) {
									do {
										$idSolicitante = $data['id'];
										$solicitante   = utf8_encode($data['firstname']." ".$data['realname']);
							?>
								<option value="<?php echo $idSolicitante; ?>"><?php echo $solicitante; ?></option>
							<?php
									} while ($data = $result->fetch());
								}
							?>
							</select>
							</div>
							</div>

							<div class="col-lg-2">
							<div class="form-group">
							<label>Técnico *</label>

							<select class="form-control" name="tecnico" required="">
								<option value="0">Selecione...</option>

							<?php

								$select = "SELECT glpi_users.id, glpi_users.firstname, glpi_users.realname FROM glpi_users
													 INNER JOIN
													  	glpi_groups_users
												   ON
													 		glpi_users.id = glpi_groups_users.users_id
													 order by firstname ASC";
								$result = $conexao_glpi -> prepare($select);
								$result -> execute();
								$count = $result->rowCount();

								if ($data = $result->fetch()) {
									do {
										$id   = $data['id'];
										$nome = utf8_encode($data['firstname']." ".$data['realname']);
							?>
								<option value="<?php echo $id; ?>"><?php echo $nome; ?></option>
							<?php
									} while ($data = $result->fetch());
								}
							?>
							</select>
							</div>
							</div>

							<div class="col-lg-2">
							<div class="form-group">
							<label>Tipo *</label>

							<select class="form-control" name="tipo" id="tipo" onchange="viewTransporte()" required="">
								<option>Selecione...</option>

							<?php

								$select = "SELECT id, name FROM glpi_itilcategories
													 where	itilcategories_id = 5
													 order by name ASC";
								$result = $conexao_glpi -> prepare($select);
								$result -> execute();
								$count = $result->rowCount();

								if ($data = $result->fetch()) {
									do {
										$idTipo = $data['id'];
										$tipo   = utf8_encode($data['name']);
							?>
								<option value="<?php echo $idTipo; ?>"><?php echo $tipo; ?></option>
							<?php
									} while ($data = $result->fetch());
								}
							?>
							</select>
							</div>
							</div>

							<script>

							function viewTransporte(){
								var x = document.getElementById('tipo').value;

								if (x == 8) {
									document.getElementById('transporte').style.display = "block";
								} else {
									document.getElementById('transporte').style.display = "none";
								}
							}
							</script>

							<div class="col-lg-2" id="transporte" style="display: none;">
							<div class="form-group">
							<label>Transporte</label>
							<p>Quando necessário ir até a empresa</p>

							<select class="form-control" name="transporte">
								<option>Selecione...</option>

								<option value="1">Veículo Particular</option>
								<option value="2">Transporte Público</option>
								<option value="3">Pela Empresa</option>

							</select>
							</div>
							</div>

<?php

}

?>

							<div class="col-lg-2">
							<div class="form-group">
							<label>Motivo *</label>
							<input class="form-control" type="text" name="motivo" id="motivo" required="" />
							</div>
							</div>

							<div class="col-lg-2">
							<div class="form-group">
							<label>Descrição *</label>
							<textarea class="form-control" type="text" name="descricao" required=""></textarea>
							</div>
							</div>

					</div>
					<div class="clearfix"></div>
					<div class="modal-footer" style="padding-left: 0; padding-right: 0;">

<?php

if ($countAdmin > 0) {

?>

							<div class="col-lg-2">
								<fieldset class="form-group">

										<div class="form-check">
											<label class="form-check-label">
											<input type="checkbox" class="form-check-input" value="1" name="solicitante_presente" id="solicitante_presente">
											O Solicitante não encontra-se na empresa no momento.
										</label>
										</div>

								</fieldset>
							</div>

<?php

}

?>

						<script type="text/javascript">
						function verificaNewTicket(){
							if (document.newTicket.motivo.value == ""){
								return false;
							} else {
								document.newTicket.submit();
								document.getElementById('cadTicket').style.visibility = 'hidden';
								document.getElementById('cadTicket').style.display = 'none';
								alertNewTicket();
							}
						}
						</script>
						<button type="submit" class="btn btn-success" onclick="verificaNewTicket()" id="cadTicket"><i class="fa fa-save"></i>&nbsp; Salvar</button>
					</div>
					<div class="clearfix"></div>
					</form>
			</div>
		</div>
	</div>

</div>

<img src="assets/images/load_view.gif" id="loading" style="display: none; width: 10%; top: 5px; right: 5px; float: right; position: absolute; z-index: 999999;" />

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

function alertNewTicket() {

$(document).ready(function(){

       swal("Feito!", "Sua Solicitação foi enviada com sucesso!", "success");

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
