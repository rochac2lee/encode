<?php

$zoom = $_GET['zoom'];

if ($zoom != "") {

	$link = "&zoom=80";

echo "
	<style>
	html {
		zoom: 60%!important;
		overflow: hidden;
	}
	</style>
";
}

try {
	$conexaoDelivery = new PDO('mysql:host=opmy0018.servidorwebfacil.com:3306;dbname=rochac2lee_sistemaDelivery', 'rocha_delivery', 'qwerty@848625');
	$conexaoDelivery -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	echo 'Houve um Erro na conexao com o banco de dados: ' . $e -> getMessage();
}

$select = "SELECT * from clientes_encode WHERE empresa LIKE '%$empresa%'";
$result = $conexaoDelivery -> prepare($select);
$result -> execute();
$count = $result->rowCount();
	if ($data = $result -> fetch()) {
		do {

			$idEmpresaAtual = $data['id'];
			$empresaAtual   = $data['empresa'];
			$whats          = $data['whatsapp'];
			$whatsapp       = "https://api.whatsapp.com/send?phone=55".$whats."&text=&source=&data=&app_absent=";
			$bancoDB        = $data['bancoDB'];
			$usuarioDB      = $data['usuarioDB'];
			$senhaDB        = $data['senhaDB'];

			try {
				$conexao = new PDO("mysql:host=opmy0018.servidorwebfacil.com:3306;dbname=$bancoDB", "$usuarioDB", "$senhaDB");
				$conexao -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				echo 'Houve um Erro na conexao com o banco de dados: ' . $e -> getMessage();
			}

			$selectEmpresa = "SELECT * from configs where nome_empresa LIKE '$empresaAtual' ORDER BY id_config DESC LIMIT 1";
			$resultEmpresa = $conexao -> prepare($selectEmpresa);
			$resultEmpresa -> execute();
				if ($dataEmpresa = $resultEmpresa -> fetch()) {
					do {

						$titulo_site        = $dataEmpresa['titulo_site'];
						$statusSistema      = $dataEmpresa['status'];
						$SEO_meta_titulo    = $dataEmpresa['SEO_meta_titulo'];
						$SEO_meta_descricao = $dataEmpresa['SEO_meta_descricao'];
						$SEO_meta_keywords  = $dataEmpresa['SEO_meta_keywords'];
						$SEO_meta_autor     = $dataEmpresa['SEO_meta_autor'];
						$conteudo_pagina    = $dataEmpresa['conteudo_pagina'];
						$conteudo_rodape    = $dataEmpresa['conteudo_rodape'];
						$endereco_site      = $dataEmpresa['endereco_site'];
						$analytics_codigo   = $dataEmpresa['analytics_codigo'];
						$logo_sistema       = $dataEmpresa['logo_sistema'];
						$logo_login         = $dataEmpresa['logo_login'];
						$corPrincipal				= $dataEmpresa['corPrincipal'];
						$corTexto   				= $dataEmpresa['corTexto'];
						$corTexto2   				= $dataEmpresa['corTexto2'];
						$corSecundaria			= $dataEmpresa['corSecundaria'];
						$corSidebarMenu			= $dataEmpresa['corSidebarMenu'];
						$corSidebarSubMenu  = $dataEmpresa['corSidebarSubMenu'];
						$nome_empresa       = $dataEmpresa['nome_empresa'];
						$empresaTipoNegocio = $dataEmpresa['idTipoNegocio'];
						$cnpj_empresa       = $dataEmpresa['cnpj'];
						$telefone_empresa   = $dataEmpresa['telefone'];
						$linkedin_empresa   = $dataEmpresa['linkedin'];
						$endereco_completo  = $dataEmpresa['endereco_completo'];
						$descricao_sistema  = $dataEmpresa['descricao_sistema'];
						$versao_sistema     = $dataEmpresa['versao_sistema'];
						$data_criacao       = $dataEmpresa['data_criacao'];
						$data_atualizacao   = $dataEmpresa['data_atualizacao'];

						echo "
						<style>

						.top_dark {
							background-color: $corSecundaria!important;
						}

						#btnMenuBar {
							color: $corTexto!important;
						}

						.background_dark {
						    background-color: $corSidebarMenu!important;
						}

						.menuBarIn {
						    background-color: $corSecundaria!important;
						}

						.menuBar, p {
						    color: $corTexto!important;
						}

						.tableMenuBar td {
						    color: $corTexto!important;
						}
						.corTexto {
							color: $corTexto!important;
						}

						.corTexto2 {
							color: $corTexto2!important;
						}

						</style>";

					} while ($dataEmpresa = $resultEmpresa -> fetch());
				}

		} while ($data = $result -> fetch());
	}

?>


<!DOCTYPE html>
<html lang="en" style="overflow-x: hidden!important; ">

<head>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1, user-scalable=no">
	<title><? echo $nome_empresa ?></title>

	<!-- Favicon -->
		<link rel="shortcut icon" href="../../sistemaDelivery/assets/uploads/sistema/<? echo $logo_sistema ?>">

	<meta name="description" content="<? echo $SEO_meta_descricao ?>">
	<meta name="author" content="<? echo $SEO_meta_descricao ?>">

	<!-- Font Icon css -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<!-- Effect Animate css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css" integrity="sha256-gVCm5mRCmW9kVgsSjQ7/5TLtXqvfCoxhdsjE6O1QLm8=" crossorigin="anonymous" />

	<!-- Style CSS -->
	<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />

	<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">

	<!-- Alerts Switchery css -->
	<link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

	<link href="../assets/css/animate.css" rel="stylesheet" type="text/css" media="all">

	<!-- Edit TextArea css -->
	<link rel="stylesheet" href="../assets/plugins/trumbowyg/ui/trumbowyg.min.css">

	<!-- Media Fancybox -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
	<link href="../assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
	<link href="../assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<script src="../assets/js/jquery.cascade-select.js" type="text/javascript"></script>

	<link href="../assets/plugins/lightbox/ekko-lightbox.css" rel="stylesheet">

	<link href="../assets/plugins/owlcarousel/owl.carousel.min.css" rel="stylesheet" />
	<link href="../assets/plugins/owlcarousel/owl.theme.default.min.css" rel="stylesheet" />

	<style>
	.owl-carousel .item-video {
	height: 300px;
	}
	.counter {
	font-size: 3.5rem;
	}
	</style>

	<meta name="theme-color" content="<? echo $corPrincipal ?>">
	<meta name="apple-mobile-web-app-status-bar-style" content="<? echo $corPrincipal ?>">
	<meta name="msapplication-navbutton-color" content="<? echo $corPrincipal ?>">

</head>

<?php

	$select = "SELECT * FROM categorias where status = 1 and id != 999 order by id ASC LIMIT 1";
	$result = $conexao -> prepare($select);
	$result -> execute();
	$count = $result->rowCount();

		if ($data = $result -> fetch()) {
			do {

				$firstIdCategoria = $data['id'];

			} while ($data = $result -> fetch());
		}

		if (!isset($_GET['cat']) || $_GET['cat'] == "") {
			$cat = $firstIdCategoria;
		} else {
			$cat = $_GET['cat'];
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

 require('../assets/includes/menuBar.php');


echo '

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 animated fadeIn" style="padding-left: 0;" id="navSolicitacao">
	<div class="card mb-3" style="background: transparent; box-shadow: none;">

		<div class="card-header top_dark">
			<div style="width: 70%; margin-left: 12%; position: absolute; z-index: 0">
				<center><img src="../../sistemaDelivery/assets/uploads/sistema/'.$logo_sistema.'" style="text-align: center; margin: -7px; margin-left: -15px; border-radius: 50%; width: 40px; "></center>
				<div class="clearfix"></div>
			</div>

		</div>

		<div class="owl-1 owl-carousel owl-theme">
	';

	$select = "SELECT * FROM uploads where idClienteEncode = '$idEmpresaAtual' and tipo = 1 order by id ASC";
	$result = $conexaoDelivery -> prepare($select);
	$result -> execute();
	$count = $result->rowCount();

		if ($data = $result -> fetch()) {
			do {

				$imagem = $data['arquivo'];

				echo '

				<div class="item">
					<a data-fancybox="Banner.png" href="../../sistemaDelivery/assets/uploads/banner/'.$imagem.'">
						<img class="d-block w-100" src="../../sistemaDelivery/assets/uploads/banner/'.$imagem.'" alt="slide">
					</a>
				</div>

				';

			} while ($data = $result -> fetch());
		}

		echo '
		</div>

		<div class="card-body background_dark" style="border: 0; padding-top: 0;">
			<div class="row">


				<ul class="nav nav-tabs nav-cat background_dark" style="overflow-y: hidden; overflow-x: scroll; flex-wrap: unset;">

		';


				$select = "SELECT * FROM categorias where status = 1 and id != 999 order by id ASC";

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
						    <a class='nav-link $selected' href='index.php?cat=$idCategoria$link'>$categoria</a>
						  </li>

							";
						} while ($data = $result -> fetch());
					}

					echo '

					</ul>

					<h6 class="subtitle m-none corTexto2">Produtos em destaque</h6>

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
								<div class='card-header card-dark corTexto' onclick=window.location.href='ui-view-product.php?cat=$cat&idProduto=$id$link' style='padding: 5px; width: 100%; margin-bottom: 15px; padding-bottom: 0;'>
									<img style='float: left; margin-right: 15px; object-fit: cover; width:60px; height: 60px; border-radius: 50%; display: inline-flex' src='../../sistemaDelivery/assets/uploads/banner/$banner'>
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

					<a href="../assets/images/delivery.png" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-2" style="padding: 0; margin-top: 20px">
						<img alt="image" src="../assets/images/delivery.png" class="img-fluid">
					</a>

				</div>
			</div>
		</div>
	</div>

</div>
					';

					if ($whats != "") {

					?>

					<script>
					function whats() {
						window.open("<? echo $whatsapp ?>", "_blank");
					}

					</script>

					<div id="optEdit" class="animated fadeIn">
							<span class="dot_whats" onclick="whats()"><img style="width: 100%;" src="../assets/images/whats.png"></span>
					</div>

<?

				}

					echo '

</body>

					';


?>

<script src="../assets/js/modernizr.min.js"></script>
<script src="../assets/js/moment.min.js"></script>
<script src="../assets/plugins/lightbox/ekko-lightbox.min.js"></script>
<script>
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
	event.preventDefault();
    $(this).ekkoLightbox();
});
</script>

<script src="../assets/plugins/owlcarousel/owl.carousel.min.js"></script>
<script>
$(document).ready(function(){
	$('.owl-1').owlCarousel({
		items: 1,
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


<script src="../assets/js/popper.min.js"></script>
<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>

<script src="https://cdn.rawgit.com/FezVrasta/snackbarjs/1.1.0/dist/snackbar.min.js"></script>

<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

<script src="../assets/js/detect.js"></script>
<script src="../assets/js/fastclick.js"></script>
<script src="../assets/js/jquery.blockUI.js"></script>
<script src="../assets/js/jquery.nicescroll.js"></script>

<script src="../assets/plugins/jquery.filer/js/jquery.filer.min.js"></script>
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


<script src="../assets/js/pikeadmin.js"></script>


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
<script src="../assets/plugins/trumbowyg/trumbowyg.min.js"></script>
<script>
$(document).ready(function () {
    'use strict';
	$('.editor').trumbowyg();
});
</script>

<script src="../assets/plugins/ion-rangeslider/ion.rangeSlider.min.js"></script>
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
