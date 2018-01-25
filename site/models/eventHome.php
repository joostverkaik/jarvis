<?php
require "home_model.php";
$calendar = new Calendar();
$main_map = 'jarvis';

?>

<div class="agendaHeader">

	<h3><?php echo $calendar->currentMonth(); ?></h3>
	<img src="/<?php echo $main_map; ?>/public/media/events/addevent.svg" alt="" id="addEvents">

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

	<button id="bored">I am bored</button>

</div>
