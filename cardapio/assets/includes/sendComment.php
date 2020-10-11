<script>
function viewCommentBar() {
  document.getElementById('divComment').style.marginTop = '0px';
  document.getElementById('divComment').style.position = 'relative';
  document.getElementById('pray').style.display = 'block';

  setTimeout(() => {
      if ($('#userComment').val() == "") {
      hideCommentBar();
    } else {
      viewCommentBar();
    }
  }, 10000);

}
function hideCommentBar() {
  document.getElementById('divComment').style.marginBottom = '13%';
  document.getElementById('divComment').style.position = 'fixed';
  document.getElementById('pray').style.display = 'none';
}

</script>

<style>
.comment {
  overflow: hidden;
  background-color: #0064b7;
  position: fixed;
  margin-bottom: 13%;
  bottom: 0;
	left: 0;
	right: 0;
  width: 100%;
}

#avatarComment {
  margin: 2%;
  margin-top: 0;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: inline-flex;
  float: left;
}

#avatarLiveComment {
  margin: 2%;
  margin-right: 0;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: inline-flex;
  float: left;
}

#divComment {
  z-index: 1000000001;
}

#userComment {
    width: 60%;
    background: #3a3b3c;
    color: #e4e6eb;
    border: 1px solid rgba(0, 0, 0, 0.4);
    line-height: 15px;
    height: 8%;
    margin: 2%;
    padding: 2% 3% 1% 3%;
    font-size: 15px;
    font-weight: 400;
    border-radius: 20px;
    outline: none;
    display: inline-flex;
    float: left;
}

#userLiveComment {
    width: 70%;
    float: left;
    border-radius: 20px;
    padding: 2% 3% 2% 3%;
    background: #3a3b3c;
}

#newReaction {
  width: 7%;
  margin: 4% 3% 2% 2%;
  display: inline-flex;
  float: right;
}

#newComment {
  width: 7%;
  margin: 4% 3% 2% 2%;
  display: inline-flex;
  float: right;
}

.titleMenu {
  font-size: 12px;
  padding-bottom: 0;
  margin-bottom: 0;
}

.pray {
  display: none;
}

</style>

<?php
  if ($item == 3) {
    $item = "live";
  }
?>

<script type="text/javascript">

  function searchReactions() {

   // Declaração de Variáveis
   var viewItem = document.getElementById("item").value;
   var viewIdUsuario = document.getElementById("idUsuario").value;
   var viewLiveId = document.getElementById("liveId").value;
   var result = document.getElementById("viewReactions");
   var xmlreq = CriaRequest();

   // Iniciar uma requisição
   xmlreq.open("GET", "assets/functions/searchReactions.php?item=" + viewItem + "&idUsuario=" + viewIdUsuario + "&idLive=" + viewLiveId, true);
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

  $(document).ready(function() {
    $("#newReaction").click(function() {
      var item = $("#item");
      var itemPost = item.val();

      var liveId = $("#liveId");
      var liveIdPost = liveId.val();

      var reacao = $("#reacao");
      var reacaoPost = reacao.val();

      var idUsuario = $("#idUsuario");
      var idUsuarioPost = idUsuario.val();

        $.post("assets/functions/newReaction.php?item=" + itemPost, {idItem: liveIdPost, reacao: reacaoPost, idUsuario: idUsuarioPost},
        function(data){
         $("#resposta").html(data);
         }
         , "html");

    });
  });

  function searchAllReactions() {

  // Declaração de Variáveis
  var viewItem = document.getElementById("item").value;
  var viewIdLive = document.getElementById("liveId").value;
  var result = document.getElementById("viewAllReactions");
  var xmlreq = CriaRequest();

  // Iniciar uma requisição
  xmlreq.open("GET", "assets/functions/searchAllReactions.php?item=" + viewItem + "&idLive=" + viewIdLive, true);
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
    $("#newComment").click(function() {
      var userComment = $("#userComment");
      var userCommentPost = userComment.val();

      var liveId = $("#liveId");
      var liveIdPost = liveId.val();

      var idUsuario = $("#idUsuario");
      var idUsuarioPost = idUsuario.val();

      var prayActive = document.getElementById("prayActive");

        if (prayActive.checked == true){
          prayActive = 1;
        } else {
          prayActive = 0;
        }

        $.post("assets/functions/newLiveComment.php?pray=" + prayActive, {liveId: liveIdPost, userComment: userCommentPost, idUsuario: idUsuarioPost},
        function(data){
         $("#resposta").html(data);
         }
         , "html");

         document.getElementById('userComment').value = "";
         document.getElementById('prayActive').checked = false;

    });
  });
</script>

		<div class="comment bottom_dark" id="divComment">
      <input type="text" id="item" value="<?php echo $item; ?>" style="display: none" />
      <input type="text" id="reacao" value="1" style="display: none" />
      <img src="assets/uploads/avatar/<?php echo $avatarUsuario; ?>" id="avatarLiveComment">
		  <input type="text" id="liveId" value="<?php echo $liveId; ?>" style="display: none" />
		  <input type="text" id="idUsuario" value="<?php echo $idUsuario; ?>" style="display: none" />
		  <textArea onclick="viewCommentBar()" id="userComment" placeholder="Escreva um comentário..."></textArea>
      <i id="newReaction" class="far fa-2x fa-heart"></i>
      <div style="display: none;" id="viewReactions"></div>
      <i onclick="hideCommentBar();" id="newComment" class="fa fa-2x fa-paper-plane"></i>
      <h5 style="display: none;" id="viewAllReactions"></h5>
      <div class='clearfix'></div>
      <div class="switch pray" id="pray" style="margin-left: 17%;">
        <label>
          <input type="checkbox" id="prayActive" name="prayActive" value="1"> Pedido de Oração
        </label>
      </div>
		</div>
