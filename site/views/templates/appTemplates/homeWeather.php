<?php

$calendar        = new Calendar();
$currentDateTime = $calendar->currentDay();
$main_map        = mainMap();

?>

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
