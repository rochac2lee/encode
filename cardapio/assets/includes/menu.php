<style>
.navbar {
  overflow: hidden;
  background-color: #0064b7;
  position: fixed;
  bottom: 0;
	left: 0;
	right: 0;
  width: 100%;
  z-index: 9999999999999999999;
}

.navbar a {
	margin: 2px;
  display: block;
  color: #f2f2f2;
  text-align: center;
  text-decoration: none;
}

.titleMenu {
  font-size: 12px;
  padding-bottom: 0;
  margin-bottom: 0;
}

</style>

<?php
  if ($admin == 0) {
?>

<center>
		<div class="navbar bottom_dark">
		  <a href="ui-home.php"><i class="fas fa-home"></i><br><p class="titleMenu">Inicio</p></a>
		  <a href="ui-home.php"><i class="fas fa-home"></i><br><p class="titleMenu">Pedidos</p></a>
		  <a href="ui-lives.php"><i class="fab fa-youtube"></i><br><p class="titleMenu">Combos</p></a>
		  <a href="ui-events.php"><i class="fas fa-calendar-day"></i><br><p class="titleMenu">Promoções</p></a>
      <a onclick="loading()" href="#" id="btnExit"><i class="fas fa-sign-out-alt"></i><br><p class="titleMenu">Sair</p></a>
		</div>
</center>

<?php
} else {
?>

<center>
		<div class="navbar bottom_dark">
		  <a href="ui-home.php" id="btnNews" onclick="loading()"><i class="fas fa-home"></i><br><p class="titleMenu">Inicio</p></a>
		  <a href="ui-lives.php" id="btnNews" onclick="loading()"><i class="fab fa-youtube"></i><br><p class="titleMenu">Pedidos</p></a>
		  <a href="ui-lives.php" id="btnNews" onclick="loading()"><i class="fab fa-youtube"></i><br><p class="titleMenu">Combos</p></a>
      <a href="ui-events.php" id="btnCompanies" onclick="loading()"><i class="fas fa-calendar-day"></i><br><p class="titleMenu">Promoções</p></a>
      <a onclick="loading()" href="#" id="btnExit"><i class="fas fa-sign-out-alt"></i><br><p class="titleMenu">Sair</p></a>
		</div>
</center>

<?php
}
?>
