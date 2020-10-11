<body class="" style="background-color: #18191a; border: 0; background-position: center; background-size: auto;">

<style>
.directory {
  background-color: #242526!important;
  color: #b0b3b8!important;
}
table td.filename a {
  color: #b0b3b8!important;
}
.file-list {
  background-color: #242526!important;
  border: 0;
}
.button {
  -webkit-box-shadow: none!important;
  -moz-box-shadow: none!important;
  box-shadow: none!important;
}
table tbody tr:nth-child(even) {
    background: transparent;
    color: #b0b3b8;
}
.filesize {
  color: #b0b3b8!important;
}
table[role="presentation"] {
    width: 100%;
    display: block;
    min-height: 40px;
    background-color: #242526!important;
    border: 0;
}
tbody.files .name {
    width: 40%;
    max-width: 200px;
    overflow: hidden;
    padding: 0 0 0 10px;
    color: #b0b3b8!important;
}
</style>

<!-- prepare upload templates -->
<?php gator::display("main_tmpl.php")?>

<?php if(gatorconf::get('use_auth') == true && gatorconf::get('show_top_auth_bar') == true && $_SESSION['simple_auth']['username'] != 'guest'):?>
<div class="top-menu">
<div class="row">
<a class="version-info"><a>

 <?php if(gatorconf::get('allow_change_password')):?>
 	<a class="username-edit"><?php echo $_SESSION['simple_auth']['username']?></a>
 <?php else:?>
	 <?php echo $_SESSION['simple_auth']['username']?>
 <?php endif;?>
 | <a href="?logout=1"><?php echo lang::get("Sign out")?></a>
</div>
</div>
<div class="top-menu-spacer"></div>
<?php endif;?>

<div id="wrapper" class="row">
<div class="container twelve columns" style="padding: 0; margin-top: -30px; border-radius: 0">
<div id="topcorners" style="border-radius: 0!important; background-color: #18191a!important;"></div>
<div id="content" style="padding: 0px 10px 0 10px; background-color: #18191a!important;">

<?php if(gatorconf::get('use_auth') == true && gatorconf::get('show_top_auth_bar') == false && $_SESSION['simple_auth']['username'] != 'guest'):?>
<div class="small-auth-menu">
 <a class="version-info">Arquivos</a>&nbsp;
 |

 <?php if(gatorconf::get('allow_change_password')):?>
 	<a class="username-edit"><?php echo $_SESSION['simple_auth']['username']?></a>
 <?php else:?>
	 <?php echo $_SESSION['simple_auth']['username']?>
 <?php endif;?>

 | <a href="?logout=1"><?php echo lang::get("Sign out")?></a>
</div>
<?php endif;?>

<?php if(gatorconf::get('use_auth') == true && $_SESSION['simple_auth']['username'] == 'guest'):?>
<div class="small-auth-menu">
 <a href="?login=1"><?php echo lang::get("Sign in")?></a>
</div>
<?php endif;?>

<div class="fileupload-container navigation-button">
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="#" method="POST" enctype="multipart/form-data">
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="nav fileupload-buttonbar">


				<?php if (gator::checkPermissions('ru')):?>
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="fileinput-button nice radius button btn btn-raised btn-primary">
                    <i class="icon-plus icon-white"></i>

					<span class=""><?php echo lang::get("Add Files...")?></span>

                    <input type="file" name="files[]" multiple>
                    <input type="hidden" name="uniqid" value="50338402749c1">
                </span>
                <?php endif;?>

                <div class="clear"></div>

        </div>

        <!-- The table listing the files available for upload/download -->
		<div id="top-panel">
        <table role="presentation" class="table table-striped">
         <tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery">
         </tbody>
        </table>

        </div>
    </form>
</div>


<div id="browse-panel">


<div class="clear"></div>

<form id="fileset" action="?" method="POST" accept-charset="UTF-8">

<?php gator::display("main_filelist.php", $params)?>

<div class="bottom-actions">
<?php if (gator::checkPermissions('rw')):?>
<button type="button" class="nice radius button select-button btn btn-raised btn-primary"><?php echo lang::get("Select All")?></button>


<?php if (gatorconf::get('use_zip')):?>
<button type="button" class="nice secondary radius button zip-selected"><?php echo lang::get("Zip")?></button>
<?php endif;?>
<button type="button" class="nice secondary radius button delete-selected btn btn-raised btn-warning"><?php echo lang::get("Delete")?></button>

<?php endif;?>


</div>

</form>
</div> <!-- end browse-panel -->
</div>
<div id="bottomcorners" style="border-radius: 0!important; background-color: #18191a!important;"></div>
</div>
</div>

<div id="modal" class="reveal-modal"></div>
<div id="second_modal" class="reveal-modal"></div>
<div id="big_modal" class="reveal-modal large"></div>

<?php gator::display("main_js.php")?>
