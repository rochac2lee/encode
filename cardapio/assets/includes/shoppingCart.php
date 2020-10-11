
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
</style>

<script>

function viewShoppingCart(){
	document.getElementById('shoppingCart').style.display = 'block';
}

function hideshoppingCart(){
	document.getElementById('shoppingCart').classList.add('animated');
	document.getElementById('shoppingCart').classList.add('fadeOutLeft');

	setTimeout (() => {
		document.getElementById('shoppingCart').classList.remove('fadeOutLeft');
		document.getElementById('shoppingCart').style.display = 'none';
	}, 1000);
}

</script>

<?php $cat = $_GET['cat']; ?>

<input type="text" style="display: none" value="<?php echo $cat ?>" id="categoria">

<div class="shoppingCart animated fadeInRight" id="shoppingCart" style="display: none;">

	<div class="card mb-3" style="background: transparent; box-shadow: none;">
    <div class="card-header top_dark">
      <div class="bar" onclick=window.location.href="ui-index.php?cat=<?php echo $cat; ?>">
        <i style="display: inline-flex;" id="btnMenuBar" class="fa fa-2x fa-arrow-left"></i>
      </div>
      <div style="width: 70%; margin-left: 12%;position: absolute; z-index: 0">
        <?php echo "<p style='color: #f9c215!important;'>Carrinho de Compras</p>"; ?>
      </div>
    </div>

    <div class="card-body background_dark" style="background-color: #292728!important; border: 0; padding-top: 0;">
      <div class="row">

        <?php

        for($i == 0; $i <= 50; $i++) {
          $x = "idProduto".$i;
          $idProduto = $_COOKIE[$x];

          $y = "qtdProduto".$i;
          $qtdProduto = $_COOKIE[$y];

          $select = "SELECT * FROM produtos where id = '$idProduto' order by id ASC";
          $result = $conexao -> prepare($select);
          $result -> execute();
          $count = $result->rowCount();

            if ($data = $result -> fetch()) {
              do {

                $id          = $data['id'];
                $nome        = $data['nome'];
                $descricao   = $data['descricao'];
                $banner      = $data['foto'];
                $preco       = $data['preco'];
                $precoPromo  = $data['precoPromo'];

                if ($preco == "") {
                  $preco = "Em Breve";
                }

                if ($precoPromo != "") {
                  $stylePreco = "text-decoration: line-through;";
                }

                echo "
                <div class='card-header card-dark' style='border: 0; padding: 5px; width: 100%; padding-bottom: 0;'>
                  <img style='float: left; margin-right: 15px; object-fit: cover; width:60px; height: 60px; border-radius: 50%; display: inline-flex' src='../manager/assets/uploads/banner/$banner'>
                  <div style='float: left; width: 60%;'>
                    <input type='text' id='idProduto$id' style='display: none;' value='$id'>
                    <input type='text' id='viewPreco$id' style='display: none;' value='$preco'>
                    <h5><strong>$nome</strong></h5>
                ";
          ?>

                    <div class="number-input" style="margin-bottom: 15px;">
                      <button type="button" onclick="removerPedido<?php echo $id; ?>(); this.parentNode.querySelector('input[type=number]').stepDown()" id="minus" >-</button>
                      <input class="quantity" min="1" id="qtd<?php echo $id; ?>" value="<?php echo $qtdProduto; ?>" type="number">
                      <input class="quantity" min="1" style="display: none" id="qtdMenos<?php echo $id; ?>" value="<?php echo ($qtdProduto - 1); ?>" type="number">
                      <input class="quantity" min="1" style="display: none" id="qtdMais<?php echo $id; ?>" value="<?php echo ($qtdProduto + 1); ?>" type="number">
                      <button type="button" onclick="incluirPedido<?php echo $id; ?>(); this.parentNode.querySelector('input[type=number]').stepUp()" id="plus" class="plus">+</button>
                    </div>

          <?php

                echo "
                  </div>
                    <i onclick='removeItem$id()' style='margin-bottom: 2%; float: right; color: #949393;' class='fa fa-trash'></i>
                    <p id='preco$id' style='margin-top: 2%; $stylePreco font-size: 18px; margin-top: 10%; margin-right: -10px; float: right'></p>
                    <p style='margin-top: -5%; font-size: 18px; border-radius: 20px; float: right'>$precoPromo</p>
                </div>
                ";

          ?>

                    <script>

                    var categoria = document.getElementById('categoria').value;

                    function loadPreco<?php echo $id; ?>() {
                      var qtd       = Number(document.getElementById('qtd<?php echo $id; ?>').value);

                      var viewPreco = parseFloat(document.getElementById('viewPreco<?php echo $id; ?>').value.replace(',','.'));

                      var total = qtd * viewPreco;

                      total = total.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});

                      document.getElementById('preco<?php echo $id; ?>').innerHTML = total;
                    };

                    function removerPedido<?php echo $id; ?>() {

                      var idProduto = getCookie('idProduto<?php echo $id; ?>');
                      var qtdMenos  = Number(getCookie('qtdProduto<?php echo $id; ?>') - 1);
                      var viewPreco = parseFloat(document.getElementById('viewPreco<?php echo $id; ?>').value.replace(',','.'));
                      var preco     = document.getElementById('preco<?php echo $id; ?>');

                      setCookie("idProduto" + idProduto, idProduto, 30);
                      setCookie("qtdProduto" + idProduto, qtdMenos, 30);

                      var total = qtdMenos * viewPreco;

                      total = total.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});

                      document.getElementById('preco<?php echo $id; ?>').innerHTML = total;

                    };

                    function incluirPedido<?php echo $id; ?>() {

                      var idProduto = getCookie('idProduto<?php echo $id; ?>');
                      var qtdMais   = Number(getCookie('qtdProduto<?php echo $id; ?>'));

                      qtdMais++;

                      var viewPreco = parseFloat(document.getElementById('viewPreco<?php echo $id; ?>').value.replace(',','.'));
                      var preco     = document.getElementById('preco<?php echo $id; ?>');

                      setCookie("idProduto" + idProduto, idProduto, 30);
                      setCookie("qtdProduto" + idProduto, qtdMais, 30);

                      var total = qtdMais * viewPreco;

                      total = total.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});

                      document.getElementById('preco<?php echo $id; ?>').innerHTML = total;

                    };

                    setInterval(loadPreco<?php echo $id; ?>, 1);

                    function removeItem<?php echo $id; ?>() {
                      document.cookie = "idProduto<?php echo $id; ?>= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
                      document.cookie = "qtdProduto<?php echo $id; ?>= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
                      document.cookie = "precoProduto<?php echo $id; ?>= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
                      document.cookie = "precoUnitProduto<?php echo $id; ?>= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";

                      window.location.href='ui-shopping-cart.php?cat=' + categoria;
                    }

                    </script>
          <?php

              } while ($data = $result->fetch());
            }

        };

              echo "
              <hr style='border: 1px solid rgba(255, 255, 255, 0.3); margin-left: 0;'>
              <div class='card-header card-dark' style='border: 0; padding: 5px; width: 100%; padding-bottom: 0;'>
                <h4 style='float: left; padding-top: 10px;'>Total</h4>
                <p id='precoTotal' style='margin-top: 2%; font-size: 20px; border-radius: 20px; float: right'></p>
              </div>
              ";

        ?>

        <script>
        function total() {
          var i;
          var preco;
          var precoTotal = 0;
          var viewPrecoTotal = 0;

          for(var i = 1; i <= 50; i++) {
            preco = getCookie('precoUnitProduto' + i);
            preco = preco.toString().replace(',','.');
            qtdProduto = Number(getCookie('qtdProduto' + i));

            if (preco != 0) {
              precoTotal = precoTotal + (qtdProduto * preco);
            }
          }

          if(precoTotal == 0) {
            document.getElementById('checkout').style.display = 'none';
          }

          document.getElementById('precoTotal').innerHTML = precoTotal.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});

          viewPrecoTotal = precoTotal.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});

          setCookie("precoTotal", viewPrecoTotal, 30);
        };
        setInterval(total, 1);
        </script>

      </div>
    </div>

  </div>

</div>
<center>
  <div class='card-header' id='checkout' style='background-color: transparent; z-index: 1; width: 100%; position: fixed; bottom: 10px;'>
    <a class='pill-pedido' onclick=window.location.href='ui-index.php?cat=<?php echo $_GET['cat']; ?>' style='margin-bottom: 15px; border: 3px solid #c9a841; color: #c9a841!important;'>Continuar comprando</a>
    <a class='pill-pedido' onclick=window.location.href='ui-checkout.php'>Finalizar compra &nbsp;<i class='fa fa-arrow-right'></i></a>
  </div>
</center>
