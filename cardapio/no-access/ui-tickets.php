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

<body style="background-color: #ffffff; z-index: 1000000000;" onload="getAllTickets(); getAllTicketsUsers();">

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

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 animated fadeIn" id="navAtendimentos">
		<div class="card mb-3" style="background: transparent; border: 0;">
			<div class="card-header">

					<strong><h5 style="margin-bottom: 0;"><i class="fas fa-list-ul"></i> Atendimentos</h5></strong>

			</div>
			<div class="card-body">
				<div class="card mb-3" style="background: transparent; border: 0;">

					<div class="form-group">

					<div class="input-group">
					<span class="input-group-addon" style="margin: 5px; margin-right: 15px; color: #6c6c6c;"><i class="fas fa-sort-amount-down"></i></span>
					<select class="form-control" style="-webkit-box-shadow: 0 0 0px 1000px white inset; border-color: #929292;" name="tipo" id="tipo">
						<option value="0">Todos</option>
						<option value="1">Novo</option>
						<option value="2">Processando (Atribuído)</option>
						<option value="3">Processando (Planejado)</option>
						<option value="4">Pendente</option>
						<option value="5">Solucionado</option>
						<option value="6">Fechado</option>
					</select>
					</div>

					<hr>

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

					 function getAllTickets() {

						 // Declaração de Variáveis
						 var result = document.getElementById("divTicket");
						 var xmlreq = CriaRequest();

						 var type = document.getElementById('tipo').value;

						 var address = "assets/functions/searchTickets.php?type=" + type;

						 // Iniciar uma requisição
						 xmlreq.open("GET", address, true);
						 setTimeout(getAllTickets, 1000); //5s

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
					 function getAllTicketsUsers() {

						 // Declaração de Variáveis
						 var result = document.getElementById("divTicketsUsers");
						 var xmlreq = CriaRequest();

 						 var typeUser = document.getElementById('tipo').value;

 						 var address = "assets/functions/searchTicketsUsers.php?type=" + typeUser;

						 // Iniciar uma requisição
						 xmlreq.open("GET", address, true);
						 setTimeout(getAllTicketsUsers, 1000); //5s

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


					 <?php

					 if ($countAdmin > 0) {
					 		echo "<div id='divTicket'></div>";
					 } else {
						  echo "<div id='divTicketsUsers'></div>";
					 }

					 ?>

				</div>
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

<div id="optEdit" class="animated fadeIn">
		<span class='dot_new' onclick="window.location.href = ('ui-index.php'); loading()"><i style='margin: 15px;' class='fa fa-plus'></i></span>
</div>

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
