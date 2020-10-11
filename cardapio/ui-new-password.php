<?php

if (isset($_GET['id'])) {
		$id   = $_GET['id'];
}

require('assets/includes/session.php');

?>
<!DOCTYPE html>
<html lang="en" style="overflow-x: hidden!important; ">

<head>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1, user-scalable=no">
	<title>PIB Paranaguá</title>

	<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/icon_app.png">

	<meta name="author" content="Cleber Lee da Rocha">

	<!-- Font Icon css -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<!-- Effect Animate css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css" integrity="sha256-gVCm5mRCmW9kVgsSjQ7/5TLtXqvfCoxhdsjE6O1QLm8=" crossorigin="anonymous" />

	<!-- Style CSS -->
	<link href="assets/css/style.css" rel="stylesheet" type="text/css" />

	<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">

	<!-- Alerts Switchery css -->
	<link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

	<!-- Edit TextArea css -->
	<link rel="stylesheet" href="assets/plugins/trumbowyg/ui/trumbowyg.min.css">

	<!-- Media Fancybox -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
	<link href="assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
	<link href="assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Share+Tech&display=swap" rel="stylesheet">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.js"></script>


</head>

<body class="background_dark" style="z-index: 1000000000;">

<div class="row">

<style>

.snackbar-content {
    display: block;
    padding: .8rem 1.5rem;
    margin-top: 3px;
    font-size: .9rem;
    color: #fff;
    background-color: transparent!important;
    border-radius: 2px;
}


</style>

	<?php

	if ($redefineSenha == 0) {

	require('assets/includes/menuBar.php');

	?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 animated fadeIn" id="navSolicitacao">
		<div class="card mb-3" style="background: transparent; box-shadow: none;">

			<div class="card-header top_dark">
				<div style="float: left; z-index: 1" onclick="viewMenuBar()">
					<i style="display: inline-flex;" id="btnMenuBar" class="fa fa-2x fa-bars"></i>
				</div>
				<div style="width: 70%; margin-left: 12%;position: absolute; z-index: 0">
					<strong><h5 class="titleBar">Nova Senha</h5></strong>
				</div>
			</div>
	<?php

	} else {

	?>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 animated fadeIn" id="navSolicitacao">
		<div class="card mb-3" style="background: transparent; box-shadow: none;">

			<div class="card-header top_dark">
					<center><strong><h5 id="titulo" style="margin-bottom: 0;">Nova Senha</h5></strong></center>
			</div>
	<?php

	}

	?>
			<div class="card-body background_dark animated fadeInRight" style="border: 0;">
					<form action="assets/functions/updatePass.php?idUsuario=<?php echo $id; ?>&admin=<?php echo $admin; ?>" name="newPassword" id="newPassword" method="post">

						<div class="row">

							<center><img style="width: 30%" src="assets/images/pass.png"></center>

							<div class="col-lg-2">

							<div class="alert alert-danger animated fadeIn" role="alert" id="alerta" style="margin-top: 30px; display: none;">
								<strong>Tente Novamente!</strong> <br> As Senhas precisam ser Idênticas.
							</div>

							<div class="form-group">
						    <label for="senha" class="bmd-label-floating">Senha</label>
						    <input type="password" class="form-control" id="senha" name="senha">
						    <span class="bmd-help">Campo Obrigatório</span>
						  </div>
							</div>

							<div class="col-lg-2">
							<div class="form-group">
						    <label for="confirmarSenha" class="bmd-label-floating">Confirmar Senha</label>
						    <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha">
						    <span class="bmd-help">Campo Obrigatório</span>
						  </div>
							</div>

					</div>

					<div class="clearfix"></div>
					<div class="modal-footer" style="border-top:0; padding-left: 0; padding-right: 0;">

						<script type="text/javascript">
							function verificaSenha(){
								if ($('#senha').val() != $('#confirmarSenha').val()){
									document.getElementById('senha').value = '';
									document.getElementById('confirmarSenha').value = '';

									document.getElementById('snackbar-container').style.backgroundColor = "#f44336";
									document.getElementById('cadSenha').setAttribute("data-content", "<strong>Tente Novamente!</strong><br>As senhas precisam ser iguais!");

									setTimeout(() => {
											$('.snackbar-opened').remove();
									}, 5000);

									return false;
								} else {
									document.getElementById('senha').readOnly = 'true';
									document.getElementById('confirmarSenha').readOnly = 'true';

									document.getElementById('snackbar-container').style.backgroundColor = "#4caf50";
									document.getElementById('cadSenha').style.visibility = 'hidden';
									document.getElementById('cadSenha').style.display = 'none';
									document.getElementById('cadSenha').setAttribute("data-content", "Senha alterada com Sucesso!");

									setTimeout(() => {
											document.newPassword.submit();
									}, 3000);

								}
							}
						</script>
						<button type="button" class="btn btn-success" data-toggle="snackbar" data-content="" data-html-allowed="false" data-timeout="0" onclick="verificaSenha()" id="cadSenha"><i class="fa fa-save"></i>&nbsp; Salvar</button>
					</div>
					<div class="clearfix"></div>
					</form>
			</div>
		</div>
	</div>

</div>

<style>
.dot_new {
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
</style>

<img src="assets/images/load_view.gif" id="loading" style="display: none; width: 10%; top: 5px; right: 5px; float: right; position: absolute; z-index: 999999;" />

<?php

if ($redefineSenha == 0) {
	include("assets/includes/menu.php");
}
?>

</body>

<script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/moment.min.js"></script>

<script src="assets/js/popper.min.js"></script>
<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>

<script src="https://cdn.rawgit.com/FezVrasta/snackbarjs/1.1.0/dist/snackbar.min.js"></script>

<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/pikeadmin.js"></script>

<script>
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
