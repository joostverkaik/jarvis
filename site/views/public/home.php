<!DOCTYPE html>
<html>
<head>
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . "/jarvis/site/views/templates/head.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/jarvis/site/models/home_model.php";
    ?>
	<link href="https://fonts.googleapis.com/css?family=Hind|Open+Sans" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../<?php echo $main_map; ?>/public/css/home.css" />
	<script type="text/javascript" src="../<?php echo $main_map; ?>/public/js/home.js"></script>
	<title>Home</title>
</head>
<body>

<header>

	<div class="homeCore">

		<div class="nieuws">

			<div class="weatherInfo">
                
                <?php renderTemplate("homeWeather"); ?>

			</div>

			<div class="rssFeed">
				<!-- start feedwind code -->
				<script type="text/javascript" src="https://feed.mikle.com/js/fw-loader.js"
						data-fw-param="61452/"></script> <!-- end feedwind code --></iframe>

			</div>

		</div>

		<div class="calendar">
            
            <?php renderTemplate("calendar"); ?>

		</div>

	</div>

</header>

<footer>

</footer>

</body>

</html>
