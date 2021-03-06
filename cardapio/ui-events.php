<?php

require('assets/includes/session.php');

if ($redefineSenha == 1) {echo "<script>window.location='ui-new-password.php?id=$idUsuario'</script>";}

?>
<!DOCTYPE html>
<html lang="en" style="overflow-x: hidden!important; ">

<head>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1, user-scalable=no">
	<title>PIB Paranaguá</title>

	<!-- Favicon -->
		<link rel="shortcut icon" href="../images/logo.png">

	<meta name="author" content="Cleber Lee da Rocha">

	<!-- Font Icon css -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<!-- Effect Animate css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css" integrity="sha256-gVCm5mRCmW9kVgsSjQ7/5TLtXqvfCoxhdsjE6O1QLm8=" crossorigin="anonymous" />

	<!-- Style CSS -->
	<link href="assets/css/style.css" rel="stylesheet" type="text/css" />

	<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">

	<!-- Alerts Switchery css -->
	<link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

	<!-- Edit TextArea css -->
	<link rel="stylesheet" href="assets/plugins/trumbowyg/ui/trumbowyg.min.css">

	<!-- Media Fancybox -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
	<link href="assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
	<link href="assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Share+Tech&display=swap" rel="stylesheet">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fmask/3.3.4/jquery.inputmask.bundle.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js" integrity="sha256-CIc5A981wu9+q+hmFYYySmOvsA3IsoX+apaYlL0j6fg=" crossorigin="anonymous"></script>
</head>

<body class="background_dark" style="z-index: 1000000000;">

<div class="row">

	<style>

	.snackbar-content {
	    display: block;
	    padding: .8rem 1.5rem;
	    margin-top: 3px;
	    font-size: .9rem;
	    color: #fff;
	    background-color: #3f51b5!important;
	    border-radius: 2px;
	}

	</style>

	<?php require('assets/includes/menuBar.php'); ?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 animated fadeIn" id="navSolicitacao">
		<div class="card mb-3" style="background: transparent; box-shadow: none;">

			<div class="card-header top_dark">
				<div style="float: left; z-index: 1" onclick="viewMenuBar()">
					<i style="display: inline-flex;" id="btnMenuBar" class="fa fa-2x fa-bars"></i>
				</div>
				<div style="width: 70%; margin-left: 12%;position: absolute; z-index: 0">
					<strong><h5 class="titleBar">Eventos</h5></strong>
				</div>
			</div>

			<div style="display: block">
					<nav>
					  <div class="nav nav-tabs top_dark" id="nav-tab" role="tablist">
					    <a class="nav-item nav-link active" id="nav-prox-eventos-tab" data-toggle="tab" href="#nav-prox-eventos" role="tab" aria-controls="nav-prox-eventos" aria-selected="true">Próximos Eventos</a>
					    <a class="nav-item nav-link" id="nav-agenda-tab" data-toggle="tab" href="#nav-agenda" role="tab" aria-controls="nav-agenda" aria-selected="false">Agenda</a>
					  </div>
					</nav>
					<div class="tab-content background_dark" id="nav-tabContent">
					  <div class="tab-pane fade show active" style="padding: 0" id="nav-prox-eventos" role="tabpanel" aria-labelledby="nav-prox-eventos-tab">
							<?php

								echo "<center><img src='assets/images/info.png' style='margin-top: 25%; width:60%'><br><br><p style='color: #b0b3b8;'>Aguardando Atualizações!</p></center>";

							?>
						</div>
					  <div class="tab-pane fade" style="padding: 0" id="nav-agenda" role="tabpanel" aria-labelledby="nav-agenda-tab">
							<?php

								echo "<center><img src='assets/images/info.png' style='margin-top: 25%; width:60%'><br><br><p style='color: #b0b3b8;'>Aguardando Atualizações!</p></center>";

							?>

						</div>
					</div>
			</div>

			<div class="card-body background_dark" style="border: 0; width: 100%; padding: 0px;">

				<!--
				<script>
				window.onload = function () {

				var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					backgroundColor: "#18191a",
					title:{
						text: "Email Categories",
						horizontalAlign: "center"
					},
					data: [{
						type: "doughnut",
						startAngle: 60,
						innerRadius: 75,
						indexLabelFontSize: 17,
						dataPoints: [
							{ y: 67, label: "Inbox" },
							{ y: 28, label: "Archives" },
							{ y: 10, label: "Labels" }
						]
					}]
				});
				chart.render();

				var dataPoints = [];

				var chart2 = new CanvasJS.Chart("chartContainer2", {
					animationEnabled: true,
					backgroundColor: "#18191a",
					title:{
						text: "Chamados"
					},
					axisX: {
						gridColor: "transparent",
						lineColor: "#242526",
					},
					axisY: {
						title: "Revenue in USD",
						gridColor: "transparent",
						lineColor: "#242526",
						valueFormatString: "#0,,.",
						suffix: "mn",
						prefix: "$"
					},
					data: [{
						type: "splineArea",
						color: "rgba(54,158,173,.7)",
						markerSize: 5,
						xValueFormatString: "YYYY",
						yValueFormatString: "$#,##0.##",
						dataPoints: dataPoints
					}]
				});
				updateData();

				// Initial Values
				var xValue = 0;
				var yValue = 10;
				var newDataCount = 6;

				function addData(data) {
					if(newDataCount != 1) {
						$.each(data, function(key, value) {
							dataPoints.push({x: value[0], y: parseInt(value[1])});
							xValue++;
							yValue = parseInt(value[1]);
						});
					} else {
						//dataPoints.shift();
						dataPoints.push({x: data[0][0], y: parseInt(data[0][1])});
						xValue++;
						yValue = parseInt(data[0][1]);
					}

					newDataCount = 1;
					chart2.render();
					setTimeout(updateData, 1500);
				}

				function updateData() {
					$.getJSON("https://canvasjs.com/services/data/datapoints.php?xstart="+xValue+"&ystart="+yValue+"&length="+newDataCount+"type=json", addData);
				}

				}
				</script>

				<div id="chartContainer" style="height: 200px; width: 97%;"></div>
				<div id="chartContainer2" style="height: 200px; width: 97%;"></div>

				-->

			</div>
		</div>
	</div>

</div>

<img src="assets/images/load_view.gif" id="loading" style="display: none; width: 10%; top: 5px; right: 5px; float: right; position: absolute; z-index: 999999;" />

<?php

include("assets/includes/menu.php");

?>

</body>

<script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/moment.min.js"></script>

<script src="assets/js/popper.min.js"></script>
<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>

<script src="https://cdn.rawgit.com/FezVrasta/snackbarjs/1.1.0/dist/snackbar.min.js"></script>

<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>

<script src="assets/plugins/jquery.filer/js/jquery.filer.min.js"></script>

<script src="assets/js/pikeadmin.js"></script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

$('#btnExit').click(function(){
		 swal({
			title: "Sair do app?",
			text: "Sua sessão será fechada!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				return location.href="?sair";
			} else {
				return false;
			;
			}
		});
	});

</script>

<!-- BEGIN Java Script for this page -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>

	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<!-- END Java Script for this page -->
<script src="assets/plugins/trumbowyg/trumbowyg.min.js"></script>
<script>
$(document).ready(function () {
    'use strict';
	$('.editor').trumbowyg();
});
</script>

<script src="assets/plugins/ion-rangeslider/ion.rangeSlider.min.js"></script>
<script>
$(function () {
    $("#range_slider").ionRangeSlider({
    	min: 0,
        max: 300
    });
});
</script>

<script>

// Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
      &&
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });

</script>
</html>
