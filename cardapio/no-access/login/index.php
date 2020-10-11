<?php
ob_start();
session_start();
if (isset($_SESSION['usuario_appcimbessul']) && (isset($_SESSION['senha_appcimbessul']))){
	header("Location: ../ui-index.php"); exit;
}
include("../assets/includes/conexao.php");

?>
<!DOCTYPE html>
<html>
<head>
<title>Login | SIG - Sistema Integrado de Gestão v1</title>

<link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">
<link rel="stylesheet" href="css/lightbox.css">
<!-- Custom Theme files -->

<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1, user-scalable=no">

<link rel="shortcut icon" href="images/favicon.ico" />

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Painel do Cliente, CIMBESSUL, Desenvolvimento, Clients" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //Custom Theme files -->
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- image-hover -->
<script type="text/javascript" src="js/mootools-yui-compressed.js"></script>
<!-- //image-hover -->
<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
</head>
<body style="background-color: #f5f5f5;">

	<!--about-->
	<div class="about" id="about">
			<div class="col-md-4 about-right fadeIn animated" style="position: absolute; margin: auto; max-width: 450px; top: 70px; right: 0; bottom: 0; left: 0;">
				<div class="form-body">
					<div style="border-color: #929292; background-color: #f5f5f5; border-radius: 7px;  margin: 15px;">
					<center><img style="width:70%; margin-top:25px;" src="../assets/images/logohz.png" /></center>
						<form action="?loading=1" method="post" style="padding: 20px; padding-top:30px; padding-bottom:30px;">
							<?php

							date_default_timezone_set('America/Brasilia');
							$dateTime = date('d/m/Y H:i');

							if(isset($_GET['action'])){
								if(!isset($_POST['entrar'])){

									$action = $_GET['action'];
									if($action=='denid'){
										echo '<div class="alert alert-danger" role="alert">
													<strong>Erro ao Acessar!</strong> <br> Você precisa fazer logon para acessar o sistema.
											   </div>';
									}
								}
							}

							if (isset($_POST['entrar'])){
								//recuperar dados form

								function valida_ldap($srv, $usr, $pwd){
									$ldap_server = $srv;
									$auth_user = $usr;
									$auth_pass = $pwd;

									// Tenta se conectar com o servidor
									if (!($connect = @ldap_connect($ldap_server))) {
										return FALSE;
									}

									// Tenta autenticar no servidor
									if (!($bind = @ldap_bind($connect, $auth_user, $auth_pass))) {
										// se não validar retorna false
										return FALSE;
									} else {
										// se validar retorna true
										return TRUE;
									}

								}

									// Dados para login pelo LDAP
									$server = "10.3.100.100"; //IP ou nome do servidor
									$dominio = "@cimbessul"; //Dominio
									$user = trim(strip_tags($_POST['auth_usuario']));
									$user = $user.$dominio;
									$pass 	             = trim(strip_tags($_POST['auth_pass']));

									if (valida_ldap($server, $user, $pass)) {

									$criptografaLPAD  = base64_encode($pass);
									$pass             = $criptografaLPAD;
									$_SESSION['usuario_appcimbessul'] = $user;
									$_SESSION['senha_appcimbessul'] = $pass;

									echo '<center><img src="images/loader.gif" width="20%"></center>';
									header("Refresh: 1, ../ui-tickets.php");

								} else {
									echo '<div class="alert alert-danger" role="alert">
										<strong>Tente Novamente!</strong> <br> Os Dados de login estão incorretos.
								   </div>';
								}

								} //Se Clicar no Botão Enter
							?>

							<div class="form-group">
								<label for="email">Usuário</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-user"></i></span>
									<input type="text" style="-webkit-box-shadow: 0 0 0px 1000px white inset; border-color: #929292;" class="form-control" id="auth_usuario" name="auth_usuario" placeholder="Email" required="">
								</div>
							</div>
							<div class="form-group">
								<label for="nome">Senha</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-unlock"></i></span>
									<input type="password" style="-webkit-box-shadow: 0 0 0px 1000px white inset; border-color: #929292;" class="form-control" id="auth_pass" name="auth_pass" placeholder="Senha" required="">
								</div>
							</div>
							</br>
							<hr>
							<?php
							if ($_GET['loading'] == 1) {} else {
							?>
							<button name="entrar" id="entrar" style="float:right;" type="submit" onclick="var e=this; setTimeout(function(){e.disabled=true;},0); return true;" class="btn btn-success"><i class="fa fa-check"></i>&nbsp; Entrar</button>
							<a href="../" class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp; Voltar</a>
							<div class="clearfix"> </div>
						  <?php
							}
						  ?>
						</form>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>

	<!-- banner-text Slider starts Here -->
		<script src="js/responsiveslides.min.js"></script>
		 <script>
			// You can also use "$(window).load(function() {"
				$(function () {
				// Slideshow 3
					$("#slider3").responsiveSlides({
					auto: true,
					pager:true,
					nav:true,
					speed: 500,
					namespace: "callbacks",
					before: function () {
					$('.events').append("<li>before event fired.</li>");
					},
					after: function () {
						$('.events').append("<li>after event fired.</li>");
					}
				});
			});
		</script>
		 <script>
			// You can also use "$(window).load(function() {"
				$(function () {
				// Slideshow 4
					$("#slider4").responsiveSlides({
					auto: true,
					pager:true,
					nav:false,
					speed: 500,
					namespace: "callbacks",
					before: function () {
					$('.events').append("<li>before event fired.</li>");
					},
					after: function () {
						$('.events').append("<li>after event fired.</li>");
					}
				});
			});
		</script>
		<!--//End-slider-script -->
		<!-- start-smoth-scrolling-->
		<script src="js/SmoothScroll.min.js"></script>
		<script type="text/javascript" src="js/move-top.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
		<script type="text/javascript">
				jQuery(document).ready(function($) {
					$(".scroll").click(function(event){
						event.preventDefault();
						$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
					});
				});
		</script>
		<!--//end-smoth-scrolling-->
		<!--smooth-scrolling-of-move-up-->
		<script type="text/javascript">
			$(document).ready(function() {
				/*
				var defaults = {
					containerID: 'toTop', // fading element id
					containerHoverID: 'toTopHover', // fading element hover id
					scrollSpeed: 1200,
					easingType: 'linear'
				};
				*/

				$().UItoTop({ easingType: 'easeOutQuart' });

			});
		</script>
		<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
		<!--//smooth-scrolling-of-move-up-->
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.js"></script>
</body>
</html>
