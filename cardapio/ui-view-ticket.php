<?php

if (isset($_GET['id'])) {
		$idSolicitacaoAtual = $_GET['id'];
}

$pasta = 'assets/uploader/uploads/chamado_n'.$idSolicitacaoAtual;

if(!is_dir($pasta)) {
	mkdir($pasta);
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

<body class="background_dark" style="z-index: 1000000000;" onload="getDateTime()">

<script>

function solucao() {
	document.getElementById("infoTicket").style.display = "none";
	document.getElementById("updatesTicket").style.display = "none";
	document.getElementById("optEdit").style.display = "none";
	document.getElementById("closeTicket").style.display = "block";
	document.getElementById("optCancel").style.display = "block";
}

function voltar() {
	document.getElementById("infoTicket").style.display = "block";
	document.getElementById("updatesTicket").style.display = "block";
	document.getElementById("optEdit").style.display = "block";
	document.getElementById("closeTicket").style.display = "none";
	document.getElementById("optCancel").style.display = "none";
}

</script>

<div class="row">

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="navAtendimentos">
		<div class="card mb-3" style="background: transparent; border: 0; box-shadow: none; margin-bottom: 100px!important;">
			<div class="card-header top_dark">

					<h5 style="margin-bottom: 0;">
							<i class="fas fa-chevron-left" onclick="window.location.href = 'ui-tickets.php'; loading()" style="float: left; margin-right: 15px; color: #f3e5e5!important"></i>
					</h5>
					<center><strong><h5 id="titulo" style="margin-bottom: 0;">Chamado n° <?php echo $idSolicitacaoAtual; ?></h5></strong></center>

			</div>

			<?php

				$select = "SELECT status FROM chamados WHERE codigo = '$idSolicitacaoAtual'";
				$result = $conexao -> prepare($select);
				$result -> execute();
				$count = $result->rowCount();

				if ($data = $result->fetch()) {
					do {

						$viewTicketStatus    = $data['status'];

						switch ($viewTicketStatus) {
							case 1:
								$statusTicket = "Em Aberto";
								$btn = 'btn btn-raised btn-primary';
								break;

							case 2:
							 $statusTicket = "Em Manutenção";
							 $btn = 'btn btn-raised btn-info';
							 break;

							 case 3:
							 $statusTicket = "Solucionado";
							 $btn = 'btn btn-raised btn-success';
							 break;

						}

						echo  "
						<div class='card-body card-dark animated fadeInRight ".$btn."' id='statusTicket' style='padding: 0!important; background-color: #3a3b3c; text-transform: none; color: #fff!important; border-radius: 6px;'>
								<center><h3 style='margin: 10px;'>".$statusTicket."</h3></center>
						</div>

						";

					} while ($data = $result->fetch());
				}

			?>

			<div class="card-body background_dark" style="background-color: transparent!important; margin: -15px!important;">
				<div class="animated fadeInDown" style="float: left;">
					<button class="btn btn-raised btn-primary" style="padding-left: 12.5px; padding-bottom: 50px; width: 10%; padding-top:100px!important; padding-bottom: 5%;">
						<center><i class="fa fa-info"></i></center>
					</button>
				</div>
				<div class="card mb-3 card-dark" style="box-shadow: none; border: 0; margin-bottom: 0px!important;">
				<?php

					$select = "SELECT
										   chamados.idCliente, chamados.idEmpresa, chamados.assunto, chamados.descricao, chamados.data_hora_cadastro, chamados.data_hora_atualizacao, usuarios.nome, empresas.empresa
										 FROM chamados
										 INNER JOIN
										 	 usuarios
										 ON chamados.idCliente = usuarios.id
										 LEFT JOIN
										 	 empresas
										 ON chamados.idEmpresa = empresas.id
										 WHERE chamados.codigo = '$idSolicitacaoAtual'";
					$result = $conexao -> prepare($select);
					$result -> execute();
					$count = $result->rowCount();

					if ($data = $result->fetch()) {
						do {

							$viewTicketId        = $data['codigo'];
							$viewTicketIdCliente = $data['idCliente'];
							$viewTicketIdEmpresa = $data['idEmpresa'];
							$viewTicketCliente   = $data['nome'];
							$viewTicketEmpresa   = $data['empresa'];
							if ($viewTicketEmpresa == '')
								$viewTicketEmpresa = 'Não Informado';
							$viewTicketAssunto   = $data['assunto'];
							$viewTicketDescricao = $data['descricao'];
							$viewTicketDataCad   = $data['data_hora_cadastro'];
							$viewTicketDataUpd   = $data['data_hora_atualizacao'];


							echo  "
							<div class='card-body card-dark animated fadeInRight' id='infoTicket' style='padding: 5px; margin-bottom: 0px!important;'>
									<h4><strong>Dados do Chamado</strong></h4>
									<p><strong><i class='fas fa-user'></i>&nbsp; Solicitante</strong><br>".$viewTicketCliente."</p>
									<p><strong><i class='fas fa-map-marker-alt'></i>&nbsp; Empresa</strong><br>".$viewTicketEmpresa."</p>
									<p><strong><i class='fas fa-calendar-alt'></i>&nbsp; Última Atualização</strong><br>".date("d/m/Y H:i:s", strtotime($viewTicketDataUpd))."</p>
									<p><strong><i class='fas fa-info-circle'></i>&nbsp; Assunto</strong></br>".$viewTicketAssunto."</p>
									<p><strong><i class='fas fa-quote-left'></i>&nbsp; Descrição</strong></br>".$viewTicketDescricao."</p>
							";

					?>

					<div id="optEdit" class="animated fadeIn">
						 <span class='dot_save' style="right: 0px; top: 3px;" onclick="window.location.href = 'ui-ticket-uploads.php?id=<?php echo $idSolicitacaoAtual; ?>'; loading();"><i style='margin: 15px; line-height: unset;' class='fa fa-paperclip'></i></span>
				 </div>

					</div>

					<div id="updatesTicket">

					<?php

							} while ($data = $result->fetch());
						}

						$select = "SELECT * FROM processando_chamados WHERE idChamado = '$idSolicitacaoAtual' order by id ASC";
						$result = $conexao -> prepare($select);
						$result -> execute();
						$count = $result->rowCount();

						if ($data = $result->fetch()) {
							do {
								$descricao_atualizacao = $data['descricao'];
								$statusAtualizado      = $data['status'];
								$dataHoraAtualizacao   = $data['data_hora_atualizacao'];

								switch ($statusAtualizado) {
									case 1:
										$texto = 'Nova Atualização';
										break;

									case 2:
										$texto = 'Nova Atualização';
										break;

									case 3:
										$texto = 'Solução';
										break;

								}

								echo "

								<hr style='border-top: 1px solid #b0b3b8;'>

								<div class='card-body card-dark animated fadeInRight' style='padding: 5px;'>
										<h4><strong>".$texto."</strong></h4>
										<p>Descrição: ".$descricao_atualizacao."</p>
										<p><i class='fa fa-clock'></i>&nbsp; ".date("d/m/Y H:i:s", strtotime($dataHoraAtualizacao))."</p>
								</div>

								";

							} while($data = $result->fetch());
						}

					?>
				</div>

					<div class='card-body animated fadeIn card-dark' id='closeTicket' style='display: none; padding: 5px;'>

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

					 function getDateTime() {

						 // Declaração de Variáveis
						 var result = document.getElementById("divDateTime");
						 var xmlreq = CriaRequest();

						 var address = "assets/functions/getDateTime.php";

						 // Iniciar uma requisição
						 xmlreq.open("GET", address, true);
						 setTimeout(getDateTime, 1000); //5s

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

					 <form action="assets/functions/updateTicket.php?id_solicitacao=<?php echo $idSolicitacaoAtual; ?>&idUsuario=<?php echo $viewTicketIdCliente; ?>" name="updateTicket" id="updateTicket" method="post">

					<div id="divDateTime"></div>

					<div class="form-group" style="margin-top: -10px">
					<label>Status *</label>

					<select class="form-control" style="color: #b0b3b8" name="tipo_atualizacao" id="tipo_atualizacao" required="">
						<option>Selecione...</option>

					<?php

						$select = "SELECT id, status FROM status order by id ASC";
						$result = $conexao -> prepare($select);
						$result -> execute();
						$count = $result->rowCount();

						if ($data = $result->fetch()) {
							do {
								$idTipoSolucao = $data['id'];
								$solucao       = utf8_encode($data['status']);
					?>
						<option value="<?php echo $idTipoSolucao; ?>"><?php echo $solucao; ?></option>
					<?php
							} while ($data = $result->fetch());
						}
					?>
					</select>
					</div>

					<input type="text" name="viewEmpresa" value="<?php echo $viewTicketEmpresa; ?>" style="display: none;" id="viewEmpresa">

					<div class='form-group' style="margin-top: -10px">
					<label>Descrição *</label>
					<textarea class='form-control' style="color: #b0b3b8" type='text' name='descricao_atualizacao' id="descricao_atualizacao" required=''></textarea>
					</div>

					<script type="text/javascript">
					function verificaUpdateTicket(){
						if (document.updateTicket.descricao_atualizacao.value == ""){
							return false;
						} else {
							document.updateTicket.submit();
							document.getElementById('btnUpdateTicket').style.visibility = 'hidden';
							document.getElementById('btnUpdateTicket').style.display = 'none';
							alertUpdateTicket();
						}
					}
					</script>

						<button type='submit' class='btn btn-success' style='float: right;' onclick='verificaUpdateTicket()' id='btnUpdateTicket'><i class='fa fa-save'></i>&nbsp; Salvar</button>

					</form>

					</div>

				</div>
			</div>
		</div>

	</div>

</div>

<img src="assets/images/load_view.gif" id="loading" style="display: none; width: 10%; top: 5px; right: 5px; float: right; position: absolute; z-index: 999999;" />

<?php

if ($admin == 0) {

?>

<div id="optEdit" class="animated fadeIn">

		<span class='dot_save' style="display: none" onclick="window.location.href = 'ui-change-ticket.php?id=<?php echo $viewTicketId; ?>'; loading();"><i style='margin: 15px;' class='fa fa-file-signature'></i></span>

		<?php
				if ($viewTicketStatus != 3) {
		?>

		<span class='dot_edit' onclick="document.getElementById('titulo').innerHTML = 'Nova Ação'; solucao()"><i style='margin: 15px;' class='fa fa-check'></i></span>

		<?php
				}
		?>

</div>

<div id="optCancel" class="animated fadeIn" style="display: none;">

		<span class='dot_cancel' onclick="document.getElementById('titulo').innerHTML = 'Dados do Chamado'; voltar()"><i style='margin: 15px;' class='fas fa-times'></i></span>

</div>

<?php

}

include("assets/includes/menu.php");

?>
</body>

<script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/moment.min.js"></script>

<script src="assets/js/popper.min.js"></script>
<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
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
        maxSize: 100,
        extensions: ['jpg', 'jpeg', 'png', 'gif', 'psd', 'pdf'],
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


<script src="assets/js/pikeadmin.js"></script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

function alertUpdateTicket() {

$(document).ready(function(){

       swal("Feito!", "Chamado atualizado com sucesso!", "success");

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
