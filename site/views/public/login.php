<?php
session_start();

require "site/models/login_model.php";
$login = new login();
$login->signin();
$login->not_register_sigin();
$login->dataRecorvery();
?>
<!DOCTYPE html>
<html>
<head>
    <?php require "site/views/templates/head.php"; ?>
	<link rel="stylesheet" href="/public/css/login.css" />
	<!--  <link rel="stylesheet" href="../reachoutNL/public/css/font.css"/>-->
	<script src="public/js/login.js"></script>
	<title>Login</title>
</head>
<body>

<header>

	<div class="loginPage">

		<div id="heads">

			<img src="public/media/podiumDeFluxLogo.png" id="logo" alt="">
			<p>vrijwilligers</p>
			<!--<div id="logoText">

              <h1>PODIUM</h1>
               <h1>DEFLUX</h1>
               <p>vrijwilligers</p>

            </div>-->

			<!--<div id="menuItems">

              <a href="#">menu</a>
              <a href="#">menu</a>
              <a href="#">menu</a>

            </div>-->

		</div>

		<div id="core">

			<p id="error">Voer je gebruikersnaam en wachtwoord om in te logen...</p>

			<!--<div id="formBack">

            </div>-->

			<form class="" action="" method="post">

				<label for="username">Gebruikersnaam</label>
				<input type="text" name="username" class="usersData"
					   value="<?php echo $login->post_value('username'); ?>">
				<label for="password">Wachtwoord</label>
				<input type="password" name="password" class="usersData">

				<div class="signInUp">

					<input type="submit" name="vrijw_signin" value="Aanmelden" id="sigin">
					<input type="submit" name="vrijw_signup" value="Registreren" id="sigup">

				</div>

			</form>

			<p id="dataRecovery">Wachtwoord of gebruikersnaam vergeten?</p>

			<div id="recoveryDataScreen">

				<img src="public/media/images/delete.svg" alt="" id="closeRecoverForm">

				<p id="explain">

					Voer uw email in en klikt vervolgens op
					een van de twee onderstaande knopen on ue
					wachtwoort of gebruikersnaam te herstellen...

				</p>

				<form class="" action="" method="">

					<input type="email" name="" placeholder="Email" id="userEmail">

					<div class="recovers">

						<input type="submit" name="" value="Gebruikersnaam herstelen" class="recoverSubmits">
						<input type="submit" name="" value="Wachtwoord herstelen" class="recoverSubmits">

					</div>

				</form>

			</div>

		</div>


	</div>

</header>


<footer>


</footer>


</body>

</html>
