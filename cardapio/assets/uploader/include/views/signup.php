<body class="login" style="height: -webkit-fill-available; background: url(https://hitfigure.com/wp-content/uploads/2012/03/login-background.jpg); background-size: cover; min-height: 550px;">
<div id="wrapper">
<div id="header">
</div>

<div class="container">
<div id="topcorners"></div>

<div id="content" class="login">
<div id="logo">
<a href="<?php echo gatorconf::get('base_url')?>"><img alt="Drive Cimbessul" src="<?php echo gatorconf::get('base_url')?>/include/views/img/logo.png"></a>
</div>

<?php if (isset($params['goactivate'])):?>
<h5><?php echo lang::get("Please open your email and click on the link to proceed.")?></h5><br />
<a href="<?php echo gatorconf::get('base_url')?>" class="button right"><?php echo lang::get("Done")?></a>
<?php else:?>

<?php if (isset($params['errors'])):?><div class="error"><?php echo $params['errors'];?></div><?php endif;?>

<form action="<?php echo $_SERVER['PHP_SELF'].'?signup=1'; ?>" method="post">
  <div class="line"><label for="username"><?php echo lang::get("Username")?> *: </label><input type="text" name="username" id="username" value="<?php if (isset($_POST['username'])) echo $_POST['username']?>"/></div>
  <div class="line"><label for="email"><?php echo lang::get("Email")?> *: </label><input type="text" name="email" id="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']?>"/></div>
  <div class="line"><label for="password"><?php echo lang::get("Password")?> *: </label><input type="password" name="password" id="password"/></div>
  <div class="line"><label for="password2"><?php echo lang::get("Confirm password:")?> </label><input type="password" name="password2" id="password2"/></div>
	<?php
		$rand_int1 = substr(mt_rand(),0,2);
		$rand_int2 = substr(mt_rand(),0,1);
		$rand_int3 = substr(mt_rand(),0,1);
		$captcha_answer = $rand_int1 + $rand_int2 - $rand_int3;
		$_SESSION['captcha_answer'] = $captcha_answer;
	?>				
   <div class="line"><label for="captcha"><?php echo $rand_int1.' + '.$rand_int2.' - '.$rand_int3.' = ?';?> *: </label><input type="text" name="captcha" id="captcha" autocomplete="off"/></div>
   <div class="line submit" style="text-align:right"><input type="submit" class="button" value="<?php echo lang::get("Sign up")?>" /></div>
</form>

<?php endif;?>
</div>
<div id="bottomcorners"></div>
</div>
</div>

