<?php

$id_ticket        = $_GET['id_ticket'];
$id_usuario       = $_GET['id_usuario'];
$nome_usuario     = $_GET['nome_usuario'];
$email_usuario    = $_GET['email_usuario'];

$id_tecnico       = $_GET['id_tecnico'];
$nome_tecnico     = $_GET['nome_tecnico'];
$email_tecnico    = $_GET['email_tecnico'];

include("../includes/conexao.php");
require_once('../plugins/SendMail/PHPMailer/class.phpmailer.php');

date_default_timezone_set('America/Brasilia');
$dateTime     = date('d/m/Y H:i:s');
$dateTimeGLPI = date('Y-m-d H:i:s');

//Atribuido a um técnico

$conexao->beginTransaction();

$conexao->exec("UPDATE tb_atendimento SET status='2' WHERE id = '$id_ticket'" );

$conexao_glpi->exec("UPDATE glpi_tickets SET date_mod='$dateTimeGLPI', users_id_lastupdater='$id_usuario', status='2' WHERE id = '$id_ticket'" );


$conexao_glpi->exec("INSERT INTO glpi_tickets_users (tickets_id, users_id, type, use_notification, alternative_email, id)
							                         	VALUES ('$id_ticket', '$id_tecnico', '2', '1', '$email_tecnico',  '')" );

//$emailCC     = "helpdesk@cimbessul.com.br";
$email_envio = "no-reply@cimbessul.com.br";

$selectTicket = "SELECT * FROM glpi_tickets where id = '$id_ticket'";
$resultTicket = $conexao_glpi -> prepare($selectTicket);
$resultTicket -> execute();
$countTicket = $resultTicket->rowCount();

if ($data_Ticket = $resultTicket->fetch()) {
	do {

    $motivo              = $data_Ticket['name'];

  } while ($data_Ticket = $resultTicket->fetch());
}

$selectDestinatarios = "SELECT * FROM tb_destinatario";
$resultDestinatarios = $conexao -> prepare($selectDestinatarios);
$resultDestinatarios -> execute();
$countDestinatarios = $resultDestinatarios->rowCount();

if ($data_destinatarios = $resultDestinatarios->fetch(PDO::FETCH_ASSOC)) {
	do {

		$idDestinatario    = $data_destinatarios['id_destinatario'];
		$nomeDestinatario  = $data_destinatarios['nome'];
		$emailDestinatario = $data_destinatarios['email'];

		$conexao->exec("INSERT INTO tb_notificacao (id_solicitacao, id_destinatario, data_hora_envio, id_notificacao)
										                    VALUES ('$id_ticket', '$idDestinatario', '$dateTime', '')" );

		$Email = new PHPMailer();
		$Email->SetLanguage("br");
		$Email->IsSMTP(); // Habilita o SMTP
		$Email->SMTPAuth = true; //Ativa e-mail autenticado
		$Email->Host = 'webmail.cimbessul.com.br'; // Servidor de envio # verificar qual o host correto com a hospedagem as vezes fica como smtp.
		$Email->Port = '25'; // Porta de envio 587
		$Email->Username = 'no-reply@cimbessul.com.br'; //e-mail que será autenticado
		$Email->Password = 'ti123!@#TI'; // senha do email
		// ativa o envio de e-mails em HTML, se false, desativa.
		$Email->IsHTML(true);
		// email do remetente da mensagem
		$Email->From = 'no-reply@cimbessul.com.br';
		// nome do remetente do email
		$Email->FromName = utf8_decode('TI CIMBESSUL');
		//$Email->AddCC($emailCC);
		// Endereço de destino do email, ou seja, pra onde você quer que a mensagem do formulário vá?
		$Email->AddReplyTo($email_envio, 'Plantão TI CIMBESSUL');
		$Email->AddAddress("$emailDestinatario"); // para quem será enviada a mensagem
		// informando no email, o assunto da mensagem
		$Email->Subject = utf8_decode("[PLANTÃO TI EM ATENDIMENTO] - Solicitação n° $id_ticket atribuído a $nome_tecnico");
		// Define o texto da mensagem (aceita HTML)
		$Email->Body .= utf8_decode("

		<html xmlns:v='urn:schemas-microsoft-com:vml'
		xmlns:o='urn:schemas-microsoft-com:office:office'
		xmlns:w='urn:schemas-microsoft-com:office:word'
		xmlns:m='http://schemas.microsoft.com/office/2004/12/omml'
		xmlns='http://www.w3.org/TR/REC-html40'>

		<head>
		<meta http-equiv=Content-Type content='text/html; charset=unicode'>
		<meta name=ProgId content=Word.Document>
		<meta name=Generator content='Microsoft Word 15'>
		<meta name=Originator content='Microsoft Word 15'>

		<title>Plantão TI Cimbessul</title>

		<style>
		<!--
		 /* Font Definitions */
		 @font-face
			{font-family:Courier;
			panose-1:2 7 4 9 2 2 5 2 4 4;
			mso-font-alt:'Courier New';
			mso-font-charset:0;
			mso-generic-font-family:modern;
			mso-font-format:other;
			mso-font-pitch:fixed;
			mso-font-signature:3 0 0 0 1 0;}
		@font-face
			{font-family:'Cambria Math';
			panose-1:2 4 5 3 5 4 6 3 2 4;
			mso-font-charset:0;
			mso-generic-font-family:roman;
			mso-font-pitch:variable;
			mso-font-signature:-536870145 1107305727 0 0 415 0;}
		@font-face
			{font-family:Calibri;
			panose-1:2 15 5 2 2 2 4 3 2 4;
			mso-font-charset:0;
			mso-generic-font-family:swiss;
			mso-font-pitch:variable;
			mso-font-signature:-536870145 1073786111 1 0 415 0;}
		 /* Style Definitions */
		 p.MsoNormal, li.MsoNormal, div.MsoNormal
			{mso-style-unhide:no;
			mso-style-qformat:yes;
			mso-style-parent:'';
			margin:0cm;
			margin-bottom:.0001pt;
			mso-pagination:widow-orphan;
			font-size:11.0pt;
			font-family:'Calibri',sans-serif;
			mso-fareast-font-family:Calibri;
			mso-fareast-theme-font:minor-latin;
			mso-bidi-font-family:Calibri;}
		a:link, span.MsoHyperlink
			{mso-style-priority:99;
			color:#51BAE2;
			mso-text-animation:none;
			text-decoration:none;
			text-underline:none;
			text-decoration:none;
			text-line-through:none;}
		a:visited, span.MsoHyperlinkFollowed
			{mso-style-noshow:yes;
			mso-style-priority:99;
			color:#51BAE2;
			mso-text-animation:none;
			text-decoration:none;
			text-underline:none;
			text-decoration:none;
			text-line-through:none;}
		p.msonormal0, li.msonormal0, div.msonormal0
			{mso-style-name:msonormal;
			mso-style-unhide:no;
			mso-margin-top-alt:auto;
			margin-right:0cm;
			mso-margin-bottom-alt:auto;
			margin-left:0cm;
			mso-pagination:widow-orphan;
			font-size:11.0pt;
			font-family:'Calibri',sans-serif;
			mso-fareast-font-family:Calibri;
			mso-fareast-theme-font:minor-latin;
			mso-bidi-font-family:Calibri;}
		p.externalclass, li.externalclass, div.externalclass
			{mso-style-name:externalclass;
			mso-style-unhide:no;
			mso-margin-top-alt:auto;
			margin-right:0cm;
			mso-margin-bottom-alt:auto;
			margin-left:0cm;
			mso-pagination:widow-orphan;
			font-size:11.0pt;
			font-family:'Calibri',sans-serif;
			mso-fareast-font-family:Calibri;
			mso-fareast-theme-font:minor-latin;
			mso-bidi-font-family:Calibri;}
		p.full-width-bg, li.full-width-bg, div.full-width-bg
			{mso-style-name:full-width-bg;
			mso-style-unhide:no;
			mso-margin-top-alt:auto;
			margin-right:0cm;
			mso-margin-bottom-alt:auto;
			margin-left:0cm;
			mso-pagination:widow-orphan;
			font-size:11.0pt;
			font-family:'Calibri',sans-serif;
			mso-fareast-font-family:Calibri;
			mso-fareast-theme-font:minor-latin;
			mso-bidi-font-family:Calibri;}
		span.yshortcuts
			{mso-style-name:yshortcuts;
			mso-style-unhide:no;
			color:black;
			border:none windowtext 1.0pt;
			mso-border-alt:none windowtext 0cm;
			padding:0cm;}
		span.EstiloDeEmail21
			{mso-style-type:personal;
			mso-style-noshow:yes;
			mso-style-unhide:no;
			font-family:'Calibri',sans-serif;
			mso-ascii-font-family:Calibri;
			mso-hansi-font-family:Calibri;}
		span.EstiloDeEmail22
			{mso-style-type:personal;
			mso-style-noshow:yes;
			mso-style-unhide:no;
			font-family:'Calibri',sans-serif;
			mso-ascii-font-family:Calibri;
			mso-hansi-font-family:Calibri;}
		span.EstiloDeEmail23
			{mso-style-type:personal;
			mso-style-noshow:yes;
			mso-style-unhide:no;
			font-family:'Calibri',sans-serif;
			mso-ascii-font-family:Calibri;
			mso-hansi-font-family:Calibri;}
		span.EstiloDeEmail24
			{mso-style-type:personal;
			mso-style-noshow:yes;
			mso-style-unhide:no;
			font-family:'Calibri',sans-serif;
			mso-ascii-font-family:Calibri;
			mso-hansi-font-family:Calibri;}
		span.EstiloDeEmail25
			{mso-style-type:personal;
			mso-style-noshow:yes;
			mso-style-unhide:no;
			font-family:'Calibri',sans-serif;
			mso-ascii-font-family:Calibri;
			mso-hansi-font-family:Calibri;
			color:windowtext;}
		.MsoChpDefault
			{mso-style-type:export-only;
			mso-default-props:yes;
			font-size:10.0pt;
			mso-ansi-font-size:10.0pt;
			mso-bidi-font-size:10.0pt;}
		@page WordSection1
			{size:612.0pt 792.0pt;
			margin:70.85pt 3.0cm 70.85pt 3.0cm;
			mso-header-margin:36.0pt;
			mso-footer-margin:36.0pt;
			mso-paper-source:0;}
		div.WordSection1
			{page:WordSection1;}
		-->
		</style>
		<!--[if gte mso 10]>
		<style>
		 /* Style Definitions */
		 table.MsoNormalTable
			{mso-style-name:'Tabela normal';
			mso-tstyle-rowband-size:0;
			mso-tstyle-colband-size:0;
			mso-style-noshow:yes;
			mso-style-priority:99;
			mso-style-parent:'';
			mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
			mso-para-margin:0cm;
			mso-para-margin-bottom:.0001pt;
			mso-pagination:widow-orphan;
			font-size:10.0pt;
			font-family:'Times New Roman',serif;}
		</style>
		<![endif]--><!--[if gte mso 9]><xml>
		 <o:shapedefaults v:ext='edit' spidmax='1026'/>
		</xml><![endif]--><!--[if gte mso 9]><xml>
		 <o:shapelayout v:ext='edit'>
		  <o:idmap v:ext='edit' data='1'/>
		 </o:shapelayout></xml><![endif]-->
		</head>

		<body bgcolor='#F2F1EF' lang=PT-BR link='#51BAE2' vlink='#51BAE2'
		style='tab-interval:35.4pt'>

		<div class=WordSection1>


		<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width='100%'
		 style='width:100.0%;background:#F7F7F7;border-collapse:collapse;mso-yfti-tbllook:
		 1184;mso-padding-alt:0cm 0cm 0cm 0cm'>
		 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
		  <td width='100%' valign=top style='width:100.0%;background:#F2F1EF;
		  padding:0cm 0cm 0cm 0cm'>
		  <div align=center>
		  <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=600
		   style='width:450.0pt;border-collapse:collapse;mso-yfti-tbllook:1184;
		   mso-padding-alt:0cm 0cm 0cm 0cm'>
		   <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
		    height:1.5pt'>
		    <td width=455 style='width:341.25pt;background:#F2F1EF;padding:0cm 0cm 0cm 0cm;
		    height:1.5pt'></td>
		   </tr>
		  </table>
		  </div>
		  <p class=MsoNormal align=center style='text-align:center'><span
		  style='display:none;mso-hide:all'><o:p>&nbsp;</o:p></span></p>
		  <div align=center>
		  <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=600
		   style='width:450.0pt;border-collapse:collapse;mso-yfti-tbllook:1184;
		   mso-padding-alt:0cm 0cm 0cm 0cm'>
		   <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
		    height:63.75pt'>
		    <td width=600 style='width:450.0pt;background:#F2F1EF;padding:0cm 0cm 0cm 0cm;
		    height:63.75pt'>
		    <p class=MsoNormal align=center style='text-align:center'><a
		    href='http://".$_SERVER['HTTP_HOST']."/helpdesk/'
		    target='_blank'><span style='mso-ignore:vglayout'><img
		    border=0 width=201 height=45
		    src='http://".$_SERVER['HTTP_HOST']."/helpTI/assets/images/logohz.png'
		    style='height:.468in;width:2.093in' v:shapes='Imagem_x0020_1'></span><![endif]></a></p>
		    </td>
		   </tr>
		  </table>
		  </div>
		  <p class=MsoNormal align=center style='text-align:center'><span
		  style='display:none;mso-hide:all'><o:p>&nbsp;</o:p></span></p>
		  <div align=center>
		  <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=600
		   style='width:450.0pt;border-collapse:collapse;mso-yfti-tbllook:1184;
		   mso-padding-alt:0cm 0cm 0cm 0cm'>
		   <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
		    height:22.5pt'>
		    <td width=455 style='width:341.25pt;background:white;padding:0cm 0cm 0cm 0cm;
		    height:22.5pt'>
		    <p class=MsoNormal align=center style='text-align:center'><img border=0
		    width=66 height=30 id='_x0000_i1026'
		    src='http://images.hello.zendesk.com/EloquaImages/clients/ZendeskInc/%7B123c1adb-7774-4470-b163-77f859ab86ff%7D_spacer.gif'
		    style='height:.312in;width:.687in'></p>
		    </td>
		   </tr>
		  </table>
		  </div>
		  <p class=MsoNormal align=center style='text-align:center'><span
		  style='display:none;mso-hide:all'><o:p>&nbsp;</o:p></span></p>
		  <div align=center>
		  <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=600
		   style='width:450.0pt;border-collapse:collapse;mso-yfti-tbllook:1184;
		   mso-padding-alt:0cm 0cm 0cm 0cm'>
		   <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
		    height:1.5pt'>
		    <td width=35 style='width:26.25pt;background:white;padding:0cm 0cm 0cm 0cm;
		    height:1.5pt'>
		    <p class=MsoNormal><img border=0 width=35 height=2 id='_x0000_i1027'
		    src='http://images.hello.zendesk.com/EloquaImages/clients/ZendeskInc/%7B123c1adb-7774-4470-b163-77f859ab86ff%7D_spacer.gif'
		    style='height:.02in;width:.364in'></p>
		    </td>
		    <td width=385 valign=top style='width:288.75pt;background:white;padding:
		    0cm 0cm 0cm 0cm;height:1.5pt'>
		    <p class=MsoNormal style='margin-bottom:12.0pt;line-height:17.25pt'><span
		    style='font-size:11.5pt;font-family:'Arial',sans-serif'>Olá<span
		    style='color:#01363C'> </span>".$nomeDestinatario."<span style='color:#01363C'>, <br>
		    <br>
		    </span><o:p></o:p></span></p>
		    <p class=MsoNormal style='margin-bottom:12.0pt;line-height:17.25pt'><span
		    style='font-size:11.5pt;font-family:'Arial',sans-serif'>Informações sobre a Solicitação n° ".$id_ticket.":<b><o:p></o:p></b></span></p>


				<p class=MsoNormal style='margin-bottom:12.0pt;line-height:17.25pt'>
					<b><span style='font-size:11.5pt;font-family:'Arial',sans-serif'>Motivo: </span></b>
					<span style='font-size:11.5pt;font-family:'Arial',sans-serif'>".utf8_encode($motivo)."</span>
				</p>

        <center>
        <p class=MsoNormal style='margin-bottom:6.0pt;line-height:17.25pt'>
					<span style='font-size:16pt;font-family:'Arial',sans-serif'>".$nome_tecnico." foi atribuído por ".$nome_usuario." para atender essa solicitação!</span>
				</p>
        </center>

		    <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=500
		     style='width:375.0pt;border-collapse:collapse;mso-yfti-tbllook:1184;
		     mso-padding-alt:0cm 0cm 0cm 0cm'>
		     <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
		      height:1.5pt'>
		      <td width=500 style='width:375.0pt;background:white;padding:0cm 0cm 0cm 0cm;
		      height:1.5pt;outline: none;cursor:pointer'>
		      </td>
		     </tr>
		    </table>
		    <p class=MsoNormal style='margin-bottom:12.0pt;line-height:17.25pt'>
					<span style='font-size:11.5pt;font-family:'Arial',sans-serif'><o:p>&nbsp;</o:p></span>
				</p>
		    <p class=MsoNormal style='margin-bottom:12.0pt;line-height:17.25pt'>
        <br><br>
				<span style='font-size:11.5pt;font-family:'Arial',sans-serif'>Atenciosamente,<span
		    style='color:#01363C'><br>
		    </span>Equipe de TI</span></p>

				<center><p class=MsoNormal style='margin-bottom:12.0pt;line-height:17.25pt'>
					<span style='font-size:11.5pt;font-family:'Arial',sans-serif'>Esse é um email automático!</span></p></center>

		    </td>
		    <td width=35 style='width:26.25pt;background:white;padding:0cm 0cm 0cm 0cm;
		    height:1.5pt'>
		    <p class=MsoNormal><img border=0 width=35 height=2 id='_x0000_i1028'
		    src='http://images.hello.zendesk.com/EloquaImages/clients/ZendeskInc/%7B123c1adb-7774-4470-b163-77f859ab86ff%7D_spacer.gif'
		    style='height:.02in;width:.364in'></p>
		    </td>
		   </tr>
		  </table>
		  </div>
		  <p class=MsoNormal align=center style='text-align:center'><span
		  style='display:none;mso-hide:all'><o:p>&nbsp;</o:p></span></p>
		  <div align=center>
		  <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=600
		   style='width:450.0pt;border-collapse:collapse;mso-yfti-tbllook:1184;
		   mso-padding-alt:0cm 0cm 0cm 0cm'>
		   <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
		    height:23.25pt'>
		    <td width=455 style='width:341.25pt;background:white;padding:0cm 0cm 0cm 0cm;
		    height:23.25pt'>
		    <p class=MsoNormal><img border=0 width=66 height=31 id='_x0000_i1029'
		    src='http://images.hello.zendesk.com/EloquaImages/clients/ZendeskInc/%7B123c1adb-7774-4470-b163-77f859ab86ff%7D_spacer.gif'
		    style='height:.322in;width:.687in'></p>
		    </td>
		   </tr>
		  </table>
		  </div>
		  <p class=MsoNormal align=center style='text-align:center'><o:p>&nbsp;</o:p></p>
		  <p class=MsoNormal align=center style='text-align:center'><o:p>&nbsp;</o:p></p>
		  <div align=center>
		  <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=600
		   style='width:450.0pt;border-collapse:collapse;mso-yfti-tbllook:1184;
		   mso-padding-alt:0cm 0cm 0cm 0cm'>
		   <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
		    height:42.35pt'>
		    <td width=455 valign=top style='width:341.25pt;background:#F2F1EF;
		    padding:0cm 0cm 0cm 0cm;height:42.35pt'>
		    <p class=MsoNormal align=center style='text-align:center'><o:p>&nbsp;</o:p></p>
		    <p class=MsoNormal align=center style='text-align:center'><a
		    href='http://app.hello.zendesk.com/e/er?s=2136619493&amp;lid=18689&amp;elqTrackId=3fc17d304d8747949ab91286b856c1ab&amp;elq=d8dfcff7e9b54004ade32f3ae42c6e51&amp;elqaid=8499&amp;elqat=1'
		    target='_blank'><!--[if gte vml 1]><v:shape id='Imagem_x0020_2' o:spid='_x0000_i1030'
		     type='#_x0000_t75' alt=''
		     href='http://app.hello.zendesk.com/e/er?s=2136619493&amp;lid=18689&amp;elqTrackId=3fc17d304d8747949ab91286b856c1ab&amp;elq=d8dfcff7e9b54004ade32f3ae42c6e51&amp;elqaid=8499&amp;elqat=1'
		     target='&quot;_blank&quot;' style='width:63pt;height:14.25pt' o:button='t'>
		     <v:imagedata src='http://".$_SERVER['HTTP_HOST']."/helpTI/assets/images/logohz.png'
		      o:href='cid:image002.png@01D4E0D3.AFDEEA10'/>
		    </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout'><img
		    border=0 width=70 height=40
		    src='http://".$_SERVER['HTTP_HOST']."/helpTI/assets/images/logohz.png'
		    style='height:.197in;width:.875in' v:shapes='Imagem_x0020_2'></span><![endif]></a></p>
		    <p class=MsoNormal align=center style='text-align:center'><br>
		    <span style='font-size:7.0pt;font-family:'Arial',sans-serif'>Av. Governador
		    Manoel Ribas, 521, Dom Pedro II<o:p></o:p></span></p>
		    <p class=MsoNormal align=center style='text-align:center'><span
		    style='font-size:2.0pt;font-family:'Arial',sans-serif'><o:p>&nbsp;</o:p></span></p>
		    <p class=MsoNormal align=center style='text-align:center'><span
		    style='font-size:8.0pt'>Ramais: 5023 / 5007 | <a
		    href='http://www.cimbessul.com.br/helpdesk'>www.cimbessul.com.br/helpdesk</a></span><span
		    style='font-size:7.0pt'> </span><span style='font-size:7.5pt;font-family:
		    'Arial',sans-serif;color:#30AABC'><o:p></o:p></span></p>
		    </td>
		   </tr>
		  </table>
		  </div>
		  <p class=MsoNormal align=center style='text-align:center'><o:p></o:p></p>
		  </td>
		 </tr>
		</table>

		<p class=MsoNormal><o:p>&nbsp;</o:p></p>

		<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=600
		 style='width:450.0pt;mso-cellspacing:0cm;mso-yfti-tbllook:1184;mso-padding-alt:
		 0cm 0cm 0cm 0cm'>
		 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
		  <td style='background:#F2F1EF;padding:0cm 0cm 0cm 0cm;min-width: 600px'>
		  <div align=center>
		  <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=600
		   style='width:450.0pt;mso-cellspacing:0cm;mso-yfti-tbllook:1184;mso-padding-alt:
		   0cm 0cm 0cm 0cm'>
		   <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
		    height:11.25pt'>
		    <td style='background:#F2F1EF;padding:0cm 0cm 0cm 0cm;height:11.25pt'>
		    <p class=MsoNormal style='line-height:11.25pt'><img border=0 width=66
		    height=15 id='_x0000_i1031'
		    src='http://images.hello.zendesk.com/EloquaImages/clients/ZendeskInc/%7B123c1adb-7774-4470-b163-77f859ab86ff%7D_spacer.gif'
		    style='height:.156in;width:.687in'></p>
		    </td>
		   </tr>
		  </table>
		  </div>
		  </td>
		 </tr>
		</table>

		<div>

		<p class=MsoNormal style='line-height:0%'><span style='font-size:11.5pt;
		font-family:Courier'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <o:p></o:p></span></p>

		</div>

		<p class=MsoNormal><img border=0 id='_x0000_i1032'
		src='http://app.hello.zendesk.com/e/FooterImages/FooterImage1?elq=d8dfcff7e9b54004ade32f3ae42c6e51&amp;siteid=2136619493'></p>

		</div>

		</body>

		</html>

			");
		// verifica se está tudo ok com oa parametros acima, se nao, avisa do erro. Se sim, envia.
		if(!$Email->Send()) {
			echo '<strong>Erro ao Enviar!</strong>';
		}

	} while ($data_destinatarios = $resultDestinatarios->fetch(PDO::FETCH_ASSOC));
}



  sleep(3);
	echo "<script>window.location='../../ui-view-ticket.php?id=$id_ticket';</script>";

	$conexao->commit();

?>
