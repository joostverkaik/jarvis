<?php

$calendar = new Calendar();
//$calendar->display_calendar();
$main_map = mainMap();

?>


<div class="agenda">

	<div class="agendaHeader">

		<h3><?php echo $calendar->currentMonth(); ?></h3>
        <?php
        if (isset($_COOKIE['current_mode']) && $_COOKIE['current_mode'] !== 'open') {
            ?>
			<img src="../<?php echo $main_map; ?>/public/media/events/addevent.svg" alt="" id="addEvents">
            <?php
        }
        ?>

	</div>

	<div class="agendaBody">
        
        <?php $calendar->display_calendar(); ?>

	</div>

	<div class="agendaFooter">

		<div class="eventsOwner" style="border: 1px solid #111111; padding: 5px;">
            
            <?php
            echo $calendar->getUsers();
            ?>

		</div>

		<button id="bored">Suggest activities</button>

	</div>

</div>