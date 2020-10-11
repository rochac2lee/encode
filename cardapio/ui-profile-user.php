<?php

if (isset($_GET['id'])) {
		$idProfile = $_GET['id'];
}

require('assets/includes/session.php');

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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.js"></script>

</head>

<body class="background_dark" style="z-index: 1000000000;">

<script>

function viewInsertUserCompany() {
	document.getElementById("statusUser").style.display = "none";
	document.getElementById("infoUser").style.display = "none";
	document.getElementById("insertUserCompany").style.display = "block";
}

function voltar() {
	document.getElementById("statusUser").style.display = "block";
	document.getElementById("infoUser").style.display = "block";
	document.getElementById("insertUserCompany").style.display = "none";
}

function ocultarBotao() {
	document.getElementById("updateUserCompany").readOnly = "true";
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

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div class="card mb-3" style="background: transparent; border: 0; box-shadow: none; margin-bottom: 100px!important;">
			<div class="card-header top_dark">
					<h5 style="margin-bottom: 0;">
						<?php if ($admin == 0) { ?>
							<i class="fas fa-chevron-left" onclick="window.location.href = 'ui-users.php'; loading()" style="float: left; margin-right: 15px; color: #f3e5e5!important"></i>
						<?php } else { ?>
							<i class="fas fa-chevron-left" onclick="window.location.href = 'ui-home.php'; loading()" style="float: left; margin-right: 15px; color: #f3e5e5!important"></i>
						<?php } ?>
					</h5>
					<?php

					$select = "SELECT * FROM usuarios WHERE id = '$idProfile'";
					$result = $conexao -> prepare($select);
					$result -> execute();
					$count = $result->rowCount();

					if ($data = $result->fetch()) {
						do {

							$nomeCompleto = $data['nome'];
							$separaNome   = explode(" ", $nomeCompleto);
							$primeiroNome = $separaNome[0];

						} while($data = $result->fetch());
					}

					?>

					<center><strong><h5 id="titulo" style="margin-bottom: 0;">Perfil de <?php echo $primeiroNome; ?></h5></strong></center>
			</div>

			<div class="card-body background_dark" style="background-color: transparent!important; margin: -15px!important;">
				<div class="card mb-3 card-dark" style="box-shadow: none; border: 0; margin-bottom: 0px!important; ">
				<?php

				$select = "SELECT * FROM usuarios WHERE id = '$idProfile'";
				$result = $conexao -> prepare($select);
				$result -> execute();
				$count = $result->rowCount();

				if ($data = $result->fetch()) {
					do {

						$idCliente        = $data['id'];
						$nomeCompleto     = $data['nome'];
						$avatar           = $data['avatar'];
						$idEmpresa        = $data['idEmpresa'];
						$email            = $data['email'];
						$tipo             = $data['tipo'];
						$status           = $data['status'];
						$redefineSenha    = $data['redefineSenha'];
						$dataHoraCadastro = $data['data_hora_cadastro'];

						if ($avatar == "admin.png") {
							$endereco = "assets/images/";
							$avatar   = "user_plus.png";
							$style = "margin-top: 15px; width: 130px; height: 130px";
						} else {
							$endereco = "assets/uploads/avatar/";
							$style = "object-fit: cover; margin-top: 15px; width: 130px; height: 130px; border-radius: 50%; border: 8px solid #18191a;";
						}

						switch ($tipo) {
							case 0:
								$tipoTxt = "Administrador";
								break;

							case 1:
								$tipoTxt = "Usuário Comum";
								break;
						}

							echo  "
							<div class='card-body card-dark animated fadeIn' id='infoUser' style='padding: 5px; padding-top: 0; margin-bottom: 0px!important;'>

									<form action='assets/functions/newAvatar.php?idUsuario=$idUsuario' method='post' enctype='multipart/form-data' id='frmAvatar' name='frmAvatar'>
									<div id='avatar_image'>
										<center>
										<label for='uploadAvatar'>
													<img src='$endereco$avatar' class='animated fadeIn' id='userPicture' style='$style'>
													<input type='file' id='uploadAvatar' onchange='preview_image(event)' name='uploadAvatar[]' style='display:none'>
										</label>
										<button class='btn btn-raised btn-primary bmd-btn-fab bmd-btn-fab-sm dropdown-toggle animated fadeIn' id='sendAvatar' type='submit' onclick=this.style.display='none' style='display: none; position: absolute; margin: 27.5% 0'><i class='fa fa-save'></i></button>
									<h4 style='margin-top: 15px;'>$nomeCompleto</h4>
									</center>
									</form>

									<div class='btn-group' style='float: right;'>
									  <button class='btn btn-raized btn-primary bmd-btn-fab bmd-btn-fab-sm dropdown-toggle' type='button' id='ex3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
									    <i class='fas fa-ellipsis-v'></i>
									  </button>
									  <div class='dropdown-menu card-dark dropdown-menu-right' style='box-shadow: 0 12px 28px 0 rgba(0,0,0,0.02), 0 2px 4px 0 rgba(0,0,0,0.01), inset 0 0 0 1px rgba(255,255,255,0.05)!important;' aria-labelledby='ex3'>
							";

							if ($admin == 0) {
								if ($status == 0) {
								echo "
										    <button id='updateUserStatus' onclick=window.location.href='assets/functions/updateUserStatus.php?idUsuario=$idProfile&status=1' class='dropdown-item' type='button'>Ativar</button>

								";
								} else {
									echo "
													<button id='updateUserStatus' onclick=window.location.href='assets/functions/updateUserStatus.php?idUsuario=$idProfile&status=0' class='dropdown-item' type='button'>Desativar</button>

									";
								}
							}

							echo "<button id='updateUserPass' onclick=window.location.href='ui-new-password.php?id=$idProfile' class='dropdown-item' type='button'>Redefinir Senha</button>";

							echo "
										</div>
									</div>
									<br><br>
									<p><strong><i class='fas fa-envelope'></i>&nbsp; Email</strong><br>".$email."</p>
									<p><strong><i class='fas fa-calendar-alt'></i>&nbsp; Cadastrado em</strong></br>".$dataHoraCadastro."</p>
							";

							if ($viewClenteStatus == 1 and $viewRedefineSenha == 1) {
								 echo "<h6>* Aguardando confirmação do usuário!</h6>";
							}

							} while ($data = $result->fetch());
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<script type='text/javascript'>
	function preview_image(event) {
	 var reader = new FileReader();
	 reader.onload = function() {
		var output = document.getElementById('userPicture');
		output.src = reader.result;
		document.getElementById('userPicture').style.borderRadius = '50%';
		document.getElementById('sendAvatar').style.display = 'initial';
	 }
	 reader.readAsDataURL(event.target.files[0]);
	}
</script>

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
