<?php

if(isset($_POST['livro'])) {
	 $livro = $_POST['livro'];
}

if(isset($_GET['livroTrue'])) {
	$livroTrue = $_GET['livroTrue'];
	$styleLivro = "display: block";
	$home       = "display: none";
} else {
	$styleLivro = "display: none";
	$home        = "display: block";
}

if(isset($_GET['livro'])) {
	$livro      = $_GET['livro'];
	$styleVersi = "display: block";
	$styleLivro = "display: none";
} else {
	$styleVersi = "display: none";
	$styleLivro = "display: block";
}

if(isset($_GET['capitulo'])) {
	$capitulo = $_GET['capitulo'];
}

require('assets/includes/session.php');

if ($redefineSenha == 1) {echo "<script>window.location='ui-new-password.php?id=$idUsuario'</script>";}

?>
<!DOCTYPE html>
<html lang="en" style="overflow-x: hidden!important; ">

<head>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1, user-scalable=no">
	<title>PIB Paranaguá</title>

	<!-- Favicon -->
		<link rel="shortcut icon" href="../images/logo.png">

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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fmask/3.3.4/jquery.inputmask.bundle.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js" integrity="sha256-CIc5A981wu9+q+hmFYYySmOvsA3IsoX+apaYlL0j6fg=" crossorigin="anonymous"></script>
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
	    background-color: #3f51b5!important;
	    border-radius: 2px;
	}

	.ver_capitulo {
		margin-top: 0;
		display: inline-block;
		margin-bottom: 1rem;
		padding: 20px;
	}

	.ver_versiculo {
		margin-top: 0;
		display: inline-block;
		margin-bottom: 1rem;
		padding: 10px;
	}

	</style>

	<?php require('assets/includes/menuBar.php'); ?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 animated fadeIn" id="navSolicitacao">
		<div class="card mb-3" style="background: transparent; box-shadow: none;">

			<div class="card-header top_dark">
				<div style="float: left; z-index: 1" onclick="viewMenuBar()">
					<i style="display: inline-flex;" id="btnMenuBar" class="fa fa-2x fa-bars"></i>
				</div>
				<div style="width: 70%; margin-left: 12%;position: absolute; z-index: 0">
					<strong><h5 class="titleBar">Bíblia</h5></strong>
				</div>
			</div>

			<div class="card-body background_dark" style="border: 0; width: 100%; padding: 0px; margin: 0!important">

				<?php

				if(!isset($_POST['livro']) && $livroTrue != 1) {

					echo "
					<div class='card-dark animated fadeIn' id='versiculoDia'>
						<div class='modal-content'>
							<form action='?livroTrue=1' method='post'>
							<div class='modal-header'>
								<h5 class='modal-title'>Livro</h5>
								<button type='button' class='close' style='color: #fff'  onclick=window.location.href='ui-bible.php' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
								</button>
							</div>
							<div class='modal-body'>

									<div class='form-group'>
										<select class='form-control' style='color: #b0b3b8' name='livro' id='livro'>
										<option value='0'>Selecione...</option>
					";

					$select = "SELECT liv_id, liv_nome from livros ORDER BY liv_id ASC";
					$result = $conexao -> prepare($select);
					$result -> execute();
					$count = $result->rowCount();

					if ($data = $result -> fetch()) {
						do {

							$idLivro = $data['liv_id'];
							$livroTxt = utf8_encode($data['liv_nome']);

							echo "<option value='$idLivro'>$livroTxt</option>";

						} while ($data = $result -> fetch());
					}

					echo "
										</select>
									</div>

							</div>
							<div class='modal-footer'>
								<button  id='btnSend' type='submit' class='btn btn-success'>Próximo</button>
							</div>
							</form>
						</div>
					</div>

					";

				} else if(isset($_POST['livro'])) {

					echo "
					<div class='card-dark animated fadeIn' id='versiculoDia' style='$styleLivro'>
						<div class='modal-content' style='background-color: #18191a!important;'>
							<div class='modal-header'>
								<h5 class='modal-title'>Capítulo</h5>
								<button type='button' class='close' style='color: #fff'  onclick=window.location.href='ui-bible.php' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
								</button>
							</div>
							<div class='modal-body'>

									<div class='form-group'>
									<center>

					";

					$select = "SELECT DISTINCT ver_capitulo from versiculos WHERE ver_liv_id = '$livro' ORDER BY ver_capitulo ASC";
					$result = $conexao -> prepare($select);
					$result -> execute();
					$count = $result->rowCount();

					if ($data = $result -> fetch()) {
						do {

							$idCapitulo = $data['ver_capitulo'];

							echo "<h5 class='ver_capitulo'><a href='?livroTrue=1&livro=$livro&capitulo=$idCapitulo'>$idCapitulo</a></h5>";

						} while ($data = $result -> fetch());
					}

					echo "
									</center>
									</div>

							</div>
						</div>
					</div>

					";

				}

				if(isset($_GET['livro']) && isset($_GET['capitulo'])) {

					echo "
					<div class='card-dark animated fadeIn' id='versiculoDia' style='$styleVersi'>
						<div class='modal-content' style='background-color: #18191a!important;'>
							<div class='modal-header'>
					";

					$select = "SELECT ver_id, ver_liv_id, ver_capitulo, ver_versiculo, ver_texto FROM versiculos WHERE ver_liv_id = '$livro' and ver_capitulo = '$capitulo' LIMIT 1 ";
					$result = $conexao -> prepare($select);
					$result -> execute();
					$count = $result->rowCount();

					if ($data = $result -> fetch()) {
						do {

							$ver_liv_id  = $data['ver_liv_id'];
							$ver_id      = $data['ver_id'];
							$idCapitulo  = $data['ver_capitulo'];
							$idVersiculo = $data['ver_versiculo'];
							$ver_texto   = utf8_encode($data['ver_texto']);

							$selectLiv = "SELECT liv_nome FROM livros WHERE liv_id = '$ver_liv_id'";
							$resultLiv = $conexao -> prepare($selectLiv);
							$resultLiv -> execute();
							$countLiv = $result->rowCount();

							if ($dataLiv = $resultLiv -> fetch()) {
								do {

									$liv_nome  = utf8_encode($dataLiv['liv_nome']);

								} while ($dataLiv = $resultLiv -> fetch());
							}

							echo "
									<h5 class='modal-title'>$liv_nome $idCapitulo</h5>
							";

						} while ($data = $result -> fetch());
					}


					echo "
								<button type='button' class='close' style='color: #fff' onclick=window.location.href='ui-bible.php' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
								</button>
							</div>
							<div class='modal-body'>

									<div class='form-group'>

					";

					$select = "SELECT ver_id, ver_versiculo, ver_texto from versiculos WHERE ver_capitulo = '$capitulo' && ver_liv_id = '$livro' ORDER BY ver_id ASC";
					$result = $conexao -> prepare($select);
					$result -> execute();
					$count = $result->rowCount();

					if ($data = $result -> fetch()) {
						do {

							$ver_id      = $data['ver_id'];
							$idVersiculo = $data['ver_versiculo'];
							$ver_texto   = utf8_encode($data['ver_texto']);

							echo "<h5 class='ver_versiculo'><p style='font-size: 12px; margin-bottom: 0; float: left;'>$idVersiculo</p> &nbsp;&nbsp; $ver_texto</h5>";

						} while ($data = $result -> fetch());
					}

					echo "
									</div>

							</div>
						</div>
					</div>

					";

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
<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>

<script src="https://cdn.rawgit.com/FezVrasta/snackbarjs/1.1.0/dist/snackbar.min.js"></script>

<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>

<script src="assets/plugins/jquery.filer/js/jquery.filer.min.js"></script>

<script src="assets/js/pikeadmin.js"></script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
