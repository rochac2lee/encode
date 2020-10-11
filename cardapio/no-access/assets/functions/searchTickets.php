<?php
ob_start();
session_start();

$tipo    = $_GET['type'];

if (!isset($_SESSION['usuario_appcimbessul']) && (!isset($_SESSION['senha_appcimbessul']))){
	header("Location: index.php"); exit;
}

include('../includes/conexao.php');

$email = $_SESSION['usuario_appcimbessul'];
$senha = $_SESSION['senha_appcimbessul'];

$breakUsuario = explode("@", $email);
$usuario = $breakUsuario[0];

$select = "SELECT id, name, firstname, realname FROM glpi_users
					 where name = '$usuario' and employee = 1";
$result = $conexao_glpi -> prepare($select);
$result -> execute();
$count = $result->rowCount();

if ($data = $result->fetch()) {
	do {

		$idUsuario    = $data['id'];
		$nomeUsuario  = $data['firstname'];
		$emailUsuario = $email.".com.br";

	} while ($data = $result -> fetch());
}

	if ($tipo > 0) {
  	$selectAllTickets = "SELECT * FROM glpi_tickets where status = '$tipo' and itilcategories_id = 5 or status = '$tipo' and itilcategories_id = 6 or status = '$tipo' and itilcategories_id = 7 or status = '$tipo' and itilcategories_id = 8 order by id DESC";
	} else {
		$selectAllTickets = "SELECT * FROM glpi_tickets where itilcategories_id = 5 or itilcategories_id = 6 or itilcategories_id = 7 or itilcategories_id = 8 order by id DESC";
	}
	$resultAllTickets = $conexao_glpi -> prepare($selectAllTickets);
  $resultAllTickets -> execute();
  $countAllTickets = $resultAllTickets->rowCount();

  if ($dataAllTickets = $resultAllTickets->fetch()) {
    do {

      $viewTicketId     = $dataAllTickets['id'];
      $viewTicketMotivo = utf8_encode($dataAllTickets['name']);
      $viewTicketStatus = $dataAllTickets['status'];

      echo "<a href='ui-view-ticket.php?id=$viewTicketId'>";

      if ($viewTicketStatus == 2 || $viewTicketStatus == 3)	{ echo "<div class='card-header' style='padding-bottom: 0; margin-bottom: 15px; background: #0f9df7; color: #fff; font-weight: 500;'>"; } else
      if ($viewTicketStatus == 4)	{ echo "<div class='card-header' style='padding-bottom: 0; margin-bottom: 15px; background: #ff5d48; color: #fff; font-weight: 500;'>"; } else
      if ($viewTicketStatus == 5 || $viewTicketStatus == 6)	{ echo "<div class='card-header' style='padding-bottom: 0; margin-bottom: 15px; background: #5cb85c; color: #fff; font-weight: 500;'>"; } else
      { echo "<div class='card-header' style='padding-bottom: 0; margin-bottom: 15px;'>"; }

      echo "
      <p onclick='loading()'><i style='margin-right: 10px' class='fas fa-caret-right'></i> ".$viewTicketId." - ".$viewTicketMotivo."</p>

      </div>
      </a>
      ";

    } while ($dataAllTickets = $resultAllTickets->fetch());
  } else {

    echo "<p><i class='far fa-frown-open'></i> Nada foi encontrado!</p>";

  }
?>
