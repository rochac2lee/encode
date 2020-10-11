<?php

require('assets/includes/session.php');

if ($redefineSenha == 1) {echo "<script>window.location='ui-new-password.php?id=$idUsuario'</script>";}

?>

<?php require('assets/includes/header.php'); ?>

<body class='background_dark' style='z-index: 1000000000;'>

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

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 animated fadeIn" id="navSolicitacao">
		<div class="card mb-3" style="background: transparent; box-shadow: none;">

			<div class="card-header" style="color: #ffc617; font-size: 20px;">
				<div style="float: left; z-index: 1" onclick="viewMenuBar()">
					<i style="display: inline-flex; color: #ffc617; font-size: 23px;" id="btnMenuBar" class="fa fa-bars"></i>
				</div>
				<div style="width: 70%; margin-left: 12%;position: absolute; z-index: 0">
					<strong><h5 class="titleBar">Lemarde Petisco</h5></strong>
				</div>
			</div>

			<div style="display: block">
					<div class="tab-content background_dark" id="nav-tabContent">
					  <div class="col-md-12 tab-pane fade show active" id="nav-noticias" role="tabpanel" aria-labelledby="nav-noticias-tab">


								<img src="assets/images/Banner.png" style="width: 100%; margin-bottom: 15px">

								<img src="assets/images/iconeapp01.png" style="width: 20%; border-radius: 50%; float: left;">
								<h5 style="margin: 2% 0px 0px 6px; float: left;">Lemarde Combo</h5>
								<p>Onion Rings, Batata Frita com Bacon e Cheddar, Calabresa Acebolada e Frango. Acompanhamentos: Molho de Alho e ovo de codorna</p>



						</div>
					  <div class="tab-pane fade" id="nav-devocionais" role="tabpanel" aria-labelledby="nav-devocionais-tab">

							<div class="card-body background_dark animated fadeInRight" style="border: 0; display: none" id="newDevocional">
									<form action="assets/functions/newDevotional.php?idUsuario=<?php echo $idUsuario; ?>" name="frmDevotional" id="frmDevotional" method="post" enctype="multipart/form-data">

										<div class="row">

											<div class="col-lg-2" style="padding: 0">

												<div id="banner_image">
													<center>
													<label for="upload">
																<img src="assets/images/picture.png" class="animated fadeIn" id="bannerDevocional" style="object-fit: cover; width: 60%; height: 150px">
																<input type="file" id="upload" onchange="preview_image(event)" name="uploadBanner[]" style="display:none">
													</label>
												</center>

												<script type='text/javascript'>
													function preview_image(event) {
													 var reader = new FileReader();
													 reader.onload = function() {
														var output = document.getElementById('bannerDevocional');
														document.getElementById('bannerDevocional').style.width = '100%';
														document.getElementById('bannerDevocional').style.height = '200px';
														output.src = reader.result;
													 }
													 reader.readAsDataURL(event.target.files[0]);
													}
												</script>

												</div>

												<div class="form-group">
													<label for="titulo" class="bmd-label-floating">Título</label>
													<input type="text" class="form-control" id="titulo" name="titulo">
													<span class="bmd-help">* Campo Obrigatório</span>
												</div>

												<div class="form-group">
													<label for="textoBiblico" class="bmd-label-floating">Texto Bíblico</label>
													<input type="text" class="form-control" id="textoBiblico" name="textoBiblico">
												</div>

												<div class="form-group">
													<textarea class="form-control autoExpand editor" rows="3" data-min-rows="3" id="texto" name="texto" placeholder="Escreva aqui o texto devocional"></textarea>
												</div>

												<div class="form-group">
													<label for="autor" class="bmd-label-floating">Autor</label>
													<input type="text" class="form-control" id="autor" name="autor">
												</div>

											</div>

									</div>

									<div class="clearfix"></div>
									<div class="modal-footer" style="border-top:0; padding-left: 0; padding-right: 0;">

										<script type="text/javascript">
											function verificaDevotional(){
												if ($('#titulo').val() == '' || $('#texto').val() == '' || $('#autor').val() == ''){

													document.getElementById('snackbar-container').style.backgroundColor = "#f44336";
													document.getElementById('cadDevotional').setAttribute("data-content", "<strong>Atenção! </strong><br>Campos Obrigatórios!");

													setTimeout(() => {
															$('.snackbar-opened').remove();
													}, 5000);

													return false;
												} else {
													document.getElementById('titulo').readOnly = 'true';
													document.getElementById('texto').readOnly = 'true';
													document.getElementById('autor').readOnly = 'true';

													document.getElementById('snackbar-container').style.backgroundColor = "#4caf50";
													document.getElementById('cadDevotional').style.visibility = 'hidden';
													document.getElementById('cadDevotional').style.display = 'none';
													document.getElementById('cadDevotional').setAttribute("data-content", "Devocional publicado com Sucesso!");

													setTimeout(() => {
															document.frmDevotional.submit();
													}, 3000);

												}
											}
										</script>
										<button type="button" class="btn btn-success" data-toggle="snackbar" data-content="" data-html-allowed="false" data-timeout="0" onclick="verificaDevotional()" id="cadDevotional"><i class="fa fa-save"></i>&nbsp; Salvar</button>
									</div>
									<div class="clearfix"></div>
									</form>
							</div>

						</div>
					  <div class="tab-pane fade" id="nav-avisos" role="tabpanel" aria-labelledby="nav-avisos-tab">
							<?php

								echo "<center><img src='assets/images/info.png' style='margin-top: 25%; width:60%'><br><br><p style='color: #b0b3b8;'>Aguardando Atualizações!</p></center>";

							?>
						</div>
					</div>
			</div>
		</div>
	</div>

</div>

<img src="assets/images/load_view.gif" id="loading" style="display: none; width: 10%; top: 5px; right: 5px; float: right; position: absolute; z-index: 999999;" />

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
