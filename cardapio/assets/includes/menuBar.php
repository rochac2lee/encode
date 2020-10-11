
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

<style amp-custom>
  #rating {
    margin: 0 0 0 33%;
  }
  .rating {
    --star-size: 3;  /* use CSS variables to calculate dependent dimensions later */
    padding: 0;  /* to prevent flicker when mousing over padding */
    border: none;  /* to prevent flicker when mousing over border */
    unicode-bidi: bidi-override; direction: rtl;  /* for CSS-only style change on hover */
    text-align: left;  /* revert the RTL direction */
    user-select: none;  /* disable mouse/touch selection */
    font-size: 3em;  /* fallback - IE doesn't support CSS variables */
    font-size: calc(var(--star-size) * 1em);  /* because `var(--star-size)em` would be too good to be true */
    cursor: pointer;
    /* disable touch feedback on cursor: pointer - http://stackoverflow.com/q/25704650/1269037 */
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    -webkit-tap-highlight-color: transparent;
    /* margin-bottom: 1em; */
  }
  /* the stars */
  .rating > label {
    display: inline-block;
    position: relative;
    width: 1.1em;  /* magic number to overlap the radio buttons on top of the stars */
    width: calc(var(--star-size) / 3 * 1.1em);
  }
  .rating > *:hover,
  .rating > *:hover ~ label,
  .rating:not(:hover) > input:checked ~ label {
    color: transparent;  /* reveal the contour/white star from the HTML markup */
    cursor: inherit;  /* avoid a cursor transition from arrow/pointer to text selection */
  }
  .rating > *:hover:before,
  .rating > *:hover ~ label:before,
  .rating:not(:hover) > input:checked ~ label:before {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    content: "\f005";
    position: absolute;
    left: 0;
    color: gold;
  }
  .rating > input {
    position: relative;
    transform: scale(3);  /* make the radio buttons big; they don't inherit font-size */
    transform: scale(var(--star-size));
    /* the magic numbers below correlate with the font-size */
    top: -0.5em;  /* margin-top doesn't work */
    top: calc(var(--star-size) / 6 * -1em);
    margin-left: -2.5em;  /* overlap the radio buttons exactly under the stars */
    margin-left: calc(var(--star-size) / 6 * -4em);
    text-align: center;
    z-index: 2;  /* bring the button above the stars so it captures touches/clicks */
    opacity: 0;  /* comment to see where the radio buttons are */
    font-size: initial; /* reset to default */
  }
  form.amp-form-submit-error [submit-error] {
    color: red;
  }
</style>

<script>

function viewMenuBar(){
	document.getElementById('menuBar').style.display = 'block';
}

function hideMenuBar(){
	document.getElementById('menuBar').classList.add('animated');
	document.getElementById('menuBar').classList.add('fadeOutLeft');

	setTimeout (() => {
		document.getElementById('menuBar').classList.remove('fadeOutLeft');
		document.getElementById('menuBar').style.display = 'none';
	}, 1000);
}

</script>

<div class="animated fadeInLeft menuBar" id="menuBar" style="display: none;" onclick="hideMenuBar()">
	<div class="menuBarIn" id="menuBarIn">

		<div class="col-md-12" style="position: fixed; margin: 15px; margin-top: 5%; width: 80%;">
        <div style="width: 95%">
          <center>
    				<img src="../../sistemaDelivery/assets/uploads/sistema/<? echo $logo_sistema ?>" style="width: 50%; margin-bottom: 20px;">
          </center>
      </div>

<?php

  if ($idUsuario != "") {

?>

				<div class="clearfix"></div>
        <div onclick="window.location.href='ui-profile-user.php?id=<?php echo $idUsuario; ?>'">
    				<img src="assets/uploads/avatar/<?php echo $avatarUsuario; ?>" style="object-fit: cover; width:36px; height: 36px; border-radius: 50%; margin-top: 3%; display: inline-flex">
    				<h6 style="color: #fff; display: inline-flex; margin-bottom: 5%">&nbsp;<?php echo $nomeCompletoUsuario; ?></h6>
    				<p style="margin-top: -4%; margin-left: 13%; font-size: 12px;"><i class="fas fa-mobile-alt"></i>&nbsp; <?php echo $celularUsuario; ?></p>
        </div>
				<hr style="margin-top: 0px; margin-bottom: 6%">

				<div class="clearfix"></div>

<?php
  }
?>

				<div class="table-responsive" style="width: 97%;">
				<table class="table tableMenuBar table-bordered">
					<tbody>
						<tr onclick="window.location.href='ui-index.php?cat=1'"><td style="width: 30px"><i class="fas fa-tachometer-alt"></i></td><td>Início</td></tr>
						<tr onclick="window.location.href='ui-about.php'"><td style="width: 30px"><i class="fas fa-info-circle"></i></td><td>Produtos</td></tr>
            <tr onclick="window.location.href='ui-events.php'"><td style="width: 30px"><i class="fas fa-calendar-day"></i></td><td>Promoções</td></tr>
            <tr onclick="window.location.href='ui-events.php'"><td style="width: 30px"><i class="fas fa-calendar-day"></i></td><td>Contato</td></tr>
            <tr onclick="window.location.href='ui-events.php'"><td style="width: 30px"><i class="fas fa-calendar-day"></i></td><td>Quem Somos</td></tr>
            <?php if ($idUsuario != "") { ?>
						<tr onclick="window.location.href='ui-about.php'"><td style="width: 30px"><i class="fas fa-info-circle"></i></td><td>Meus Pedidos</td></tr>
            <tr data-toggle="modal" data-target="#avaliacao"><td style="width: 30px"><i class="fas fa-star"></i></td><td>Avaliar App</td></tr>
            <?php } ?>
            <?php if ($admin != "") { ?>
						<tr onclick="window.location.href='ui-users.php'"><td style="width: 30px"><i class="fas fa-users"></i></td><td>Usuários</td></tr>
						<tr onclick="window.location.href='ui-history.php'"><td style="width: 30px"><i class="fas fa-history"></i></td><td>Histórico de Atividades</td></tr>
						<?php } ?>
					</tbody>
				</table>
				</div>

				<hr style="margin-top: 0px; border-top: 1px solid #292728;">
				<div class="clearfix"></div>
				<h6 class="corTexto">Versão 1.0</h6>
				<h6 class="corTexto">Desenvolvido por <a href="https://www.linkedin.com/company/encode-dev"><strong class="corTexto">Encode</strong></a></h6>

		</div>
	</div>
</div>

<div class="modal animated fadeIn" id="avaliacao" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Avalie nosso App</h5>
        <button type="button" onclick="window.location.href='assets/functions/dontRating.php?idUsuario=<?php echo $idUsuario; ?>'" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="assets/functions/sendRating.php?idUsuario=<?php echo $idUsuario; ?>" name="sendRating" id="sendRating" method="post">
        <p style="margin-bottom: 0;">Ajude a melhorar nosso Atendimento!</p>
          <fieldset id="rating" class="rating">
            <input name="rating"
              type="radio"
              id="rating5"
              value="5"
              on="change:rating.submit">
            <label for="rating5"
              title="5 stars"><i class="fas fa-star"></i></label>

            <input name="rating"
              type="radio"
              id="rating4"
              value="4"
              on="change:rating.submit">
            <label for="rating4"
              title="4 stars"><i class="fas fa-star"></i></label>

            <input name="rating"
              type="radio"
              id="rating3"
              value="3"
              on="change:rating.submit">
            <label for="rating3"
              title="3 stars"><i class="fas fa-star"></i></label>

            <input name="rating"
              type="radio"
              id="rating2"
              value="2"
              on="change:rating.submit">
            <label for="rating2"
              title="2 stars"><i class="fas fa-star"></i></label>

            <input name="rating"
              type="radio"
              id="rating1"
              value="1"
              on="change:rating.submit">
            <label for="rating1"
              title="1 stars"><i class="fas fa-star"></i></label>
          </fieldset>

          <div class='form-group' style="margin-top: -10px">
          <label for="comentario">Comentário</label>
          <textarea class='form-control' style="color: #b0b3b8" type='text' name='comentario' id="comentario"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button  id="btnSend" type="submit" class="btn btn-primary">Salvar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php

if ($avaliacao == 1) {
  echo "

  <script>
    function abreModal() {
      $('#avaliacao').modal({
        show: true
      });
    }
    setTimeout(abreModal, 60000);
  </script>

  ";
}
?>
