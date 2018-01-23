<?php

require "pdo_connection.php";
require "../phpUtils.php";
$pdo = pdo();

$eventName = htmlentities(htmlspecialchars($_GET['eventName']));

$getEvent = $pdo->prepare('SELECT * FROM events WHERE name=?');
$getEvent->execute(array($eventName));


while ($displayEvt = $getEvent->fetch()) {
    
    ?>

	<div class="evtDisplayHeader">

		<img src="../jarvis/public/media/events/eventleft.svg" alt="" id="backToEvents">
		<h2>Event details</h2>
		<h3 id="editEvent">Edit</h3>

	</div>

	<div class="evtDisplayBody">

		<h2><?php echo $displayEvt['name']; ?></h2>
		<p><?php echo $displayEvt['location']; ?></p>
		<hr class="evtDetailSeparator" />

		<div class="evtDateTime">

			<p><?php echo $displayEvt['start_date']; ?></p>
			<p><?php echo 'From ' . $displayEvt['start_time'] . ' to ' . $displayEvt['end_time']; ?></p>

		</div>

		<div class="alert">

			<div class="alertNotification">

				<p>Alert</p>
				<div class="alertParams">

					<p>None</p>
					<img src="" alt="">

				</div>

			</div>

			<hr />

		</div>

	</div>

	<div class="evtDisplayFooter">

		<div class="evtInvites">

		</div>

		<h4 id="deleteEvt">Delete event</h4>

	</div>
    
    <?php
    
}
      
