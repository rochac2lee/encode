
<style>

hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    width: 105%;
    margin-left: -5%;
    float: left;
    border-top: 1px solid #fff;
}

.modal-content {
  background-color: #242526;
  color: #fff;
}
.modal-body {
  padding-bottom: 0!important;
}

.trumbowyg-box, .trumbowyg-editor {
    display: block;
    position: relative;
    word-break: break-word;
    border: 1px solid #DDD;
    width: 100%;
    min-height: 100px;
    margin-top: 0!important;
    margin-bottom: 0!important;
    margin: 17px auto;
}

.state-icon {
    width: 20%;
    float: left;
    display: inline-block;
}

.details-icon {
  margin-top: 5px;
  text-align: center;
  width: 10%;
  margin-right: 10px;
  float: left;
  display: inline-block;
}

.details-icon-p {
  color: #292728!important; font-weight: 500; margin: 0; width: 80%; display: inline-block; padding-top: 6px;
}

.hr {
  margin-top: 5px;
  margin-bottom: 5px;
  margin-left: 0;
}
</style>

<input type="text" style="display: none" id="viewIdPedido" value="<?php echo $idPedido; ?>">
<input type="text" style="display: none" id="viewStatusPedido" value="<?php echo $status; ?>">

<script>

function viewCheckout(){
  var viewIdPedido = document.getElementById('viewIdPedido').value;
  var viewStatusPedido = document.getElementById('viewStatusPedido').value;
  setCookie("idPedido", viewIdPedido, 30);
  setCookie("statusPedido", viewStatusPedido, 30);
	document.getElementById('Checkout').style.display = 'block';
}

function hideCheckout(){
	document.getElementById('Checkout').classList.add('animated');
	document.getElementById('Checkout').classList.add('fadeOutLeft');

	setTimeout (() => {
		document.getElementById('Checkout').classList.remove('fadeOutLeft');
		document.getElementById('Checkout').style.display = 'none';
	}, 1000);
}

</script>

<div class="checkout animated fadeInRight" id="Checkout" style="display: none;">

	<div class="card mb-3" style="background: transparent; box-shadow: none;">
    <div class="card-header top_dark">
      <div class="bar" onclick=window.location.href="ui-index.php">
        <i style="display: inline-flex;" id="btnMenuBar" class="fa fa-2x fa-arrow-left"></i>
      </div>
      <div style="width: 70%; margin-left: 12%;position: absolute; z-index: 0">
        <?php echo "<p style='color: #f9c215!important;'>Acompanhe seu pedido!</p>"; ?>
      </div>
    </div>

    <div class="card-body background_dark" style="background-color: #292728!important; border: 0; padding-top: 0;">
      <div class="row">

        <h6 class="subtitle m-none" style="text-transform: initial; margin-bottom: 0;">Dados do Pedido</h6>

        <div class="card-body background_dark animated fadeInRight" style="background-color: #292728!important; border: 0; padding-top: 0; padding-bottom: 0;" id="newDevocional">

              <div class="row">

                <div class="col-lg-2" style="padding: 0">

                  <?php

      						$select = "SELECT
                              pedidos.nome, pedidos.celular, pedidos.status, pedidos.formaPagamento, pedidos.data_hora_cadastro,
                              endereco_cliente.rua, endereco_cliente.numero, endereco_cliente.bairro, endereco_cliente.complemento, endereco_cliente.descricao
                             FROM pedidos
                             INNER JOIN endereco_cliente ON pedidos.id = endereco_cliente.idCliente
                             where pedidos.id = '$idPedido'";
        					$result = $conexao -> prepare($select);
        					$result -> execute();
        					$count = $result->rowCount();

        						if ($data = $result -> fetch()) {
        							do {

                        $formaPagamento = $data['formaPagamento'];
                        $status         = $data['status'];
                        $dataPedido     = $data['data_hora_cadastro'];
                        $dataPedido     = date("d/m/Y H:i", strtotime($dataPedido));

                        $nomeCliente    = $data['nome'];
                        $rua            = $data['rua'];
                        $numero         = $data['numero'];
                        $bairro         = $data['bairro'];
                        $complemento    = $data['complemento'];
                        $descricao      = $data['descricao'];

                        $enderecoCompleto = "Rua ".$rua.", n°. ".$numero.", bairro ".$bairro;

                        if ($complemento != "") {
                          $viewComplemento = $complemento;
                        }
                        if ($descricao != "") {
                          $viewDescricao = $descricao;
                        }

                        switch ($formaPagamento) {
                          case 1:
                            $pagamento = "Dinheiro";
                            break;

                          case 2:
                            $pagamento = "Cartão";
                            break;
                        }

                        echo '

                        <p>Pedido n° #'.$idPedido.'</p>
                        <div class="form-group" style="background-color: #fff; border-radius: 10px; padding: 15px">
                          <p style="color: #292728!important; font-weight: 700; margin: 0;">Pagamento em '.$pagamento.' diretamento com o Motoboy</p>
                        </div>

                        <div class="form-group" style="background-color: #fff; border-radius: 10px; padding: 15px">
                          <div class="state-icon">
                            <img style="width: 70%;" src="https://new-checkout.tiendanube.com/img/smile.png">
                          </div>
                          <p style="color: #292728!important; font-weight: 500; margin: 0;">Parabéns! Seu pedido foi realizado com sucesso!</p>
                        </div>

                        <div class="form-group" style="background-color: #fff; border-radius: 10px; padding: 15px">
                          <div class="details-icon">
                            <i class="fa fa-2x fa-map-marker-alt"></i>
                          </div>
                          <p style="color: #292728!important; font-weight: 500; margin: 0; width: 80%; display: inline-block;">'.$enderecoCompleto.'<br>'.$viewComplemento.'<br>'.$viewDescricao.'
                          </p>
                        </div>
                        ';

                      } while($data = $result -> fetch());
                    }

                  ?>
                  <div id="viewRequestStatus"></div>

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

                    function searchRequestStatus() {

                     // Declaração de Variáveis
                     var idPedido = getCookie('idPedido');
                     var result = document.getElementById("viewRequestStatus");
                     var xmlreq = CriaRequest();


                     // Iniciar uma requisição
                     xmlreq.open("GET", "assets/functions/searchRequestStatus.php?idPedido=" + idPedido, true);
                     setTimeout(searchRequestStatus, 1000);

                     // Atribui uma função para ser executada sempre que houver uma mudança de ado
                     xmlreq.onreadystatechange = function(){

                       // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
                       if (xmlreq.readyState == 4) {

                         // Verifica se o arquivo foi encontrado com sucesso
                         if (xmlreq.status == 200) {

                           result.innerHTML = xmlreq.responseText;
                           document.getElementById("viewRequestStatus").value = result.innerHTML;
                         }else{
                           result.innerHTML = "Erro: " + xmlreq.statusText;
                         }
                       }
                     };
                     xmlreq.send(null);
                    }

                    searchRequestStatus();

                  </script>

                  <div class="clearfix"></div>


                </div>

            </div>
        </div>

      </div>
    </div>

  </div>

</div>
