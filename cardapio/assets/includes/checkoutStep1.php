
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
    min-height: 180px;
    margin: 17px auto;
}
</style>

<script>

function viewCheckout(){

  var viewIdPedido = getCookie('idPedido');
  if (viewIdPedido != 0) {
    window.location.href='ui-checkout.php?idPedido=' + viewIdPedido;
  }
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
        <?php echo "<p style='color: #f9c215!important;'>Checkout</p>"; ?>
      </div>
    </div>

    <div class="card-body background_dark" style="background-color: #292728!important; border: 0; padding-top: 0;">
      <div class="row">

        <h6 class="subtitle m-none" style="text-transform: initial; margin-bottom: 0;">Dados de Contato</h6>

        <div class="card-body background_dark animated fadeInRight" style="background-color: #292728!important; border: 0; padding-top: 0; padding-bottom: 0;" id="newDevocional">
          <form action="assets/functions/newRequest.php" style="margin-bottom: 0;" name="frmCheckout" id="frmCheckout" method="post">

              <div class="row">

                <div class="col-lg-2" style="padding: 0">

                  <div class="form-group">
                    <label for="nomeCompleto" class="bmd-label-floating">Nome Completo</label>
                    <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto">
                    <span class="bmd-help">* Campo Obrigatório</span>
                  </div>

                  <div class="form-group">
                    <label for="celular" class="bmd-label-floating">Celular</label>
                    <input type="text" class="form-control" id="celular" name="celular">
                    <span class="bmd-help">* Campo Obrigatório</span>
                  </div>

                </div>

            </div>

            <div class="clearfix"></div>
            <div class="modal-footer" style="border-top:0; padding-left: 0; padding-right: 0;">

              <script type="text/javascript">

                function verifyCheckout(){
                  if (
                    $('#nomeCompleto').val() == '' ||
                    $('#celular').val() == ''
                    ){

                    document.getElementById('snackbar-container').style.backgroundColor = "#f44336";
                    document.getElementById('cadCheckout').setAttribute("data-content", "<strong>Atenção! </strong><br>Campos Obrigatórios!");

                    setTimeout(() => {
                        $('.snackbar-opened').remove();
                    }, 5000);

                    return false;
                  } else {
                    document.getElementById('nomeCompleto').readOnly = 'true';
                    document.getElementById('celular').readOnly = 'true';

                    document.getElementById('snackbar-container').style.backgroundColor = "#4caf50";
                    document.getElementById('cadCheckout').style.visibility = 'hidden';
                    document.getElementById('cadCheckout').style.display = 'none';
                    document.getElementById('cadCheckout').setAttribute("data-content", "Seguindo com a compra!");

                    setTimeout(() => {
                        document.frmCheckout.submit();
                    }, 1000);

                  }
                }
              </script>
            </div>
            <div class="clearfix"></div>
            </form>
        </div>


      </div>
    </div>

  </div>

</div>
<center>
  <div class='card-header animated fadeIn' id='btnCheckout' style='display: none; background-color: transparent; z-index: 1; width: 100%; position: fixed; bottom: 10px;'>
    <a class='pill-pedido' style='background-color: #292728;' data-toggle='snackbar' data-content='' data-html-allowed='false' data-timeout='0' onclick='verifyCheckout();' id='cadCheckout'>Continuar &nbsp;<i class='fa fa-arrow-right'></i></a>
  </div>
</center>

<script type="text/javascript">
  function verifyCheckoutBtn(){
    if (
      $('#nomeCompleto').val() != '' &&
      $('#celular').val() != ''
    ) { document.getElementById('btnCheckout').style.display = "block";
    }
  };

  setInterval(verifyCheckoutBtn, 1000);

  </script>
