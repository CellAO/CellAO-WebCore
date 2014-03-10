<?php
	defined('PRE_LINK') ? $preLink = PRE_LINK : $preLink = "";
	require_once($preLink . 'includes/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>CellAO</title>
		<?php
			foreach($includeCSSFiles as $filePath){
    		?>
    			<link rel="stylesheet" href="<?php echo($filePath); ?>" type="text/css" />
    		<?php
  		}
  		?> 
  		<script src="<?php echo($preLink); ?>js/jquery-1.11.0.min.js"></script>
  		<?php
  		foreach($includeJavascriptFiles as $filePath){
    		?>
					<script src="<?php echo($filePath); ?>"></script>
    		<?php
  		}
		?>
</head>

<body>
		<!-- Master Container: Centered and 700px wide -->
		<div id="container">
				<?php 
					if(isset($_REQUEST['err'])){
						echo("<span class='error'>" . $_REQUEST['err'] . "</span>");
					}
					if(isset($_REQUEST['msg'])){
						echo("<span class='message'>" . $_REQUEST['msg'] . "</span>");
					}
				?>

				<div id="topbar">
						<span id="headDate">[<?php print(date("Y-m-d")); ?>]</span>
						<span id="mottoText">.:Cell AO - Serving the AO Community:.</span>
				</div>
				<div>
					<span style="float: left;">
						<?php
						if(isset($_SESSION['SESS_ID'])){
						?>
								<span id="welcomeMessage">Welcome <?php print($_SESSION['SESS_FIRST_NAME']); ?> <a href="<?php echo($preLink);?>logout.php">(Logout)</a></span>
						<?php 
						} else {
						?>
							<!-- This is the login controls holder -->
							<div class="userform">
									<form id="loginForm" name="loginForm" method="post" action="<?php echo($preLink);?>process-login.php">
										<!-- Here's your login controls -->
										<input type="text" name="login" id="login" value="Username" size="15"/>
										<input type="text" name="password" id="password" value="Password" size="15" />
										<input type="submit" name="Submit" value="Login" />
									</form>
									<input type="submit" id="register" name="Register" value="Register">

							</div>
							<!-- @TODO: Pull out into a script file. -->
							<script>
								$('#login').on('focusin', function(event){ 
									if($(this).val() == "Username"){
										$(this).val('');
									}
								});
								$('#login').on('focusout', function(event){
									if($(this).val() == ""){
										$(this).val('Username');
									}
								});
								$('#password').on('focusin', function(event){
									$(this).val('');
									$(this).attr('type', 'password');
								});
								$('#password').on('focusout', function(event){
									if($(this).val() == ""){
									 $(this).attr('type', 'text');
									 $(this).val('Password');

									}
								});
								$('#register').on('click', function(event){
									event.stopPropagation();
									window.location = '<?php echo($preLink);?>register.php';
								});
							</script>
							<!-- End of the login controls holder -->
						<?php
						}
						?>
					</span>
					<span style="float: right;"><input type="text" value="Search..." id="searchBox"></span>
					<!-- @TODO: Pull out into a script file. -->
					<script type="text/javascript">
						$('#searchBox').on('focusin', function(event){
							if($(this).val() == "Search..."){
								$(this).val('');
							}
						});
						$('#searchBox').on('focusout', function(event){
							if($(this).val() == ""){
								$(this).val('Search...');
							}
						});
					</script>
				</div>
				<!-- End of top bar -->


				<!-- This hold the navigation tabs -->
				<div id="tabholder">
						<div id="tabs8">
								<ul>		
										<li id="navigationItem">
												<a href="<?php echo($preLink);?>index.php"><span>.: MAIN :.</span></a>
										</li>
										<?php
											if(isset($_SESSION['SESS_ID'])){
											?>
										<li id="navigationItem">
											<a href="<?php echo($preLink);?>member-profile.php"><span>.: MY PROFILE :.</span></a>
										</li>
											<?php
											}
										?>
										<?php
											if(isset($_SESSION['SESS_GM']) && $_SESSION['SESS_GM'] >= 100){
										?>
											<li id="navigationItem">
													<a href="<?php echo($preLink);?>admin.php"><span>.: ADMIN :.</span></a>
											</li>
										<?php
											}
										?>
										<li id="navigationItem">
												<a href="http://www.aocell.info/forums/"><span>.: FORUM :.</span></a>
										</li>
										<li id="navigationItem">
												<a href="<?php echo($preLink);?>#"><span>.: CHAT :.</span></a>
										</li>
										<li id="navigationItem">
												<a href="<?php echo($preLink);?>support.php"><span>.: SUPPORT :.</span></a>
										</li>
										<li id="navigationItem">
												<a href="<?php echo($preLink);?>about.php"><span>.: ABOUT :.</span></a>
										</li>
							</ul>
						</div>
				</div>
				<!-- End of the tabs holder -->
				<div id="mainContent">