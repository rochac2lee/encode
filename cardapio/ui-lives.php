<?php

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

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

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

<body class="background_dark" onload="searchLiveComments(); searchReactions(); searchAllReactions();" style="z-index: 1000000000;">

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

	<script>

	function viewNewVideo() {
		document.getElementById('navLive').style.display = 'none';
		document.getElementById('optEdit').style.display = 'none';
		document.getElementById('newLiveVideo').style.display = 'block';
	}

	function viewUrlLive() {
		document.getElementById('thumbLive').style.display = 'none';
		document.getElementById('linkLive').style.display = 'block';
	}

	function hideUrlLive() {
		document.getElementById('linkLive').style.display = 'none';
		document.getElementById('thumbLive').style.display = 'block';
	}

	</script>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 animated fadeIn" id="navSolicitacao">
		<div class="card mb-3" style="background: transparent; box-shadow: none;">

			<div class="card-header top_dark">
				<div style="float: left; z-index: 1" onclick="viewMenuBar()">
					<i style="display: inline-flex;" id="btnMenuBar" class="fa fa-2x fa-bars"></i>
				</div>
				<div style="width: 70%; margin-left: 12%;position: absolute; z-index: 0">
					<strong><h5 class="titleBar">Vídeos</h5></strong>
				</div>
				<?php
				if ($admin == 0) {
				?>
				<div style="float: right; z-index: 1" id="optEdit" onclick="viewNewVideo()">
					<i style="display: inline-flex;" id="btnMenuBar" class="fa fa-2x fa-plus"></i>
				</div>
				<?php
				}
				?>
			</div>

			<div id="navLive" style="display: block">
					<nav>
					  <div class="nav nav-tabs top_dark" id="nav-tab" role="tablist">
						<?php
							$select = "SELECT * from lives WHERE url = ''";
							$result = $conexao -> prepare($select);
							$result -> execute();
							$count = $result->rowCount();

							if ($count != 0) { $title = "Programação"; $margem = "padding: 0"; } else { $title = "Acontecendo Agora"; $margem = "padding: 0"; }
						?>

						  <a class="nav-item nav-link active" id="nav-ao-vivo-tab" data-toggle="tab" href="#nav-ao-vivo" role="tab" aria-controls="nav-ao-vivo" aria-selected="true"><?php echo $title; ?></a>
					    <a class="nav-item nav-link" id="nav-videos-tab" data-toggle="tab" href="#nav-videos" role="tab" aria-controls="nav-videos" aria-selected="false">Vídeos</a>
					  </div>
					</nav>
					<div class="tab-content background_dark" id="nav-tabContent">
					  <div class="tab-pane fade show active" id="nav-ao-vivo" style="<?php echo $margem; ?>" role="tabpanel" aria-labelledby="nav-ao-vivo-tab">

						<?php

						$select = "SELECT * from lives WHERE status = 1 ORDER BY id DESC";
						$result = $conexao -> prepare($select);
						$result -> execute();
						$count = $result->rowCount();

						if ($data = $result -> fetch()) {
							do {

								$liveId     = $data['id'];
								$titulo     = $data['titulo'];
								$banner     = $data['banner'];
								$url        = $data['url'];
								$statusLive    = $data['status'];
								$statusCommentLive = $data['statusComment'];
								$dataLive   = date("d/m", strtotime($data['dataHora']));
								$horaLive   = date("H:i", strtotime($data['dataHora']));
								$statusLive = $data['status'];

								echo "
								<div class='card-dark animated fadeIn' id='linkLive' style='display: none'>
									<div class='modal-content'>
										<div class='modal-header'>
											<h5 class='modal-title'>Link de Transmissão</h5>
											<button type='button' class='close' style='color: #fff' onclick='hideUrlLive()' aria-label='Close'>
												<span aria-hidden='true'>&times;</span>
											</button>
										</div>
										<div class='modal-body'>
											<form action='assets/functions/updateLiveUrl.php?idUsuario=$idUsuario&liveId=$liveId' name='sendUrlLive' id='sendUrlLive' method='post'>
											<p style='margin-bottom: 0; font-size: 14px;'>Exemplo de link: <br>https://www.youtube.com/embed/uhFqpZ142kY</p>

												<div class='form-group'>
													<label for='enderecoUrlVideo' class='bmd-label-floating'>URL do Vídeo do Youtube</label>
													<input type='text' class='form-control' id='enderecoUrlVideo' value='https://www.youtube.com/embed/' name='enderecoUrlVideo'>
												</div>

										</div>
										<div class='modal-footer'>
											<button  id='sendLive' type='submit' class='btn btn-success'>Salvar</button>
										</div>
										</form>
									</div>
								</div>

								";

								if ($url != "") {
									if ($admin == 0) {

									echo "

											<div class='btn-group' style='float: right; margin-top: -13%; margin-right: 1.5%'>
												<button class='btn bmd-btn-fab bmd-btn-fab-sm dropdown-toggle' style='float: right; background: transparent; box-shadow: none;' type='button' id='ex3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
													<i style='color: #fff' class='fas fa-ellipsis-v'></i>
												</button>
												<div class='dropdown-menu card-dark dropdown-menu-right' style='box-shadow: 0 12px 28px 0 rgba(0,0,0,0.02), 0 2px 4px 0 rgba(0,0,0,0.01), inset 0 0 0 1px rgba(255,255,255,0.05)!important;' aria-labelledby='ex3'>
									";


										if ($statusLive == 0) {
										echo "
														<button id='updateLiveStatus' onclick=window.location.href='assets/functions/updateLiveStatus.php?idUsuario=$idUsuario&liveId=$liveId&status=1' class='dropdown-item' type='button'>Ativar Live</button>

										";
										} else {
											echo "
															<button id='updateLiveStatus' onclick=window.location.href='assets/functions/updateLiveStatus.php?idUsuario=$idUsuario&liveId=$liveId&status=0' class='dropdown-item' type='button'>Desativar Live</button>

											";
										}

										if ($statusCommentLive == 0) {
										echo "
														<button id='updateLiveComment' onclick=window.location.href='assets/functions/updateLiveComment.php?idUsuario=$idUsuario&liveId=$liveId&status=1' class='dropdown-item' type='button'>Ativar Comentários</button>

										";
										} else {
											echo "
															<button id='updateLiveComment' onclick=window.location.href='assets/functions/updateLiveComment.php?idUsuario=$idUsuario&liveId=$liveId&status=0' class='dropdown-item' type='button'>Desativar Comentários</button>

											";
										}


									echo "
												</div>
											</div>
									";
									}

									echo "<iframe style='width: 100%; height:210px' src='$url' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";

								} else {
									echo "

									<div class='card-dark' id='thumbLive' style='padding: 15px'>
									";

							if ($admin == 0) {

								echo "

									<div class='btn-group' style='float: right; margin-top: -13%; margin-right: 3%'>
										<button class='btn bmd-btn-fab bmd-btn-fab-sm dropdown-toggle' style='float: right; margin: -22px -21px 0px 0px; background: transparent; box-shadow: none;' type='button' id='ex3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
											<i style='color: #fff' class='fas fa-ellipsis-v'></i>
										</button>
										<div class='dropdown-menu card-dark dropdown-menu-right' style='box-shadow: 0 12px 28px 0 rgba(0,0,0,0.02), 0 2px 4px 0 rgba(0,0,0,0.01), inset 0 0 0 1px rgba(255,255,255,0.05)!important;' aria-labelledby='ex3'>
							";

								if ($statusLive == 1 && $url == "") {
								echo "

												<button id='updateLiveStatus' onclick='viewUrlLive()' class='dropdown-item' type='button'>Ativar Live</button>

								";
								} else {
									echo "
													<button id='updateLiveStatus' onclick=window.location.href='assets/functions/updateLiveStatus.php?idUsuario=$idUsuario&liveId=$liveId&status=0' class='dropdown-item' type='button'>Desativar Live</button>

									";
								}

								if ($statusCommentLive == 0) {
								echo "
												<button id='updateLiveComment' onclick=window.location.href='assets/functions/updateLiveComment.php?idUsuario=$idUsuario&liveId=$liveId&status=1' class='dropdown-item' type='button'>Ativar Comentários</button>

								";
								} else {
									echo "
													<button id='updateLiveComment' onclick=window.location.href='assets/functions/updateLiveComment.php?idUsuario=$idUsuario&liveId=$liveId&status=0' class='dropdown-item' type='button'>Desativar Comentários</button>

									";
								}


							echo "
										</div>
									</div>

							";

							}

							echo "
													<img style='width: 10%; margin-top: -11px; display: inline-block; margin-right: 10px' src='assets/images/live.png' /><h4 style='display: inline-block;'>Próxima Transmissão: </h4><br>
													<center>
													<img style='width: 100%; margin-bottom: 10px;' src='assets/uploads/banner/$banner'>
													</center>
													<h5 style='float: left; margin-bottom: 0'>$titulo</h5>
													<h5 style='float: right; margin-bottom: 0'>$dataLive às $horaLive</h5>
													<div class='clearfix'></div>
													</div>
											";
								}

							} while($data = $result -> fetch());
						} else {

							echo "<center><img src='assets/images/video.png' style='margin-top: 25%; width:50%'><br><br><p style='color: #b0b3b8;'>Aguardando Atualizações!</p></center>";


						}

					  if ($statusCommentLive == 1) {
							$item = 3;
							include("assets/includes/sendComment.php");


						?>

							<script>

							function searchLiveComments() {

							 // Declaração de Variáveis
							 var liveId = document.getElementById("liveId").value;
							 var result = document.getElementById("viewLiveComments");
							 var xmlreq = CriaRequest();


							 // Iniciar uma requisição
							 xmlreq.open("GET", "assets/functions/searchLiveComments.php?liveId=" + liveId, true);
							 setTimeout(searchLiveComments, 1000);

							 // Atribui uma função para ser executada sempre que houver uma mudança de ado
							 xmlreq.onreadystatechange = function(){

								 // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
								 if (xmlreq.readyState == 4) {

									 // Verifica se o arquivo foi encontrado com sucesso
									 if (xmlreq.status == 200) {

										 result.innerHTML = xmlreq.responseText;
										 document.getElementById("viewLiveComments").value = result.innerHTML;
									 }else{
										 result.innerHTML = "Erro: " + xmlreq.statusText;
									 }
								 }
							 };
							 xmlreq.send(null);
							}

						</script>
						<div class="col-md-2" style="margin-top: 15px;">
							<div style='height: 1200px; overflow-y: auto' id='viewLiveComments'></div>
						</div>


						<?php

						}

						?>

						</div>
					  <div class="tab-pane fade" id="nav-videos" role="tabpanel" aria-labelledby="nav-videos-tab">

							<?php

							$select = "SELECT * from lives ORDER BY id DESC";
							$result = $conexao -> prepare($select);
							$result -> execute();
							$count = $result->rowCount();

							if ($data = $result -> fetch()) {
								do {

									$idVideo       = $data['id'];
									$titulo        = $data['titulo'];
									$banner        = $data['banner'];
									$url           = $data['url'];
									$statusLive    = $data['statusLive'];
									$statusComment = $data['statusComment'];
									$dataVideos    = date("d/m", strtotime($data['dataHora']));
									$horaVideos    = date("H:i", strtotime($data['dataHora']));
									$statusLive    = $data['status'];

									if ($url != "") {

										echo "
										<h5>".$titulo."</h5>
										";

								if ($admin == 0) {
								echo "
										<div class='btn-group' style='float: right; margin-top: -5%; margin-right: 3%'>
											<button class='btn bmd-btn-fab bmd-btn-fab-sm dropdown-toggle' style='float: right; margin: -22px -21px 0px 0px; background: transparent; box-shadow: none;' type='button' id='ex3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
												<i style='color: #fff' class='fas fa-ellipsis-v'></i>
											</button>
											<div class='dropdown-menu card-dark dropdown-menu-right' style='box-shadow: 0 12px 28px 0 rgba(0,0,0,0.02), 0 2px 4px 0 rgba(0,0,0,0.01), inset 0 0 0 1px rgba(255,255,255,0.05)!important;' aria-labelledby='ex3'>
								";

									if ($statusLive == 0) {
									echo "
													<button id='updateLiveStatus' onclick=window.location.href='assets/functions/updateLiveStatus.php?idUsuario=$idUsuario&liveId=$idVideo&status=1' class='dropdown-item' type='button'>Ativar Live</button>

									";
									} else {
										echo "
														<button id='updateLiveStatus' onclick=window.location.href='assets/functions/updateLiveStatus.php?idUsuario=$idUsuario&liveId=$idVideo&status=0' class='dropdown-item' type='button'>Desativar Live</button>

										";
									}

									if ($statusCommentLive == 0) {
									echo "
													<button id='updateLiveComment' onclick=window.location.href='assets/functions/updateLiveComment.php?idUsuario=$idUsuario&liveId=$idVideo&status=1' class='dropdown-item' type='button'>Ativar Comentários</button>

									";
									} else {
										echo "
														<button id='updateLiveComment' onclick=window.location.href='assets/functions/updateLiveComment.php?idUsuario=$idUsuario&liveId=$idVideo&status=0' class='dropdown-item' type='button'>Desativar Comentários</button>

										";
									}


								echo "
											</div>
										</div>
								";

								}

								echo "
										<iframe style='width: 100%; margin-bottom: 15px; height: 210px' src='$url' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
									} else {
										echo "
											<h5>$titulo estreia dia $dataVideos às $horaVideos</h5>
										";
										if ($admin == 0) {

										echo "
												<div class='btn-group' style='float: right; margin-top: -5%; margin-right: 3%'>
													<button class='btn bmd-btn-fab bmd-btn-fab-sm dropdown-toggle' style='float: right; margin: -22px -21px 0px 0px; background: transparent; box-shadow: none;' type='button' id='ex3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
														<i style='color: #fff' class='fas fa-ellipsis-v'></i>
													</button>
													<div class='dropdown-menu card-dark dropdown-menu-right' style='box-shadow: 0 12px 28px 0 rgba(0,0,0,0.02), 0 2px 4px 0 rgba(0,0,0,0.01), inset 0 0 0 1px rgba(255,255,255,0.05)!important;' aria-labelledby='ex3'>
										";

											if ($statusLive == 0) {
											echo "
															<button id='updateLiveStatus' onclick=window.location.href='assets/functions/updateLiveStatus.php?idUsuario=$idUsuario&liveId=$idVideo&status=1' class='dropdown-item' type='button'>Ativar Live</button>

											";
											} else {
												echo "
																<button id='updateLiveStatus' onclick=window.location.href='assets/functions/updateLiveStatus.php?idUsuario=$idUsuario&liveId=$idVideo&status=0' class='dropdown-item' type='button'>Desativar Live</button>

												";
											}

											if ($statusCommentLive == 0) {
											echo "
															<button id='updateLiveComment' onclick=window.location.href='assets/functions/updateLiveComment.php?idUsuario=$idUsuario&liveId=$idVideo&status=1' class='dropdown-item' type='button'>Ativar Comentários</button>

											";
											} else {
												echo "
																<button id='updateLiveComment' onclick=window.location.href='assets/functions/updateLiveComment.php?idUsuario=$idUsuario&liveId=$idVideo&status=0' class='dropdown-item' type='button'>Desativar Comentários</button>

												";
											}

										echo "
													</div>
												</div>
										";

										}

										echo "
												<img style='width: 100%; margin-bottom: 15px; height: 210px' src='assets/uploads/banner/$banner'>

										";
									}

								} while($data = $result -> fetch());
							} else {

								echo "<center><img src='assets/images/video.png' style='margin-top: 25%; width:50%'><br><br><p style='color: #b0b3b8;'>Aguardando Atualizações!</p></center>";


							}

							?>

						</div>
					</div>
			</div>
		</div>
	</div>

</div>

<div class="card-body background_dark animated fadeInRight" style="border: 0; display: none" id="newLiveVideo">
		<form action="assets/functions/newLive.php?idUsuario=<?php echo $idUsuario; ?>" name="newLive" id="newLive" method="post" enctype="multipart/form-data">

			<div class="row">

				<div class="col-lg-2">

					<div id="banner_image">
						<center>
						<label for="upload">
									<img src="assets/images/picture.png" class="animated fadeIn" id="banner" style="width: 60%; height: 150px">
									<input type="file" id="upload" onchange="preview_image(event)" name="uploadBanner[]" style="display:none">
						</label>
					</center>

					<script type='text/javascript'>
						function preview_image(event) {
						 var reader = new FileReader();
						 reader.onload = function() {
							var output = document.getElementById('banner');
							document.getElementById('banner').style.width = '100%';
							document.getElementById('banner').style.height = '200px';
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
						<input type="datetime-local" class="form-control" id="dataHora" name="dataHora">
						<span class="bmd-help">* Campo Obrigatório</span>
					</div>

					<div class="form-group">
						<label for="enderecoVideo" class="bmd-label-floating">URL do Vídeo do Youtube</label>
						<input type="text" class="form-control" id="enderecoVideo" name="enderecoVideo">
					</div>

					<div class="switch">
				    <label style="padding-top: 3px; margin-left: 5px">
				      <input type="checkbox" id="statusComment" name="statusComment" value="1" checked> Comentário
				    </label>
				  </div>

					<div class="switch">
				    <label style="padding-top: 3px; margin-left: 5px">
				      <input type="checkbox" id="statusLive" name="statusLive" value="1" checked> No Ar
				    </label>
				  </div>
				</div>

		</div>

		<div class="clearfix"></div>
		<div class="modal-footer" style="border-top:0; padding-left: 0; padding-right: 0;">

			<script type="text/javascript">
				function verificaLive(){
					if ($('#dataHora').val() == '' || $('#titulo').val() == ''){

						document.getElementById('snackbar-container').style.backgroundColor = "#f44336";
						document.getElementById('cadLive').setAttribute("data-content", "<strong>Atenção! </strong><br>Campos Obrigatórios!");

						setTimeout(() => {
								$('.snackbar-opened').remove();
						}, 5000);

						return false;
					} else {
						document.getElementById('titulo').readOnly = 'true';
						document.getElementById('enderecoVideo').readOnly = 'true';

						document.getElementById('snackbar-container').style.backgroundColor = "#4caf50";
						document.getElementById('cadLive').style.visibility = 'hidden';
						document.getElementById('cadLive').style.display = 'none';
						document.getElementById('cadLive').setAttribute("data-content", "Live publicada com Sucesso!");

						setTimeout(() => {
								document.newLive.submit();
						}, 3000);

					}
				}
			</script>
			<button type="button" class="btn btn-success" data-toggle="snackbar" data-content="" data-html-allowed="false" data-timeout="0" onclick="verificaLive()" id="cadLive"><i class="fa fa-save"></i>&nbsp; Salvar</button>
		</div>
		<div class="clearfix"></div>
		</form>
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


<?php

include("assets/includes/menu.php");

?>

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fmask/3.3.4/jquery.inputmask.bundle.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js" integrity="sha256-CIc5A981wu9+q+hmFYYySmOvsA3IsoX+apaYlL0j6fg=" crossorigin="anonymous"></script>

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
