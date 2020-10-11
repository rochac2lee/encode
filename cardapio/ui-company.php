<?php

if (isset($_GET['action'])) {
		$action = $_GET['action'];
}

if (isset($_GET['id'])) {
		$idSolicitacaoAtual = $_GET['id'];
}

require('assets/includes/session.php');

if ($redefineSenha == 1) {echo "<script>window.location='ui-new-password.php?id=$idUsuario'</script>";}

?>
<!DOCTYPE html>
<html lang="en" style="overflow-x: hidden!important; ">

<head>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1, user-scalable=no">
	<title>LAS - Segurança Patrimonial</title>

	<!-- Favicon -->
		<link rel="shortcut icon" href="../images/logo.png">

	<meta name="description" content="Sistema de Atendimento de Plantão da Equipe de TI da Cimbessul S.A.">
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

<body class="background_dark" style="z-index: 1000000000;" onload="getAllCompanies()">

<script>

function newCompanies() {
	document.getElementById("newCompanies").style.display = "block";
	document.getElementById("viewCompanies").style.display = "none";
	document.getElementById("filterCompany").style.display = "none";
	document.getElementById("optEdit").style.display = "none";
}

</script>

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

	<?php require('assets/includes/menuBar.php'); ?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 animated fadeIn" id="navSolicitacao" style="margin-bottom: 300px;">
		<div class="card mb-3" style="background: transparent; box-shadow: none;">

			<div class="card-header top_dark">
				<div style="float: left; z-index: 1" onclick="viewMenuBar()">
					<i style="display: inline-flex;" id="btnMenuBar" class="fa fa-2x fa-bars"></i>
				</div>
				<div style="width: 70%; margin-left: 12%;position: absolute; z-index: 0">
					<strong><h5 class="titleBar">Empresas</h5></strong>
				</div>
			</div>

			<div class="card-body background_dark" style="border: 0; background-color: transparent!important; margin-top: -10px!important; margin-bottom: 0px!important; padding-bottom: 0;" id="filterCompany">
				<div class="card mb-3" style="background: transparent; box-shadow: none; border: 0; margin-bottom: 0px!important;">
					<div class="form-group" style="padding-top:0;">
						<div class="input-group">
						<span class="input-group-addon" style="margin: 5px; margin-right: 15px; color: #b0b3b8;"><i class="fas fa-sort-amount-down"></i></span>
							<select class="form-control" style="color: #b0b3b8" name="status" id="status">
								<option value="9">Todos</option>
								<option value="1">Ativo</option>
								<option value="0">Desativado</option>
							</select>
						</div>
					</div>
				</div>
			</div>

			<div id="viewCompanies" class="animated fadeInRight" style="border: 0; display: block; background-color: transparent!important;">

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

				 function getAllCompanies() {

					 // Declaração de Variáveis
					 var result = document.getElementById("divViewCompanies");
					 var xmlreq = CriaRequest();

					 var status = document.getElementById('status').value;

					 var address = "assets/functions/searchCompanies.php?status=" + status;

					 // Iniciar uma requisição
					 xmlreq.open("GET", address, true);
					 setTimeout(getAllCompanies, 1000); //1s

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

				 <div id='divViewCompanies'></div>

				 <center><strong><h1 style='color: #b0b3b8'>.</h1></strong></center>

			</div>

			<div class="card-body background_dark animated fadeInRight" id="newCompanies" style="border: 0; display: none;">
					<form action="assets/functions/newCompany.php" name="newCompany" id="newCompany" method="post">

						<div class="row">

							<center><img style="width: 40%; margin-top: -20px; margin-bottom: -20px;" src="../../images/company.png"></center>

							<div class="col-lg-2">
							<div class="form-group">
						    <label for="empresa" class="bmd-label-floating">Nome Fantasia</label>
						    <input type="text" class="form-control" id="empresa" name="empresa" required>
						    <span class="bmd-help">Campo Obrigatório</span>
						  </div>
							</div>

							<div class="col-lg-2">
							<div class="form-group">
						    <label for="enderecoCompleto" class="bmd-label-floating">Endereço Completo</label>
						    <input type="text" class="form-control" id="enderecoCompleto" name="enderecoCompleto">
						  </div>
							</div>

							<div class="col-lg-2">
							<div class="form-group">
						    <label for="cnpj" class="bmd-label-floating">CNPJ</label>
						    <input type="text" class="form-control" id="cnpj" name="cnpj">
						  </div>
							</div>

							<div class="col-lg-2">
							<div class="form-group">
						    <label for="telefone" class="bmd-label-floating">Telefone</label>
						    <input type="text" class="form-control" id="telefone" name="telefone">
						  </div>
							</div>

							<div class="col-lg-2">
							<div class="form-group">
						    <label for="emailEmpresa" class="bmd-label-floating">Email</label>
						    <input type="text" class="form-control" id="email" name="email">
						  </div>
							</div>

					</div>
					<div class="clearfix"></div>
					<div class="modal-footer" style="border-top:0; padding-left: 0; padding-right: 0;">

						<script type="text/javascript">
						function verificaNewCompany(){
							if ($('#empresa').val() == ""){
								document.getElementById('snackbar-container').style.backgroundColor = "#f44336";
								document.getElementById('cadCompany').setAttribute("data-content", "<strong>Atenção! </strong><br>Campos Obrigatórios!");

								setTimeout(() => {
										$('.snackbar-opened').remove();
								}, 10000);

								return false;
							} else {

								document.getElementById('empresa').readOnly = 'true';
								document.getElementById('enderecoCompleto').readOnly = 'true';
								document.getElementById('cnpj').readOnly = 'true';
								document.getElementById('telefone').readOnly = 'true';
								document.getElementById('email').readOnly = 'true';

								document.getElementById('snackbar-container').style.backgroundColor = "#4caf50";
								document.getElementById('cadCompany').setAttribute("data-content", "Empresa criada com Sucesso!");

								document.getElementById('cadCompany').style.visibility = 'hidden';
								document.getElementById('cadCompany').style.display = 'none';
								document.newCompany.submit();
							}
						}
						</script>
						<button type="button" class="btn btn-success" data-toggle="snackbar" data-content="" onclick="verificaNewCompany()" id="cadCompany"><i class="fa fa-save"></i>&nbsp; Salvar</button>
					</div>
					<div class="clearfix"></div>
					</form>
			</div>
		</div>
	</div>

</div>

<img src="assets/images/load_view.gif" id="loading" style="display: none; width: 10%; top: 5px; right: 5px; float: right; position: absolute; z-index: 999999;" />

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

<?php if ($admin == 0) { ?>

	<div id="optEdit" class="animated fadeIn">
			<span class='dot_new' onclick="newCompanies(); document.getElementById('title').innerHTML = 'Nova Empresa'"><i style='margin: 17px;' class='fa fa-plus'></i></span>
	</div>

<?php } ?>

<?php if ($action == 'new') { ?>

<script>
newCompanies();
</script>

<?php } ?>

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
<script>

function alertNewUser() {

$(document).ready(function(){

       swal("Usuário Criado!", "Usuário Cadastrado com sucesso!", "success");

});
};

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
                filesSize: "{{fi-name}} é muito grande! O tamanho limite é de {{fi-maxSize}} MB.",
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

$(document).ready(function(){
  $("#cnpj").inputmask("99.999.999/9999-99");
  $("#telefone").inputmask("(99) 9999-9999");
  $("#celular").inputmask("(99) 99999-9999");
});

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
