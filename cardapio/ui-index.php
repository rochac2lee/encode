<?php

require('assets/includes/header.php');

if (!isset($_GET['cat']) || $_GET['cat'] == "") {
	$cat = 1;
} else {
	$cat = $_GET['cat'];
}

try {
	$conexaoDelivery = new PDO('mysql:host=opmy0018.servidorwebfacil.com:3306;dbname=rochac2lee_sistemaDelivery', 'rocha_delivery', 'qwerty@848625');
	$conexaoDelivery -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	echo 'Houve um Erro na conexao com o banco de dados: ' . $e -> getMessage();
}

$empresa = basename(__DIR__);

$select = "SELECT * from clientes_encode WHERE empresa LIKE '$empresa'";
$result = $conexaoDelivery -> prepare($select);
$result -> execute();
$count = $result->rowCount();
	if ($data = $result -> fetch()) {
		do {

			$idEmpresaAtual = $data['id'];
			$empresaAtual   = $data['empresa'];
			$bancoDB        = $data['bancoDB'];
			$usuarioDB      = $data['usuarioDB'];
			$senhaDB        = $data['senhaDB'];

			$nomeEmpresa = preg_replace('/[ -]+/' , '' , $empresaAtual);
			$nomeEmpresa = strtolower( preg_replace("[^a-zA-Z0-9-]", "-", strtr(utf8_decode(trim($nomeEmpresa)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")) );

			if (!file_exists($nomeEmpresa)) {
				mkdir($nomeEmpresa);
			}

			try {
				$conexao = new PDO("mysql:host=opmy0018.servidorwebfacil.com:3306;dbname=$bancoDB", "$usuarioDB", "$senhaDB");
				$conexao -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				echo 'Houve um Erro na conexao com o banco de dados: ' . $e -> getMessage();
			}

			$selectEmpresa = "SELECT logo_sistema from configs where nome_empresa LIKE '$empresaAtual' ORDER BY id_config DESC LIMIT 1";
			$resultEmpresa = $conexao -> prepare($selectEmpresa);
			$resultEmpresa -> execute();
				if ($dataEmpresa = $resultEmpresa -> fetch()) {
					do {

						$logo_sistema = $dataEmpresa['logo_sistema'];

					} while ($dataEmpresa = $resultEmpresa -> fetch());
				}

		} while ($data = $result -> fetch());
	}

	echo '

	<body class="background_dark" style="z-index: 1000000000;">

	<div class="row" style="margin-left: 0;">

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

	.snackbar-content {
	    display: block;
	    padding: .8rem 1.5rem;
	    margin-top: 3px;
	    font-size: .9rem;
	    color: #fff;
	    background-color: transparent!important;
	    border-radius: 2px;
		}

	.bmd-form-group {
    position: relative;
    padding-top: 0!important;
	}

	.nav-cat::-webkit-scrollbar {
	  display: none;
	}

	</style>

	';

 require('assets/includes/menuBar.php');


echo '

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 animated fadeIn" style="padding-left: 0;" id="navSolicitacao">
	<div class="card mb-3" style="background: transparent; box-shadow: none;">

		<div class="card-header top_dark">
			<div class="bar" onclick="viewMenuBar()">
				<i style="display: inline-flex;" id="btnMenuBar" class="fa fa-2x fa-bars"></i>
			</div>
			<div style="width: 70%; margin-left: 12%;position: absolute; z-index: 0">
				<center><img src="assets/images/logo.png" style="text-align: center; margin: -7px; margin-left: -15px; border-radius: 50%; width: 40px; "></center>
			</div>
		</div>

		<div class="card-body background_dark" style="border: 0; padding-top: 0;">
			<div class="row">
				<div class="owl-1 owl-carousel owl-theme" style="margin-bottom: 10px">
					<div class="item"><img class="d-block w-100" src="assets/images/Banner.png" alt="slide"></div>
					<div class="item"><img class="d-block w-100" src="assets/images/Banner02.png" alt="slide"></div>
					<div class="item"><img class="d-block w-100" src="assets/images/Banner03.png" alt="slide"></div>
					<div class="item"><img class="d-block w-100" src="assets/images/Banner04.png" alt="slide"></div>
				</div>


				<!-- dark -->
				<ul class="nav nav-tabs nav-cat background_dark" style="overflow-y: hidden; overflow-x: scroll; flex-wrap: unset;">

';


				$select = "SELECT * FROM categorias where status = 1 order by id ASC";

				$result = $conexao -> prepare($select);
				$result -> execute();
				$count = $result->rowCount();

					if ($data = $result -> fetch()) {
						do {

							$idCategoria = $data['id'];
							$categoria   = $data['nome'];

							if ($cat == $idCategoria) {
								$selected = "active";
							} else {
								$selected = "";
							}

							echo "

							<li class='nav-item'>
						    <a class='nav-link $selected' href='ui-index.php?cat=$idCategoria'>$categoria</a>
						  </li>

							";
						} while ($data = $result -> fetch());
					}

					echo '

					</ul>

					<h6 class="subtitle m-none">Produtos em destaque</h6>

					';


					if($cat != "") {
						$select = "SELECT * FROM produtos where categoria = '$cat' and categoria != 999 and status = 1 ORDER BY CAST(preco AS DECIMAL(10,2))";
					} else {
						$select = "SELECT * FROM produtos where categoria != 999 and status = 1 ORDER BY CAST(preco AS DECIMAL(10,2))";
					}
					$result = $conexao -> prepare($select);
					$result -> execute();
					$count = $result->rowCount();

						if ($data = $result -> fetch()) {
							do {

								$id          = $data['id'];
								$nome        = $data['nome'];
								$descricao   = $data['descricao'];
								$banner      = $data['foto'];
								$preco       = $data['preco'];
								$precoPromo  = $data['precoPromo'];

								if ($preco == "") {
									$preco = "Em Breve";
								}

								if ($precoPromo != "") {
									$stylePreco = "text-decoration: line-through;";
								}

								echo "
								<div class='card-header card-dark' onclick=window.location.href='ui-view-product.php?cat=$cat&idProduto=$id' style='padding: 5px; width: 100%; margin-bottom: 15px; padding-bottom: 0;'>
									<img style='float: left; margin-right: 15px; object-fit: cover; width:60px; height: 60px; border-radius: 50%; display: inline-flex' src='../sistemaDelivery/assets/uploads/banner/$banner'>
									<div style='float: left; width: 60%;'>
										<h5><strong>$nome</strong></h5>
					      		<div style='font-size: 13px!important;'>$descricao</div>
									</div>
					      		<p style='margin-top: 2%; $stylePreco font-size: 18px; border-radius: 20px; float: right'>$preco</p>
					      		<p style='margin-top: -5%; font-size: 18px; border-radius: 20px; float: right'>$precoPromo</p>
								</div>
								";

							} while ($data = $result->fetch());
						}

					echo '

					<a href="assets/images/delivery.png" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-2" style="padding: 0; margin-top: 20px">
						<img alt="image" src="assets/images/delivery.png" class="img-fluid">
					</a>

				</div>
			</div>
		</div>
	</div>

</div>

<div id="optEdit" class="animated fadeIn">
		<span class="dot_whats" onclick=window.open("https://wa.me/554192839775", "_blank");loading() ><img style="width: 100%;" src="assets/images/whats.png"></span>
</div>

</body>

					';

					?>


<script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/plugins/lightbox/ekko-lightbox.min.js"></script>
<script>
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
	event.preventDefault();
    $(this).ekkoLightbox();
});
</script>

<script src="assets/plugins/owlcarousel/owl.carousel.min.js"></script>
<script>
$(document).ready(function(){
	$('.owl-1').owlCarousel({
    loop:true,
    margin:10,
		autoplay:true,
		autoplayTimeout:5000,
		autoplayHoverPause:false,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:4,
            nav:true,
            loop:false
        }
    }
	});
});
</script>


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
<script>
$(document).ready(function(){

	'use-strict';

    //Example 2
    $('#arquivos').filer({
        limit: 10,
        maxSize: 100000,
        extensions: ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'mp4', 'avi', 'wmv', 'm4v', 'mov', 'webm'],
        changeInput: true,
        showThumbs: true,
        addMore: true,
				captions: {
            button: "<i class='fas fa-paper-plane'></i>",
            feedback: "Selecione um ou mais arquivos...",
            feedback2: "Arquivo(s) Selecionado(s)",
            drop: "Mova os arquivos aqui para upload",
            removeConfirmation: "Você deseja remover esse arquivo?",
            errors: {
                filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
                filesType: "Only Images are allowed to be uploaded.",
                filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
                filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
            }
        }
    });
});
</script>

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
