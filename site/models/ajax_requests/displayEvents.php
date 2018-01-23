<?php

require "pdo_connection.php";
$pdo = pdo();

$dateNumb = htmlentities(htmlspecialchars($_GET['dateNumb']));
$curMonth = htmlentities(htmlspecialchars($_GET['curMonth']));
$curYear  = date('Y');

$date = $dateNumb . '-' . $curMonth . '-' . $curYear;

$getEvent = $pdo->prepare('SELECT * FROM events WHERE start_date=?');
$getEvent->execute(array($date));

if ($getEvent->rowCount() > 0) {
    
    while ($displayEvt = $getEvent->fetch()) {
        
        ?>

		<div class="evtCont">

			<h3><?php echo $displayEvt['name']; ?></h3>
			<div class="evtDateTime">

				<p><?php echo $displayEvt['start_date']; ?></p>
				<p><?php echo $displayEvt['start_time'] . ' - ' . $displayEvt['end_time']; ?></p>

			</div>

		</div>
        
        <?php
        
    }
    
} else {
    
    ?>

	No events planned
	
    <?php
    
}

    
