<?php
require "home_model.php";
if (isset($_GET['month']) && isset($_GET['year'])) {
    $calendar = new Calendar($_GET['month'], $_GET['year']);
    $curDate  = new DateTime($_GET['year'] . "-" . $_GET['month'] . "-01");
} else {
    $calendar = new Calendar();
    $curDate  = new DateTime();
}
$prevDate = clone $curDate;
$prevDate->modify("previous month");
$prevMonth = $prevDate->format('m');
$prevYear  = $prevDate->format('Y');

$nextDate = clone $curDate;
$nextDate->modify("next month");
$nextMonth = $nextDate->format('m');
$nextYear  = $nextDate->format('Y');

$main_map = 'jarvis';

?>

<div class="agendaHeader">

	<!--<img src="../jarvis/public/media/events/eventleft.svg" alt="" id="prevMonth" data-month="<?= $prevMonth ?>" data-year="<?= $prevYear ?>">-->
	<h3><?php echo $calendar->currentMonth(); ?></h3>
	<!--<img src="../jarvis/public/media/events/eventright.svg" alt="" id="nextMonth" data-month="<?= $nextMonth ?>" data-year="<?= $nextYear ?>">-->
    
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
