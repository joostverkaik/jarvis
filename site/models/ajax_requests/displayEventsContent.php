<?php

require "pdo_connection.php";
$pdo = pdo();

$eventId = htmlentities(htmlspecialchars($_GET['eventId']));

$getEvent = $pdo->prepare('SELECT * FROM events WHERE id = ?');
$getEvent->execute(array($eventId));


while ($displayEvt = $getEvent->fetch()) {
    
    ?>

	<div class="evtDisplayHeader">

		<img src="../jarvis/public/media/events/eventleft.svg" alt="" id="backToEvent"
			 data-date="<?= $displayEvt['start_date'] ?>">
		<h2>Event details</h2>
		<h3 id="editEvent">Edit</h3>

	</div>

	<div class="evtDisplayBody" data-id="<?= $displayEvt['id'] ?>">

		<h2><?php echo $displayEvt['name']; ?></h2>
		<p><?php echo $displayEvt['location']; ?></p>
		<hr class="evtDetailSeparator" />

		<div class="evtDateTime">

			<p><?php echo strftime('%A %e %B %Y', strtotime($displayEvt['start_date'])); ?></p>
			<p><?php echo 'From ' . $displayEvt['start_time'] . ' to ' . $displayEvt['end_time']; ?></p>

		</div>
		
		<?php
		$getInvites = $pdo->prepare('SELECT i.*, u.firstname, u.color
									 FROM invites i
									 LEFT JOIN users u
									 ON u.user_id = i.user_id
									 WHERE i.event_id = ?');
		$getInvites->execute([$displayEvt['id']]);
		if ($getInvites->rowCount() > 0) {
            ?>
			<h4>Invited household members:</h4>
			<div class="eventsOwner">
                <?php
                foreach ($getInvites->fetchAll(PDO::FETCH_ASSOC) as $user) {
                    ?>
					<div class="owner" style="color: <?= $user['color'] ?>;">
                        <?= $user['firstname'] ?>
					</div>
                    <?php
                }
                ?>

			</div>
            <?php
        }
		?>

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
      
