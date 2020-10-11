<?php

try {
	$conexaoDelivery = new PDO('mysql:host=opmy0018.servidorwebfacil.com:3306;dbname=rochac2lee_sistemaDelivery', 'rocha_delivery', 'qwerty@848625');
	$conexaoDelivery -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	echo 'Houve um Erro na conexao com o banco de dados: ' . $e -> getMessage();
}


require('assets/includes/header.php');


$select = "SELECT * from clientes_encode";
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

      $file = $nomeEmpresa."/index.php";
      $file2 = $nomeEmpresa."/ui-view-product.php";
      if (!file_exists($file)) {
        $file = fopen($file, "w");
        $text = '$empresa';
        $content = "<?php $text = '$empresaAtual'; ?>";
        $content.= file_get_contents("pizzariadelivery(demo)/index.php");
        fwrite($file, $content);
      } else {
				if ($idEmpresaAtual != 2) {
					//Regrava o conteúdo atualizado
					unlink($file);
					$file = fopen($file, "w");
					$text = '$empresa';
	        $content = "<?php $text = '$empresaAtual'; ?>";
	        $content.= file_get_contents("pizzariadelivery(demo)/index.php");
					fwrite($file, $content);
				}
			}

			if (!file_exists($file2)) {
        $file2 = fopen($file2, "w");
        $text2 = '$empresa';
        $content2 = "<?php $text2 = '$empresaAtual'; ?>";
        $content2 = file_get_contents("pizzariadelivery(demo)/ui-view-product.php");
        fwrite($file2, $content2);
      } else {
				if ($idEmpresaAtual != 2) {
					//Regrava o conteúdo atualizado
					unlink($file2);
					$file2 = fopen($file2, "w");
					$text2 = '$empresa';
	        $content2 = "<?php $text2 = '$empresaAtual'; ?>";
	        $content2.= file_get_contents("pizzariadelivery(demo)/ui-view-product.php");
					fwrite($file2, $content2);
				}
			}


			try {
				$conexao = new PDO("mysql:host=opmy0018.servidorwebfacil.com:3306;dbname=$bancoDB", "$usuarioDB", "$senhaDB");
				$conexao -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				echo 'Houve um Erro na conexao com o banco de dados: ' . $e -> getMessage();
			}

			$selectEmpresa = "SELECT * from configs ORDER BY id_config DESC LIMIT 1";
			$resultEmpresa = $conexaoDelivery -> prepare($selectEmpresa);
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

	.bmd-form-group {
    position: relative;
    padding-top: 0!important;
}

.nav-cat::-webkit-scrollbar {
    display: none;
}

</style>

<script>

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i=0; i<ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1);
      if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
  }
  return "";
}

function Checkout() {
    var idPedido     = getCookie("idPedido");
    var statusPedido = getCookie("statusPedido");
    if(idPedido > 0 && statusPedido > 0) {

      window.location.href='ui-checkout.php?status=' + statusPedido + '&idPedido=' + idPedido;
    } else {
     window.location.href='ui-shopping-cart.php';
    }
}

</script>

<?php require('assets/includes/menuBar.php'); ?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 animated fadeIn" style="padding-left: 0;" id="navSolicitacao">
  <div class="card mb-3" style="background: transparent; box-shadow: none;">

    <div class="card-header top_dark">
      <div class="bar" onclick="viewMenuBar()">
        <i style="display: inline-flex;" id="btnMenuBar" class="fa fa-2x fa-bars"></i>
      </div>
      <div style="width: 70%; margin-left: 12%;position: absolute; z-index: 0">
        <center><img src="../sistemaDelivery/assets/uploads/sistema/Encode_white.png" style="text-align: center; margin: -7px; margin-left: -15px; border-radius: 50%; width: 40px; "></center>
      </div>

      <div class='btn-group' style='float: right; margin: 4px -4px 0px 0px;z-index: 1; display:none' id='optEdit'>
          <i onclick='Checkout();' style='display: inline-flex; color: #f9c215; font-size: 20px' id='btnMenuBar' class='fa fa-shopping-cart'> &nbsp;<span id="totalItemsShoppingCart" style="color: #fff; font-family: 'Lato', sans-serif!important; font-style: normal; font-size: 15px;"></span></i>
      </div>
    </div>

    <script>
      function qtdItemsShoppingCart() {
        var total = 0;
        var x = 0;
        var i;
        for (i = 1; i <= 50; i++) {
          x = Number(getCookie('qtdProduto' + i));
          total += x;
        }
        document.getElementById('totalItemsShoppingCart').innerHTML = total;
      }
      qtdItemsShoppingCart();
    </script>

    <div class="card-body background_dark" style="border: 0; padding-top: 0;">
      <div class="row">
        <div class="owl-1 owl-carousel owl-theme" style="margin-bottom: 10px">
          <div class="item"><img class="d-block w-100" src="assets/images/Banner.png" alt="slide"></div>
          <div class="item"><img class="d-block w-100" src="assets/images/Banner02.png" alt="slide"></div>
          <div class="item"><img class="d-block w-100" src="assets/images/Banner03.png" alt="slide"></div>
          <div class="item"><img class="d-block w-100" src="assets/images/Banner04.png" alt="slide"></div>
        </div>

        <h6 class="subtitle m-none" style="text-transform: Capitalize">Cardápios</h6>

        <div class="row" style="align-items: center;">

        <?

        $select = "SELECT * from clientes_encode ORDER BY id DESC";
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

                    echo "

                      <div class='col-md-6' onclick=window.location.href='$nomeEmpresa' style='width: 33%; padding: 15px; text-align: center'>
                        <img src='../sistemaDelivery/assets/uploads/sistema/$logo_sistema' class='img-fluid' width='100%'>
                      </div>

                    ";


                  } while ($dataEmpresa = $resultEmpresa -> fetch());
              	}

        		} while ($data = $result -> fetch());
        	}

        ?>
        <!-- dark -->
        </div>

      </div>
    </div>
  </div>
</div>

</div>
