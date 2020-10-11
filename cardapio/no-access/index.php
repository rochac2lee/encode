<?php
ob_start();
session_start();
if (isset($_SESSION['usuario_appcimbessul']) && (isset($_SESSION['senha_appcimbessul']))){
	header("Location: ui-index.php"); exit;
}
include("assets/includes/conexao.php");

$dateTime     = date('d/m/Y H:i:s');
$dateTimeGLPI = date('Y-m-d H:i:s');

?>
<!DOCTYPE html>
<html lang="en">

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

<body style="background-color: #ffffff;">

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

function formNoInternet() {
	document.getElementById('navHome').style.display = "none";
	document.getElementById('navProfile').style.display = "none";
	document.getElementById('formNoInternet').style.display = "block";
}

function viewProfile() {
	document.getElementById('navHome').style.display = "none";
	document.getElementById('navProfile').style.display = "block";
	document.getElementById('formNoInternet').style.display = "none";
}

function viewHome() {
	document.getElementById('navHome').style.display = "block";
	document.getElementById('navProfile').style.display = "none";
	document.getElementById('formNoInternet').style.display = "none";
}

</script>


<div class="col-md-4 about-right animated fadeIn" style="margin: auto; max-width: 450px; top: 70px; right: 0; bottom: 0; left: 0;" id="navHome">
	<div class="form-body">
		<div style="border-color: #929292; border-radius: 7px;  margin: 15px;">
			<center><img style="width:70%; margin-top:10px; margin-bottom: 40%;" src="assets/images/logohz.png" />
				<br>
				<strong><h3>A empresa está sem acesso a internet?</h3></strong>
				<br>

				<a role="button" href="http://www.cimbessul.com.br/helpTI" class="btn btn-success"><span class="btn-label"><i class="fas fa-check"></i></span> Não</a>
				&nbsp;&nbsp;
				<a role="button" href="javascript:void(0)" onclick="viewProfile()" class="btn btn-danger"><span class="btn-label"><i class="fas fa-exclamation-triangle"></i></span> Sim</a>

			</center>

		</div>
	</div>
</div>

<div class="col-md-4 about-right animated fadeIn" style="margin: auto; max-width: 450px; top: 70px; right: 0; bottom: 0; left: 0; display:none" id="navProfile">
	<div class="form-body">
		<div style="border-color: #929292; border-radius: 7px;  margin: 15px;">
			<center><img style="width:70%; margin-top:10px; margin-bottom: 40%;" src="assets/images/logohz.png" />
				<br>
				<strong><h3>Perfil de Acesso</h3></strong>
				<br>

				<a role="button" href="javascript:void(0)" onclick="formNoInternet()" class="btn btn-info"><span class="btn-label"><i class="fas fa-users"></i></span> Usuário</a>
				&nbsp;&nbsp;
				<a role="button" href="javascript:void(0)" onclick="viewScreenTecnico()" class="btn btn-info"><span class="btn-label"><i class="fas fa-user"></i></span> Técnico</a>

			</center>

		</div>
	</div>
</div>

<div class="row" id="formNoInternet" style="display: none">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 animated fadeIn" id="navSolicitacao">
		<div class="card mb-3" style="background: transparent; border: 0;">
			<div class="card-header">

					<strong><h5 style="margin-bottom: 0;"><i class="fas fa-exclamation-triangle"></i>&nbsp; Atendimento</h5></strong>

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
							<label>Nome *</label>
							<input class="form-control" type="text" name="solicitante" id="solicitante" required="" />
							</div>
							</div>

							<div class="col-lg-2">
							<div class="form-group">
							<label>Setor *</label>

							<select class="form-control" name="setor" required="">
								<option>Selecione...</option>

							<?php

								$select = "SELECT id, name FROM tb_setores
													 where locations_id = 0 order by name ASC";
								$result = $conexao -> prepare($select);
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

</div>


<footer class="footer">
		<center>
		Desenvolvido por <a target="_blank" href="#">TI Cimbessul S.A.</a>
		</center>
</footer>

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

function alertSendMsg() {

$(document).ready(function(){

       swal("Mensagem Enviada!", "Sua Mensagem foi enviada com sucesso!", "success");

});
};

function alertCadRecAz() {

$(document).ready(function(){

       swal("Gráfico Atualizado!", "Suas informações foram inseridas no gráfico com sucesso!", "success");

});
};

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
