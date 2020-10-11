<?php

include("../includes/conexao.php");
require_once('../plugins/SendMail/PHPMailer/class.phpmailer.php');

$emailUsuario   = $_POST['forgotPasswordEmail'];

$selectUser = "SELECT id, nome, email FROM usuarios WHERE email = '$emailUsuario'";
$resultUser = $conexao -> prepare($selectUser);
$resultUser -> execute();
$countUser = $resultUser->rowCount();

if ($dataUser = $resultUser->fetch()) {
	do {

		$idUsuario    = $dataUser['id'];
		$emailUsuario = $dataUser['email'];
		$nomeUsuario  = utf8_encode($dataUser['nome']);
		$separaNome = explode(" ", $nomeUsuario);
		$nomeUsuario  = $separaNome[0];

	} while ($dataUser = $resultUser->fetch());
}

date_default_timezone_set('America/Brasilia');
$dateTime      = date('d/m/Y H:i:s');

	$conexao->beginTransaction();

	$conexao->exec("UPDATE usuarios SET redefineSenha='1' WHERE id = '$idUsuario'" );

	$evento = $nomeUsuario." esqueceu a senha em ".$dateTime;

	$conexao->exec("INSERT INTO registros (id, evento, data_hora_evento)
									                    VALUES ('', '$evento', '$dateTime')" );

			//$emailCC   = "app@pibparanagua.com.br";
			$email_envio = "app@pibparanagua.com.br";

			$Email = new PHPMailer();
			$Email->SetLanguage("br");
			$Email->IsSMTP(); // Habilita o SMTP
			$Email->SMTPAuth = true; //Ativa e-mail autenticado
			$Email->Host = 'pibparanagua.com.br'; // Servidor de envio # verificar qual o host correto com a hospedagem as vezes fica como smtp.
			$Email->Port = '25'; // Porta de envio 587
			$Email->Username = $email_envio; //e-mail que será autenticado
			$Email->Password = '537c!foK'; // senha do email
			// ativa o envio de e-mails em HTML, se false, desativa.
			$Email->IsHTML(true);
			// email do remetente da mensagem
			$Email->From = $email_envio;
			// nome do remetente do email
			$Email->FromName = utf8_decode('PIB Paranaguá');
			//$Email->AddCC($emailCC);
			// Endereço de destino do email, ou seja, pra onde você quer que a mensagem do formulário vá?
			$Email->AddReplyTo($email_envio, 'PIB Paranaguá');
			$Email->AddAddress("$emailUsuario"); // para quem será enviada a mensagem
			// informando no email, o assunto da mensagem
			$Email->Subject = utf8_decode("Esqueceu sua senha, $nomeUsuario?");
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

			<title>LAS - Segurança Patrimonial</title>

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
			    <td width=600 style='width:450.0pt;background:#121212;padding:0cm 0cm 0cm 0cm;
			    height:63.75pt'>
			    <p class=MsoNormal align=center style='text-align:center'><a
			    href='http://".$_SERVER['HTTP_HOST']."/app'
			    target='_blank'><span style='mso-ignore:vglayout'><img
			    border=0 width=250 height=450
			    src='http://www.cimbessul.com.br/logo.png'
			    style='height:2.300in;width:2.100in' v:shapes='Imagem_x0020_1'></span><![endif]></a></p>
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
			    <p class=MsoNormal align=center style='text-align:center'></p>
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
			    style='font-size:11.5pt;font-family:'Arial',sans-serif'><span style='color:#01363C'> </span>".$nomeUsuario.",<span style='color:#01363C'><br>
			    <br>

					<p class=MsoNormal style='margin-bottom:12.0pt;line-height:17.25pt'>
						<b><span style='font-size:11.5pt;font-family:'Arial',sans-serif'>Clique no link para redefinir sua senha</span></b>
						<span style='font-size:11.5pt;font-family:'Arial',sans-serif'><a href='http://www.pibparanagua.com.br/app/login/index.php?id=$idUsuario'>Redefinir minha senha agora!</a></span>
					</p>

					<p class=MsoNormal style='margin-bottom:12.0pt;line-height:17.25pt'>
						<span style='font-size:11.5pt;font-family:'Arial',sans-serif'>Caso isso não seja para você, ignore essa mensagem!</p>


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
						<span style='font-size:11.5pt;font-family:'Arial',sans-serif'>Atenciosamente,<span
			    style='color:#01363C'><br>
			    </span>Equipe de Comunicação</span></p>

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
			    target='_blank'><!--[if gte vml 1]><![endif]--><![if !vml]><span style='mso-ignore:vglayout'></span><![endif]></a></p>
			    <p class=MsoNormal align=center style='text-align:center'><span
			    style='font-size:2.0pt;font-family:'Arial',sans-serif'><o:p>Rua Prof. Cleto, 349, Centro | 83206-250 | (41) 3423-2824 <br> <a href='http://www.pibparanagua.com.br/app'>www.pibparanagua.com.br/app</a><br><br></o:p></span></p>
			    <p class=MsoNormal align=center style='text-align:center'><span
			    style='font-size:8.0pt; padding-bottom: 30px'></span><span
			    style='font-size:7.0pt'> </span><span style='font-size:7.5pt;font-family:
			    'Arial',sans-serif;color:#30AABC'><o:p></o:p></span></p>
			    </td>
			   </tr>
			  </table>
			  </div>
			  </td>
			 </tr>
			</table>

			</div>

			</body>

			</html>

				");
			// verifica se está tudo ok com oa parametros acima, se nao, avisa do erro. Se sim, envia.
			if(!$Email->Send()) {
				echo '<strong>Erro ao Enviar!</strong>';
			}

	sleep(3);
	echo "<script>window.location='../../login';</script>";

	$conexao->commit();

?>
