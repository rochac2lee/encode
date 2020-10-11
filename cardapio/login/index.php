<?php
ob_start();
session_start();

if (isset($_GET['id'])) {
	$id = $_GET['id'];
}

if (isset($_GET['existeUsuario'])) {
	$existeUsuario = $_GET['existeUsuario'];
}

if (isset($_SESSION['usuario_lp']) && (isset($_SESSION['senha_lp']))){
	header("Location: ../ui-home.php"); exit;
}
include("../assets/includes/conexao.php");

?>
<!DOCTYPE html>
<html>
<head>
<title>Lemarde Petisco Delivery</title>

<link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">
<link rel="stylesheet" href="css/lightbox.css">
<!-- Custom Theme files -->

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="shortcut icon" href="../assets/images/icon_app.png" />

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Fonts to support Material Design -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
<!-- Icons to support Material Design -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //Custom Theme files -->
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.js"></script>

</head>
<body style="background-color: #292728;">

	<script type="text/javascript">
	<!--
	if (screen.width > 1024) {
	document.location = "../no-app.php";
	}
	//-->
	</script>

<script>

function viewCadastro() {
	document.getElementById('frmCadastro').style.display = 'block';
	document.getElementById('frmEsqueciSenha').style.display = 'none';
	document.getElementById('frmLogin').style.display = 'none';
	document.getElementById('logo').style.display = 'none';
}

function viewEsqueciSenha() {
	document.getElementById('frmEsqueciSenha').style.display = 'block';
	document.getElementById('frmCadastro').style.display = 'none';
	document.getElementById('frmLogin').style.display = 'none';
	document.getElementById('logo').style.display = 'block';
}

function viewLogin() {
	document.getElementById('frmLogin').style.display = 'block';
	document.getElementById('logo').style.display = 'block';
	document.getElementById('frmCadastro').style.display = 'none';
	document.getElementById('frmEsqueciSenha').style.display = 'none';
}


</script>

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

	<div class="about" id="login">
			<div class="col-md-4 about-right animated fadeInRight" style="position: absolute; margin: auto; max-width: 450px; top: 50px; right: 0; bottom: 0; left: 0;">
				<div class="form-body">
					<div style="border-color: #929292; border-radius: 7px;  margin: 15px;">
					<center><img id="logo" style="width:60%; margin-top:0px;" src="../assets/images/logo.png" /></center>
						<form action="?loading=1" class="animated fadeInRight" method="post" id="frmLogin" style="padding: 20px; padding-top:10px; padding-bottom:10px; margin-bottom: 400px">
							<?php

							date_default_timezone_set('America/Brasilia');
							$dateTime = date('d/m/Y H:i');

							if($existeUsuario != ""){
								echo '<div class="alert alert-danger" role="alert">
											<strong>Você já está cadastrado!</strong> <br> Se você esqueceu sua senha, <a style="color: #03a9f4" onclick="viewEsqueciSenha()">clique aqui!</a>
									   </div>';
							}

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

							if ($id != "") {

								$select = "SELECT * from usuarios WHERE id='$id'";
								$result = $conexao -> prepare($select);
								$result -> execute();
								$count = $result->rowCount();

								if ($count > 0) {
									if ($data = $result -> fetch()) {
										do {

											$usuario      = $data['email'];
											$senha 	      = "";

											$_SESSION['usuario_lp'] = $usuario;
											$_SESSION['senha_lp'] = $senha;

											header("Refresh: 1, ../ui-new-password.php?id=$id&forgotPassword=1");

										} while($data = $result -> fetch());
									}
								}
							}

							if (isset($_POST['entrar'])){
								//recuperar dados form
									$usuario             = trim(strip_tags($_POST['auth_usuario']));
									$senha 	             = trim(strip_tags($_POST['auth_pass']));
									$criptografa         = base64_encode($senha);
									$senha = $criptografa;
								//selecionar banco de dados

									$select = "SELECT * from usuarios WHERE BINARY celular='$usuario' AND BINARY senha='$senha'";
									try {
										$result = $conexao -> prepare($select);
										$result -> execute();
										$count = $result->rowCount();

										if ($count > 0) {
											if ($data = $result -> fetch()) {
												do {
													$status        = $data['status'];

													if ($status != 0) {
														$redefineSenha = $data['redefineSenha'];
														$usuario      = $_POST['auth_usuario'];
														$senha 	      = $_POST['auth_pass'];
														$criptografa  = base64_encode($senha);
												    $senha        = $criptografa;
														$_SESSION['usuario_lp'] = $usuario;
														$_SESSION['senha_lp'] = $senha;

														echo '<center><img src="images/loader.gif" width="20%"></center>';

														if ($redefineSenha == 0) {
															header("Refresh: 1, ../ui-index.php?cat=1&action=welcome");
														} else {
															header("Refresh: 1, ../ui-new-password.php");
														}
													} else {
														echo '<div class="alert alert-danger" role="alert">
															<strong>Usuário desativado!</strong> <br> Fale com o Administrador.
													   </div>';
													}
												} while($data = $result -> fetch());
											}
										} else {
							        echo '<div class="alert alert-danger" role="alert">
												<strong>Tente Novamente!</strong> <br> Os Dados de Acesso estão Incorretos.
										   </div>';
							      }

									} catch (PDOException $e){
										echo $e;
									}


								} //Se Clicar no Botão Enter
							?>

							<div class="form-group">
						    <label for="auth_usuario" class="bmd-label-floating"><i class="fas fa-mobile-alt"></i>&nbsp; Número de Celular com DDD</label>
						    <input type="text" class="form-control" id="auth_usuario" name="auth_usuario">
						    <span class="bmd-help">Somente números</span>
						  </div>
							<div class="form-group">
						    <label for="auth_pass" class="bmd-label-floating"><i class="fas fa-unlock"></i>&nbsp; Senha</label>
						    <input type="password" onclick=window.location.href=#auth_pass class="form-control" id="auth_pass" name="auth_pass">
						    <span class="bmd-help">Informe sua senha</span>
						  </div>
							</br>


							<button type="button" style="float:left;" onclick="viewCadastro()" class="btn btn-success"><i class="fa fa-user-plus"></i>&nbsp; Cadastrar-me</button>
							<button name="entrar" id="entrar" style="float:right;" type="submit" onclick="var e=this; setTimeout(function(){e.disabled=true;},0); return true;" class="btn btn-success"><i class="fa fa-check"></i>&nbsp; Entrar</button>
							<button type="button" style="float:left;" onclick="viewEsqueciSenha()" class="btn btn-info">Esqueceu a senha?</button>
							<div class="clearfix"> </div>

						</form>

						<form action="../assets/functions/newUser.php" class="animated fadeInRight" method="post" enctype="multipart/form-data" id="frmCadastro" name="frmCadastro" style="display: none; padding: 20px; padding-top:10px; padding-bottom:10px; margin-bottom: 400px">

							<div id="avatar_image">
								<center>
								<label for="upload">
											<img src="../assets/images/user_plus.png" class="animated fadeIn" id="userPicture" style="width: 200px; height: 200px">
											<input type="file" id="upload" onchange="preview_image(event)" name="uploadAvatar[]" style="display:none">
								</label>
							</center>

							<script type='text/javascript'>
								function preview_image(event) {
								 var reader = new FileReader();
								 reader.onload = function() {
								  var output = document.getElementById('userPicture');
								  output.src = reader.result;
									document.getElementById('userPicture').style.borderRadius = '50%';
								 }
								 reader.readAsDataURL(event.target.files[0]);
								}
							</script>

							</div>

							<div class="form-group">
						    <label for="nome" class="bmd-label-floating">Nome Completo</label>
						    <input type="text" class="form-control" id="nome" name="nome">
						    <span class="bmd-help">* Campo Obrigatório</span>
						  </div>
							<div class="form-group">
						    <label for="celular" class="bmd-label-floating"><i class="fas fa-mobile-alt"></i>&nbsp; Número de Celular com DDD</label>
						    <input type="text" class="form-control" id="celular" name="celular">
						    <span class="bmd-help">Somente números</span>
						  </div>
							<div class="form-group">
						    <label for="senha" class="bmd-label-floating"><i class="fas fa-unlock"></i>&nbsp; Senha</label>
						    <input type="password" onclick=window.location.href=#senha class="form-control" id="senha" name="senha">
						    <span class="bmd-help">Informe sua senha</span>
						  </div>
							<div class="form-group">
						    <label for="confirmarSenha" class="bmd-label-floating"><i class="fas fa-unlock"></i>&nbsp; Confirmar Senha</label>
						    <input type="password" onclick=window.location.href=#confirmarSenha class="form-control" id="confirmarSenha" name="confirmarSenha">
						    <span class="bmd-help">Informe novamente sua senha</span>
						  </div>
							</br>

							<script type="text/javascript">
							function verificaNewUser(){
								if ($('#nome').val() == "" || $('#celular').val() == "" || $('#senha').val() == "" || $('#confirmarSenha').val() == "" ){

									document.getElementById('snackbar-container').style.backgroundColor = "#f44336";
									document.getElementById('cadastrar').setAttribute("data-content", "<strong>Atenção! </strong><br>Campos Obrigatórios!");

									setTimeout(() => {
											$('.snackbar-opened').remove();
									}, 10000);

									return false;
								} else if ($('#senha').val() != $('#confirmarSenha').val()) {

									document.getElementById('snackbar-container').style.backgroundColor = "#f44336";
									document.getElementById('cadastrar').setAttribute("data-content", "<strong>Atenção! </strong><br>As Senhas precisam ser iguais!");

									setTimeout(() => {
											$('.snackbar-opened').remove();
									}, 10000);

								} else {

									document.getElementById('nome').readOnly = 'true';
									document.getElementById('celular').readOnly = 'true';
									document.getElementById('senha').readOnly = 'true';
									document.getElementById('confirmarSenha').readOnly = 'true';

									document.getElementById('snackbar-container').style.backgroundColor = "#4caf50";
									document.getElementById('cadastrar').setAttribute("data-content", "Usuário criado com Sucesso!");

									document.getElementById('cadastrar').style.visibility = 'hidden';
									document.getElementById('cadastrar').style.display = 'none';
									document.frmCadastro.submit();
								}
							}
							</script>

							<button type="button" style="float:left;" onclick="viewLogin()" class="btn btn-success"><i class="fa fa-arrow-left"></i>&nbsp; Voltar</button>
							<button name="cadastrar" id="cadastrar" style="float:right;" type="button" onclick="verificaNewUser()" data-toggle="snackbar" data-content="" class="btn btn-success"><i class="fa fa-check"></i>&nbsp; Salvar</button>
							<div class="clearfix"> </div>

						</form>

						<form action="../assets/functions/forgotPassword.php" class="animated fadeInRight" method="post" id="frmEsqueciSenha" name="frmEsqueciSenha" style="display: none; padding: 20px; padding-top:10px; padding-bottom:10px; margin-bottom: 400px">

							<p>Para sua segurança, vamos enviar um email com um link para que você possa redefinir sua senha</p>

							<div class="form-group">
						    <label for="email" class="bmd-label-floating"><i class="fas fa-user"></i> Email</label>
						    <input type="email" class="form-control" id="forgotPasswordEmail" name="forgotPasswordEmail">
						    <span class="bmd-help">Informe seu Email</span>
						  </div>

							</br>

							<script type="text/javascript">
							function verificaEsqueciSenha(){
								if ($('#forgotPasswordEmail').val() == ""){

									document.getElementById('snackbar-container').style.backgroundColor = "#f44336";
									document.getElementById('enviar').setAttribute("data-content", "<strong>Atenção! </strong><br>Campo Obrigatório!");

									setTimeout(() => {
											$('.snackbar-opened').remove();
									}, 10000);

									return false;
								} else {

									document.getElementById('forgotPasswordEmail').readOnly = 'true';

									document.getElementById('snackbar-container').style.backgroundColor = "#4caf50";
									document.getElementById('enviar').setAttribute("data-content", "Enviado com Sucesso!");

									document.getElementById('enviar').style.visibility = 'hidden';
									document.getElementById('enviar').style.display = 'none';
									document.frmEsqueciSenha.submit();
								}
							}
							</script>

							<button type="button" style="float:left;" onclick="viewLogin()" class="btn btn-success"><i class="fa fa-arrow-left"></i>&nbsp; Voltar</button>
							<button name="enviar" id="enviar" style="float:right;" type="button" onclick="verificaEsqueciSenha()" data-toggle="snackbar" data-content="" class="btn btn-success"><i class="fa fa-check"></i>&nbsp; Enviar</button>
							<div class="clearfix"> </div>

						</form>


					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>

	</div>

	<script>
		$(document).ready(function(){
		  $("#cnpj").inputmask("99.999.999/9999-99");
		  $("#telefone").inputmask("(99) 9999-9999");
		  $("#auth_usuario").inputmask("(99) 99999-9999");
		  $("#celular").inputmask("(99) 99999-9999");
		});
	</script>

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
	<!--//smooth-scrolling-of-move-up-->
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

		<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>

		<script src="https://cdn.rawgit.com/FezVrasta/snackbarjs/1.1.0/dist/snackbar.min.js"></script>

		<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
		<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
</body>
</html>
