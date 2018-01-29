<?php
require "home_model.php";
$calendar = new Calendar();
$main_map = 'jarvis';

?>

<div class="agendaHeader">

	<h3><?php echo $calendar->currentMonth(); ?></h3>
    <?php
    if (isset($_COOKIE['current_mode']) && $_COOKIE['current_mode'] !== 'open') {
        ?>
		<img src="/<?php echo $main_map; ?>/public/media/events/addevent.svg" alt="" id="addEvents">
        <?php
    }
    ?>

</div>

<div class="agendaBody">
    
    <?php $calendar->display_calendar(); ?>

</div>

<div class="agendaFooter">
    
    <?php
    if (isset($_COOKIE['current_mode']) && $_COOKIE['current_mode'] !== 'open') {
        ?>
		<div class="eventsOwner" style="padding: 5px;">
            <?php
            echo $calendar->getUsers();
            
            if (isset($_COOKIE['filter']) && $_COOKIE['filter'] > 0) {
                ?>
				<p id="resetFilter" style="display: block;">
					<button>Reset filter</button>
				</p>
                <?php
            } else {
                ?>
				<p id="resetFilter" style="display: none;">
					<button>Reset filter</button>
				</p>
                <?php
            }
            ?>
		</div>

		<button id="bored">I am bored</button>
        <?php
    }
    ?>

</div>
