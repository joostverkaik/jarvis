<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . "/jarvis/site/views/templates/head.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/jarvis/site/models/home_model.php";
    ?>
	<link href="https://fonts.googleapis.com/css?family=Hind|Open+Sans" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../<?php echo $main_map; ?>/public/css/home.css?<?= time() ?>">
	<link rel="stylesheet" type="text/css"
		  href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript"
			src="../<?php echo $main_map; ?>/public/js/jsLibs/jquery.cookie.js?<?= time() ?>"></script>
	<script type="text/javascript"
			src="../<?php echo $main_map; ?>/public/js/jsLibs/jquery.blockUI.min.js?<?= time() ?>"></script>
	<script type="text/javascript"
			src="../<?php echo $main_map; ?>/public/js/jsLibs/animation.js?<?= time() ?>"></script>
	<script type="text/javascript" src="../<?php echo $main_map; ?>/public/js/home.js?<?= time() ?>"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fabric.js/1.4.0/fabric.min.js"></script>
	<title>Home</title>
</head>
<body class="open">
<div class="changeMode goOpen" data-mode="open"></div>
<div class="changeMode goCollective" data-mode="collective"></div>
<div class="changeMode goPrivate" data-mode="private"></div>

<div class="background"></div>

<header>

	<div class="users_container">
		<div class="users">

		</div>
	</div>

	<div class="homeCore">

		<div class="nieuws">

			<div class="weatherInfo gsapAnim">
				<div class="weatherInfoPage currentWeather dragend-page" style="align-items: center;">
                    <?php
                    renderTemplate("homeWeather");
                    ?>
				</div>
				<div class="weatherInfoPage dragend-page" style="align-items: left;">
					<?php
                    renderTemplate("homeWeatherHourly");
                    ?>
				</div>
				<div class="weatherInfoPage dragend-page" style="align-items: left;">
					<?php
                    renderTemplate("homeWeatherForecast");
                    ?>
				</div>

			</div>

			<div class="rssFeed gsapAnim">
				<!-- start feedwind code -->
				<script type="text/javascript" src="https://feed.mikle.com/js/fw-loader.js"
						data-fw-param="61452/"></script>

			</div>

		</div>

		<div class="calendar gsapAnim">

			<div class="calendarHeaders">

				<div class="agenda">

				</div>

			</div>

		</div>
        
        <?php renderTemplate("tools"); ?>

	</div>

</header>

<div id="map" style="display: none;"></div>

<div id="boredDialog">
	<div id="boredContent"></div>
</div>

</body>

</html>
