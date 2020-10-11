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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fmask/3.3.4/jquery.inputmask.bundle.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js" integrity="sha256-CIc5A981wu9+q+hmFYYySmOvsA3IsoX+apaYlL0j6fg=" crossorigin="anonymous"></script>

	<script type="text/javascript">

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

		</script>

</head>

<?php

$select = "SELECT * from devocionais ORDER BY id DESC";
$result = $conexao -> prepare($select);
$result -> execute();
$count = $result->rowCount();

echo "<body class='background_dark' style='z-index: 1000000000;'>";

?>

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

	textarea {
		overflow:hidden;
		width:250px;
	}

	textarea::placeholder {
  	color: #fff!important;
	}

	.trumbowyg-button-pane {
		display: none;
	}

	</style>

	<?php require('assets/includes/menuBar.php'); ?>

	<script>

	function viewVersiculoDia() {
		document.getElementById('home').style.display = 'none';
		document.getElementById('versiculoDia').style.display = 'block';
	}

	function viewNewDevotional() {
		document.getElementById('nav-noticias-tab').classList.remove('active');
		document.getElementById('nav-noticias').classList.remove('active');
		document.getElementById('nav-noticias').classList.remove('show');
		document.getElementById('nav-devocionais-tab').classList.add('active');
		document.getElementById('nav-devocionais').classList.add('active');
		document.getElementById('nav-devocionais').classList.add('show');
		document.getElementById('newDevocional').style.display = 'block';
	}

	function hideVersiculoDia() {
		document.getElementById('versiculoDia').style.display = 'none';
		document.getElementById('home').style.display = 'block';
	}

	</script>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 animated fadeIn" id="navSolicitacao">
		<div class="card mb-3" style="background: transparent; box-shadow: none;">

			<div class="card-header top_dark">
				<div style="float: left; z-index: 1" onclick="viewMenuBar()">
					<i style="display: inline-flex;" id="btnMenuBar" class="fa fa-2x fa-bars"></i>
				</div>
				<div style="width: 70%; margin-left: 12%;position: absolute; z-index: 0">
					<strong><h5 class="titleBar">Favoritos</h5></strong>
				</div>
			</div>

			<div style="display: block">
					<div class="tab-content background_dark" id="nav-tabContent">
					  <div class="tab-pane fade show active" style="padding: 0" id="nav-favoritos" role="tabpanel" aria-labelledby="nav-favoritos-tab">
							<?php

								echo "
									<div class='card-dark' id='home' style='background-color: #18191a!important; padding: 15px; padding-top: 0; $home'>
								";

								$select = "SELECT * FROM avaliacoes WHERE idUsuario = '$idUsuario'";
								$result = $conexao -> prepare($select);
								$result -> execute();
								$avaliacoes = $result->rowCount();

								if ($data = $result -> fetch()) {
									do {
										$nota             = $data['nota'];
										$comentario       = $data['comentario'];

										if ($comentario != "") {
											$texto = "<p style='float: left; margin-top: 10px; margin-bottom: 0'>Seu comentário: ".$comentario."</p>";
										}

										$dataHoraCadastro = $data['data_hora_cadastro'];

										$dataHoraCadastro = date("d/m/Y H:i", strtotime($dataHoraCadastro));

										echo "
												<div class='card-dark' style='margin-top: 15px; padding: 15px; border-left: 4px solid #ffd600; border-radius: 10px; box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 4px 4px 1px -2px rgba(255, 255, 255, 0.07), 3px 4px 5px 0 rgba(0,0,0,.12);'>
													<h5 style='margin-bottom: 0'><i class='fas fa-star' style='color: #ffd600!important'></i> Você avaliou o app com a nota $nota.0</h5>
													$texto
													<p style='float: right; margin-top: 10px; margin-bottom: 0'>$dataHoraCadastro</p>
													<div class='clearfix'></div>
												</div>
										";

									} while ($data = $result -> fetch());
								}

							$selectReacao = "SELECT * FROM reacoes WHERE idUsuario = '$idUsuario' and curtir = '1'";
							$resultReacao = $conexao -> prepare($selectReacao);
							$resultReacao -> execute();
							$reacoes = $resultReacao->rowCount();

							if ($dataReacao = $resultReacao -> fetch()) {
								do {
									$tipo   = $dataReacao['tipo'];
									$idItem = $dataReacao['idItem'];

									$dataHoraCadastro = $dataReacao['data_hora_cadastro'];

									$dataHoraCadastro = date("d/m/Y H:i", strtotime($dataHoraCadastro));

									if ($tipo == "versiculo") {

										$select = "SELECT ver_id, ver_liv_id, ver_capitulo, ver_versiculo, ver_texto FROM versiculos WHERE dailyVerse = '1' and ver_id = '$idItem' ORDER BY dailyVerseInc DESC";
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

														$item = 1;

														$liv_nome  = utf8_encode($dataLiv['liv_nome']);

													} while ($dataLiv = $resultLiv -> fetch());
												}

										echo "
												<div class='card-dark' style='margin-top: 15px; padding: 15px; border-left: 4px solid #3f51b5; border-radius: 10px; box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 4px 4px 1px -2px rgba(255, 255, 255, 0.07), 3px 4px 5px 0 rgba(0,0,0,.12);'>

													<h5>$liv_nome $idCapitulo:$idVersiculo</h5>
													<p style='float: left'>$ver_texto</p>
													<p style='float: right; margin-bottom: 0'>$dataHoraCadastro</p>
													<div class='clearfix'></div>

												</div>
										";

											} while ($data = $result -> fetch());
										}

									} else if ($tipo == "devocional") {

										$selectDev = "SELECT * from devocionais WHERE id = '$idItem' ORDER BY id DESC";
										$resultDev = $conexao -> prepare($selectDev);
										$resultDev -> execute();
										$countDev = $resultDev->rowCount();

										if ($dataDev = $resultDev -> fetch()) {
											do {

												$item = 2;

												$idDevocional     = $dataDev['id'];
												$tituloDevocional = $dataDev['titulo'];
												$bannerDevocional = $dataDev['banner'];
												$autorDevocional  = $dataDev['autor'];
												$dataDevocional   = date("d/m/Y", strtotime($dataDev['data_hora_cadastro']));
												$horaDevocional   = date("H:i", strtotime($dataDev['data_hora_cadastro']));

												echo "

												<div class='card-dark' onclick=window.location.href='ui-view-devotional.php?id=$idDevocional' style='margin-top: 15px; padding: 15px; border-left: 4px solid #3f51b5; border-radius: 10px; box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 4px 4px 1px -2px rgba(255, 255, 255, 0.07), 3px 4px 5px 0 rgba(0,0,0,.12);'>
													<h5 style='display: inline-block;'>$tituloDevocional</h5>
												";
												if ($bannerDevocional != "thumb.png") {
													echo "<img style='width: 100%; margin-bottom: 10px; object-fit: cover; height: 170px' src='assets/uploads/devocional/$bannerDevocional'>";
												}
												echo "
													<p style='float: left; margin-bottom: 0'>$autorDevocional</p>
													<p style='float: right; margin-bottom: 0'>$dataDevocional às $horaDevocional</p>
													<div class='clearfix'></div>
												</div>

												";

											} while($dataDev = $resultDev -> fetch());
										}

									} else if ($tipo == "live") {

										$selectLive = "SELECT * from lives WHERE id = '$idItem' ORDER BY id DESC";
										$resultLive = $conexao -> prepare($selectLive);
										$resultLive -> execute();
										$countLive = $resultLive->rowCount();

										if ($dataLive = $resultLive -> fetch()) {
											do {

												$liveId     = $dataLive['id'];
												$titulo     = $dataLive['titulo'];
												$banner     = $dataLive['banner'];
												$url        = $dataLive['url'];
												$statusLive    = $dataLive['status'];
												$statusCommentLive = $dataLive['statusComment'];
												$dataHoraLive   = date("d/m/Y H:i", strtotime($dataLive['dataHora']));
												$statusLive = $dataLive['status'];

												echo "

												<div class='card-dark' style='margin-top: 15px; padding: 15px; border-left: 4px solid #3f51b5; border-radius: 10px; box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 4px 4px 1px -2px rgba(255, 255, 255, 0.07), 3px 4px 5px 0 rgba(0,0,0,.12);'>
													<h5 style='display: inline-block;'>$titulo</h5>
													<iframe style='width: 100%; margin-bottom: 15px; height: 210px' src='$url' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
													<p style='float: right; margin-bottom: 0'>$dataHoraLive</p>
													<div class='clearfix'></div>
												</div>

												";

											} while($dataLive = $resultLive -> fetch());
										}

									}

								} while ($dataReacao = $resultReacao -> fetch());
							}

						?>
						</div>
					</div>
			</div>
		</div>
	</div>

</div>

<img src="assets/images/load_view.gif" id="loading" style="display: none; width: 10%; top: 5px; right: 5px; float: right; position: absolute; z-index: 999999;" />

<?php

include("assets/includes/menu.php");

?>

</body>

<script>

$(document)
    .one('focus.autoExpand', 'textarea.autoExpand', function(){
        var savedValue = this.value;
        this.value = '';
        this.baseScrollHeight = this.scrollHeight;
        this.value = savedValue;
    })
    .on('input.autoExpand', 'textarea.autoExpand', function(){
        var minRows = this.getAttribute('data-min-rows')|0, rows;
        this.rows = minRows;
        rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 16);
        this.rows = minRows + rows;
    });

</script>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

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
