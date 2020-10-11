<style>
.reaction {
  overflow: hidden;
  background-color: #0064b7;
  width: 100%;
  border-top: 1px solid #3e4042;
  border-left: 4px solid #3f51b5;
  border-radius: 0px 0px 10px 10px;
}


#divReaction {
  z-index: 1000000001;
}


.titleMenu {
  font-size: 12px;
  padding-bottom: 0;
  margin-bottom: 0;
}

.pray {
  display: none;
}

#newReaction {
  width: 8%;
  margin: 4% 1% 3% 1%;
  display: inline-flex;
  float: right;
}

.newDevotionalReaction {
  width: 8%;
  margin: 4% 1% 3% 1%;
  display: inline-flex;
  float: right;
}

</style>

<?php
  if ($item == 1) {
    $item = "versiculo";
?>

<script type="text/javascript">

  function searchReactions() {

   // Declaração de Variáveis
   var viewItem = document.getElementById("item").value;
   var viewIdUsuario = document.getElementById("idUsuario").value;
   var viewIdVersiculo = document.getElementById("idVersiculo").value;
   var result = document.getElementById("viewReactions");
   var xmlreq = CriaRequest();


   // Iniciar uma requisição
   xmlreq.open("GET", "assets/functions/searchReactions.php?item=" + viewItem + "&idUsuario=" + viewIdUsuario + "&idVersiculo=" + viewIdVersiculo, true);
   setTimeout(searchReactions, 700);

   // Atribui uma função para ser executada sempre que houver uma mudança de ado
   xmlreq.onreadystatechange = function(){

     // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
     if (xmlreq.readyState == 4) {

       // Verifica se o arquivo foi encontrado com sucesso
       if (xmlreq.status == 200) {

         result.innerHTML = xmlreq.responseText;
         document.getElementById("viewReactions").value = result.innerHTML;

         var retorno = document.getElementById("viewReactions").value;

         if(retorno == 1) {
           document.getElementById('newReaction').classList.remove('far');
           document.getElementById('newReaction').classList.add('fas');
           document.getElementById('newReaction').style.color = '#f44336';
         } else {
           document.getElementById('newReaction').classList.remove('fas');
           document.getElementById('newReaction').classList.add('far');
           document.getElementById('newReaction').style.color = '#fff';
         }

       }
     }
   };

   xmlreq.send(null);
  };

  function searchAllReactions() {

  // Declaração de Variáveis
  var viewItem = document.getElementById("item").value;
  var viewIdVersiculo = document.getElementById("idVersiculo").value;
  var result = document.getElementById("viewAllReactions");
  var xmlreq = CriaRequest();

  // Iniciar uma requisição
  xmlreq.open("GET", "assets/functions/searchAllReactions.php?item=" + viewItem + "&idVersiculo=" + viewIdVersiculo, true);
  setTimeout(searchAllReactions, 700);

  // Atribui uma função para ser executada sempre que houver uma mudança de ado
  xmlreq.onreadystatechange = function(){

    // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
    if (xmlreq.readyState == 4) {

      // Verifica se o arquivo foi encontrado com sucesso
      if (xmlreq.status == 200) {

        result.innerHTML = xmlreq.responseText;
        document.getElementById("viewAllReactions").value = result.innerHTML;

      }
    }
  };

  xmlreq.send(null);
 };

  $(document).ready(function() {
    $("#newReaction").click(function() {
      var item = $("#item");
      var itemPost = item.val();

      var idVersiculo = $("#idVersiculo");
      var idVersiculoPost = idVersiculo.val();

      var reacao = $("#reacao");
      var reacaoPost = reacao.val();

      var idUsuario = $("#idUsuario");
      var idUsuarioPost = idUsuario.val();

        $.post("assets/functions/newReaction.php?item=" + itemPost, {idItem: idVersiculoPost, reacao: reacaoPost, idUsuario: idUsuarioPost},
        function(data){
         $("#resposta").html(data);
         }
         , "html");

    });
  });
</script>

		<div class="reaction bottom_dark" id="divReaction">
		  <input type="text" id="item" value="<?php echo $item; ?>" style="display: none" />
		  <input type="text" id="idVersiculo" value="<?php echo $ver_id; ?>" style="display: none" />
		  <input type="text" id="idUsuario" value="<?php echo $idUsuario; ?>" style="display: none" />
		  <input type="text" id="reacao" value="1" style="display: none" />
      <h5 style="float: right; margin: 4% 3% 0% -1%;" id="viewAllReactions"></h5>
      <i id="newReaction" class="far fa-2x fa-heart"></i><div style="display: none;" id="viewReactions"></div>

		</div>
<?php
  } else if($item == 2) {
    $item = "devocional";
?>

<script type="text/javascript">

  function searchDevocionalReactions<?php echo $idDevocional; ?>() {

   // Declaração de Variáveis
   var viewItem = document.getElementById("item<?php echo $idDevocional; ?>").value;
   var viewIdUsuario = document.getElementById("idUsuario<?php echo $idDevocional; ?>").value;
   var viewIdDevocional = document.getElementById("idDevocional<?php echo $idDevocional; ?>").value;
   var result<?php echo $idDevocional; ?> = document.getElementById("viewDevotionalReactions<?php echo $idDevocional; ?>");
   var xmlreq<?php echo $idDevocional; ?> = CriaRequest();

   // Iniciar uma requisição
   xmlreq<?php echo $idDevocional; ?>.open("GET", "assets/functions/searchReactions.php?item=" + viewItem + "&idUsuario=" + viewIdUsuario + "&idDevocional=" + viewIdDevocional, true);
   setTimeout(searchDevocionalReactions<?php echo $idDevocional; ?>, 700);

   // Atribui uma função para ser executada sempre que houver uma mudança de ado
   xmlreq<?php echo $idDevocional; ?>.onreadystatechange = function(){

     // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
     if (xmlreq<?php echo $idDevocional; ?>.readyState == 4) {

       // Verifica se o arquivo foi encontrado com sucesso
       if (xmlreq<?php echo $idDevocional; ?>.status == 200) {

         result<?php echo $idDevocional; ?>.innerHTML = xmlreq<?php echo $idDevocional; ?>.responseText;
         document.getElementById("viewDevotionalReactions<?php echo $idDevocional; ?>").value = result<?php echo $idDevocional; ?>.innerHTML;

         var retorno<?php echo $idDevocional; ?> = document.getElementById("viewDevotionalReactions<?php echo $idDevocional; ?>").value;

         if(retorno<?php echo $idDevocional; ?> == 1) {
           document.getElementById('newDevotionalReaction<?php echo $idDevocional; ?>').classList.remove('far');
           document.getElementById('newDevotionalReaction<?php echo $idDevocional; ?>').classList.add('fas');
           document.getElementById('newDevotionalReaction<?php echo $idDevocional; ?>').style.color = '#f44336';
         } else {
           document.getElementById('newDevotionalReaction<?php echo $idDevocional; ?>').classList.remove('fas');
           document.getElementById('newDevotionalReaction<?php echo $idDevocional; ?>').classList.add('far');
           document.getElementById('newDevotionalReaction<?php echo $idDevocional; ?>').style.color = '#fff';
         }

       }
     }
   };

   xmlreq<?php echo $idDevocional; ?>.send(null);
  };

  function searchAllDevocionalReactions<?php echo $idDevocional; ?>() {

  // Declaração de Variáveis
  var viewItem = document.getElementById("item<?php echo $idDevocional; ?>").value;
  var viewIdDevocional = document.getElementById("idDevocional<?php echo $idDevocional; ?>").value;
  var resultAll = document.getElementById("viewAllDevotionalReactions<?php echo $idDevocional; ?>");
  var xmlreq = CriaRequest();

  // Iniciar uma requisição
  xmlreq.open("GET", "assets/functions/searchAllReactions.php?item=" + viewItem + "&idDevocional=" + viewIdDevocional, true);
  setTimeout(searchAllDevocionalReactions<?php echo $idDevocional; ?>, 700);

  // Atribui uma função para ser executada sempre que houver uma mudança de ado
  xmlreq.onreadystatechange = function(){

    // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
    if (xmlreq.readyState == 4) {

      // Verifica se o arquivo foi encontrado com sucesso
      if (xmlreq.status == 200) {

        resultAll.innerHTML = xmlreq.responseText;
        document.getElementById("viewAllDevotionalReactions<?php echo $idDevocional; ?>").value = resultAll.innerHTML;

      }
    }
  };

  xmlreq.send(null);
 };

  $(document).ready(function() {
    $("#newDevotionalReaction<?php echo $idDevocional; ?>").click(function() {
      var item = $("#item<?php echo $idDevocional; ?>");
      var itemPost = item.val();

      var idDevocional = $("#idDevocional<?php echo $idDevocional; ?>");
      var idDevocionalPost = idDevocional.val();

      var reacao = $("#reacao<?php echo $idDevocional; ?>");
      var reacaoPost = reacao.val();

      var idUsuario = $("#idUsuario<?php echo $idDevocional; ?>");
      var idUsuarioPost = idUsuario.val();

        $.post("assets/functions/newReaction.php?item=" + itemPost, {idItem: idDevocionalPost, reacao: reacaoPost, idUsuario: idUsuarioPost},
        function(data){
         $("#resposta").html(data);
         }
         , "html");

    });
  });
</script>

		<div class="reaction bottom_dark" id="divReaction">
		  <input type="text" id="item<?php echo $idDevocional; ?>" value="<?php echo $item; ?>" style="display: none" />
		  <input type="text" id="idDevocional<?php echo $idDevocional; ?>" value="<?php echo $idDevocional; ?>" style="display: none" />
		  <input type="text" id="idUsuario<?php echo $idDevocional; ?>" value="<?php echo $idUsuario; ?>" style="display: none" />
		  <input type="text" id="reacao<?php echo $idDevocional; ?>" value="1" style="display: none" />
      <h5 style="float: right; margin: 4% 3% 0% -1%;" id="viewAllDevotionalReactions<?php echo $idDevocional; ?>"></h5>
      <i id="newDevotionalReaction<?php echo $idDevocional; ?>" class="newDevotionalReaction far fa-2x fa-heart"></i>
      <div style="display: none;" id="viewDevotionalReactions<?php echo $idDevocional; ?>"></div>
		</div>

<?php
  }
?>
