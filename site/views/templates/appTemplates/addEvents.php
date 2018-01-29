<?php
require $_SERVER['DOCUMENT_ROOT'] . "/jarvis/site/core/model.php";

if (isset($_GET['date'])) {
    $dateTime = new DateTime($_GET['date']);
} else {
    $dateTime = new DateTime();
}

$dayNow  = $dateTime->format('j') . '-' . date('m') . '-' . $dateTime->format('Y');
$timeNow = $dateTime->format('H') . ":" . $dateTime->format('i');
$dateTime->modify("+2 hours");
$timeEnd = $dateTime->format('H') . ":" . $dateTime->format('i');

?>

<div class="addEventCont">

	<div class="addEventHeader">

		<img src="../jarvis/public/media/events/eventleft.svg" alt="" id="backToEvent"
			 data-day="<?= $dateTime->format('d') ?>" data-month="<?= $dateTime->format('m') ?>">
		<h2>New Event</h2>
		<h3 id="addNewEvent">Save</h3>

	</div>

	<div class="addEventBody">

		<form class="addEventForm" action="">

			<div class="inputsCont">

				<label for="eventName">Name</label>
				<input type="text" name="" id="eventName">

			</div>


			<div class="inputsCont">

				<label for="eventLocation">Location</label>
				<input type="text" name="" id="eventLocation">

			</div>

			<div class="inputsCont dateTime" id="space">

				<label for="eventStart">Start date</label>
				<input type="text" name="" id="eventStart" placeholder="" value="<?php echo $dayNow; ?>">
				<input type="text" name="" id="eventTimeStart" placeholder="" value="<?php echo $timeNow; ?>">

			</div>

			<div class="inputsCont dateTime">

				<label for="eventEnd">End date</label>
				<input type="text" name="" id="eventEnd" placeholder="" value="<?php echo $dayNow; ?>">
				<input type="text" name="" id="eventTimeEnd" placeholder="" value="<?php echo $timeEnd; ?>">

			</div>

			<div class="inputsCont" id="allDays">

				<input type="checkbox" name="" id="allDay" placeholder="" value="1">
				<label for="allDay">All day event</label>

			</div>


			<div class="inputsCont">

				<label for="alert">Alert</label>
				<input type="text" name="" id="alert" placeholder="">

			</div>

		</form>

	</div>

	<div class="addEventFooter">

		<p>Who is participating?</p>
		<div class="invited">

			<div class="inputsInvited">

				<p style="color: red;"><label><span><input type="checkbox" name="invitees[]" class="invitedCheckbox"
													 value="1" checked disabled></span> me</label></p>

			</div>
            
            <?php
            $model = new model();
            $users = $model->prepare("SELECT *
									  FROM users
									  WHERE user_id != 1
									  ORDER BY `firstname`", []);
            
            foreach ($users->fetchAll(PDO::FETCH_ASSOC) as $user) {
                ?>
				<div class="inputsInvited">
					<p style="color: <?= $user['color'] ?>;"><label><span><input type="checkbox" name="invitees[]"
																		   class="invitedCheckbox"
																		   value="<?= $user['user_id'] ?>"></span> <?= $user['firstname'] ?>
						</label></p>
				</div>
                <?php
            }
            ?>

		</div>
        
        <?php
        if (isset($_COOKIE['current_mode']) && $_COOKIE['current_mode'] === 'private') {
            ?>
			<p>Is this a private event?</p>
			<div class="private_event">
				<p><label><input type="checkbox" name="private" id="private" class="privateEvent"
								 value="1"> Yes</label></p>
			</div>
            <?php
        } else {
            ?>
			<input type="hidden" name="private" id="private" class="privateEvent" value="0">
			<p>To make this a private event, make sure you are in private mode first.</p>
            <?php
        }
        ?>

	</div>

</div>


<style media="screen">

	.addEventCont {

		width: 100%;
		height: 100%;
		display: flex;
		flex-direction: column;
		justify-content: space-around;
		align-items: center;

	}

	.addEventHeader {

		width: 90%;
		height: 15%;
		display: flex;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;

	}

	.addEventHeader img {

		width: 20px;
		height: 20px;
		cursor: pointer;

	}

	.addEventHeader img:hover {

		transition: transform 0.2s linear 0s;
		transform: scale(1.2, 1.2);

	}

	.addEventHeader h2 {

		text-align: center;
		color: #F65F59;

	}

	#addNewEvent {

		text-align: center;
		color: #F65F59;
		cursor: pointer;

	}

	#addNewEvent:hover {

		transition: transform 0.2s linear 0s;
		transform: scale(1.2, 1.2);

	}

	.addEventBody {

		width: 100%;
		height: 55%;
		display: flex;
		justify-content: flex-end;
		align-items: flex-end;

	}

	.addEventForm {

		width: 95%;
		height: 90%;
		display: flex;
		flex-direction: column;
		justify-content: flex-start;
		align-items: center;

	}

	.inputsCont {

		display: flex;
		flex-direction: row;
		justify-content: center;
		align-items: center;
		width: 100%;
		height: auto;
		margin-bottom: 10px;
		border-bottom: 1px solid #2D3C77;

	}

	#space {

		margin-top: 30px;

	}

	.inputsCont label {

		text-align: left;
		color: #2D3C77;
		font-size: 16px;
		width: 15%;

	}

	.inputsCont input {

		border: 1px solid white;
		text-align: left;
		font-size: 16px;
		color: #2D3C77;
		width: 85%;

	}

	.dateTime input {

		width: 47%;

	}

	#allDays {

		margin-top: 0px;
		margin-bottom: 30px;
		border: 0px;
		justify-content: flex-start;
		align-items: flex-start;

	}

	#allDays input {

		padding: 20px;

	}

	#allDays input, #allDays label {

		width: auto;
		height: auto;

	}

	.addEventFooter {

		width: 90%;
		height: 30%;
		display: flex;
		flex-direction: column;
		justify-content: flex-start;
		align-items: flex-start;

	}

	.addEventFooter p {

		font-size: 16px;
		text-align: left;
		color: #2D3C77;
		margin-bottom: 5px;
		height: auto;

	}

</style>
