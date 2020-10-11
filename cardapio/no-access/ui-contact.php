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
</style>

<script>

function loading() {
	document.getElementById("loading").style.display = "block";
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

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 animated fadeIn" id="navInformacoes">
		<div class="card mb-3" style="background: transparent; border: 0;">
			<div class="card-header">

					<strong><h5 style="margin-bottom: 0;"><i class="fas fa-info-circle"></i> Informações</h5></strong>

			</div>
			<div class="card-body">

				<?php

					$select = "SELECT glpi_users.id, glpi_users.firstname, glpi_users.realname, glpi_users.picture FROM glpi_users
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
							$idTec    = $data['id'];
							$nomeTec  = utf8_encode($data['firstname']." ".$data['realname']);
							$nomeSearchTec  = utf8_encode($data['firstname']);
							$thumbTec = $data['picture'];

							//Seleciona informações de contato
							$selectContatoTec = "SELECT * from agenda where nome like '%$nomeSearchTec%'";
							$resultContatoTec = $conexao_contatos -> prepare($selectContatoTec);
							$resultContatoTec -> execute();
							$countContatoTec = $resultContatoTec->rowCount();

							if ($dataContatoTec = $resultContatoTec->fetch()) {
								do {

									$telefone  = $dataContatoTec['telefone'];
									$comercial = $dataContatoTec['comercial'];
									$celular   = $dataContatoTec['celular'];
									$celular2  = $dataContatoTec['celular2'];
									$emailTec  = $dataContatoTec['email'];

								} while ($dataContatoTec = $resultContatoTec->fetch());
							}

				?>

				<div class="card mb-3" style="background: transparent; ">
					<div class="card-header" style="padding-bottom: 0;">

						<a data-fancybox="gallery" style="padding: 0; display: -webkit-inline-box;" href="../helpdesk/files/_pictures/<?php echo $thumbTec; ?>?image=<?php echo $idTec; ?>">
							<img alt="image" class="img-fluid" src="../helpdesk/files/_pictures/<?php echo $thumbTec; ?>?image=<?php echo $idTec; ?>" style="height: 36px; width: 36px; margin-bottom: 5px; border-radius: 50%; display: -webkit-inline-box;" />
						<div class="clearfix"></div>
						</a>
						<strong><p style="display: -webkit-inline-box;"> <?php echo $nomeTec; ?></p></strong>
					</div>
					<div class="card-body" style="font-size: small;">
						<?php if ($telefone) { ?><p><strong>Telefone:</strong> <?php echo $telefone; ?></p><?php } ?>
						<?php if ($comercial) { ?><p><strong>Comercial:</strong> <?php echo $comercial; ?></p><?php } ?>
						<?php if ($celular) { ?><p><strong>Celular:</strong> <?php echo $celular; ?></p><?php } ?>
						<?php if ($celular2) { ?><p><strong>Celular:</strong> <?php echo $celular2; ?></p><?php } ?>
						<?php if ($emailTec) { ?><p><strong>Email:</strong> <?php echo $emailTec; ?></p><?php } ?>
					</div>
				</div>

					<div class="clearfix"></div>
				<?php
						} while ($data = $result->fetch());
					}
				?>

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

function alertNewRequest() {

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
