<?php

$calendar      = new Calendar();
$curretDteTime = $calendar->currentDay();
$main_map      = mainMap();

?>

<script type="text/javascript">

	$(function () {

		setInterval(function () {

			"<?php $curretDteTime = $calendar->currentDay(); ?>"
			$(".time_now").html("<?php echo $curretDteTime['timeNow'];?>");


		}, 1000);

	})

</script>

<?php

?>

<script type="text/javascript">

	$(function () {

		//  let weather = Utils.weatherApi();
		setInterval(Utils.weatherApi(), 5000);

	})

</script>

<div class="tempDateInfo">

	<div class="temperature">

		<h1></h1>
		<p class="tempName"></p>

	</div>

	<div class="dateHour">

		<p class="time_now"></p>
		<p class="curDate"><?php echo $curretDteTime['dateNow']; ?></p>

	</div>

</div>

<div class="weatherButts">

	<img src="../<?php echo $main_map; ?>/public/media/weather/weatherl.svg" alt="" id="weatherR">
	<img src="../<?php echo $main_map; ?>/public/media/weather/weatherr.svg" alt="" id="weatherL">

</div>
