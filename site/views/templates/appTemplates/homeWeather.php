<?php

$calendar        = new Calendar();
$currentDateTime = $calendar->currentDay();
$main_map        = mainMap();

?>

<script type="text/javascript">

	$(function () {

		setInterval(function () {

			"<?php $currentDateTime = $calendar->currentDay(); ?>"
			$(".time_now").html("<?php echo $currentDateTime['timeNow'];?>");


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
		<p class="curDate"><?php echo $currentDateTime['dateNow']; ?></p>

	</div>

</div>
