<?php
require $_SERVER['DOCUMENT_ROOT'] . "/jarvis/site/core/model.php";

$curEvtId = htmlentities(htmlspecialchars($_GET['curEvtId']));

$model = new model();

$getCurEvt  = $model->prepare("SELECT * FROM events WHERE id = ?", [$curEvtId]);
$getEvtData = $getCurEvt->fetch();


function invitesStatus($status)
{
    
    $pdo      = pdo();
    $curEvtId = htmlentities(htmlspecialchars($_GET['curEvtId']));
    
    
    $getInvites = $pdo->prepare('SELECT * FROM invites WHERE event_id = ?');
    $getInvites->execute(array($curEvtId));
    $getInvitesData = $getInvites->fetch();
    
    $replace = str_replace(',', " ", $getInvitesData['invites']);
    
    $invitesObj = explode(" ", $replace);
    
    $count_invitesObj = count($invitesObj);
    
    $invitesStatus = 'checked';
    
    for ($i = 0; $i < $count_invitesObj; $i++) {
        
        if ($_POST[$status] == $invitesObj[$i]) {
            
            $invitesStatus = "checked";
            
        } else {
            
            $invitesStatus = "";
            
        }
        
    }
    
    return $invitesStatus;
    
}


?>

<div class="editEventCont">

	<div class="editEventHeader">

		<img src="../jarvis/public/media/events/eventleft.svg" alt="" id="backToEvent">
		<h2>Edit event <?php echo $getEvtData['name']; ?></h2>
		<h3 id="editNewEvent">Save</h3>

	</div>

	<div class="editEventBody">

		<form class="editEventForm" action="">
			<input type="hidden" name="" id="eventId" placeholder="" value="<?php echo $curEvtId; ?>">

			<div class="inputsCont">

				<label for="">Name</label>
				<input type="text" name="" id="eventName" placeholder="" value="<?php echo $getEvtData['name']; ?>">

			</div>


			<div class="inputsCont">

				<label for="">Location</label>
				<input type="text" name="" id="eventLocation" placeholder=""
					   value="<?php echo $getEvtData['location']; ?>">

			</div>

			<div class="inputsCont dateTime" id="space">

				<label for="">Starts</label>
				<input type="text" name="" id="eventStart" placeholder=""
					   value="<?php echo $getEvtData['start_date']; ?>">
				<input type="text" name="" id="eventTimeStart" placeholder=""
					   value="<?php echo $getEvtData['start_time']; ?>">

			</div>

			<div class="inputsCont dateTime">

				<label for="">Ends</label>
				<input type="text" name="" id="eventEnd" placeholder="" value="<?php echo $getEvtData['end_date']; ?>">
				<input type="text" name="" id="eventTimeEnd" placeholder="End time"
					   value="<?php echo $getEvtData['end_time']; ?>">

			</div>

			<div class="inputsCont" id="allDays">
                
                <?php
                
                if ($getEvtData['all_day'] == "allday") {
                    
                    ?>

					<input type="checkbox" name="" id="allDay" placeholder="" value="1" checked>
					<label for="allDay">All day</label>
                    
                    <?php
                    
                } else {
                    
                    ?>

					<input type="checkbox" name="" id="allDay" placeholder="" value="1">
					<label for="allDay">All day</label>
                    
                    <?php
                    
                }
                
                ?>

			</div>


			<div class="inputsCont">

				<label for="">Alert</label>
				<input type="text" name="" id="alert" placeholder="">

			</div>

		</form>

	</div>

	<div class="editEventFooter">

		<p>Who is participating?</p>
		<div class="invited">

			<div class="inputsInvited">

				<p style="color: red;"><label><input type="checkbox" name="invitees[]" class="invitedCheckbox"
													 value="1" checked disabled> me</label></p>

			</div>
            
            <?php
            $users = $model->prepare("SELECT *
									  FROM users
									  WHERE user_id != 1
									  ORDER BY `firstname`", []);
            
            $getInvites     = $model->prepare('SELECT * FROM invites WHERE event_id = ?', [$curEvtId]);
            $getInvitesData = array_column($getInvites->fetchAll(), 'user_id');
            foreach ($users->fetchAll(PDO::FETCH_ASSOC) as $user) {
                $checked = '';
                if (in_array($user['user_id'], $getInvitesData) === true) {
                    $checked = ' checked';
                }
                ?>
				<div class="inputsInvited">

					<p style="color: <?= $user['color'] ?>;">
						<label><input type="checkbox" name="invitees[]"
									  class="invitedCheckbox"
									  value="<?= $user['user_id'] ?>"<?= $checked ?>> <?= $user['firstname'] ?>
						</label>
					</p>

				</div>
                <?php
            }
            ?>

		</div>

		<p>Is this a private event?</p>
		<div class="private_event">
			<p><label><input type="checkbox" name="private" class="privateEvent" id="private"
							 value="1"<?= $getEvtData['private'] == '1' ? ' checked' : '' ?>> Yes</label></p>
		</div>

	</div>

</div>


<style media="screen">

	.editEventCont {

		width: 100%;
		height: 100%;
		display: flex;
		flex-direction: column;
		justify-content: space-around;
		align-items: center;

	}

	.editEventHeader {

		width: 90%;
		height: 15%;
		display: flex;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;

	}

	.editEventHeader img {

		width: 20px;
		height: 20px;
		cursor: pointer;

	}

	.editEventHeader img:hover {

		transition: transform 0.2s linear 0s;
		transform: scale(1.2, 1.2);

	}

	.editEventHeader h2 {

		text-align: center;
		color: #F65F59;

	}

	#editNewEvent {

		text-align: center;
		color: #F65F59;
		cursor: pointer;

	}

	#editNewEvent:hover {

		transition: transform 0.2s linear 0s;
		transform: scale(1.2, 1.2);

	}

	.editEventBody {

		width: 100%;
		height: 55%;
		display: flex;
		justify-content: flex-end;
		align-items: flex-end;

	}

	.editEventForm {

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

		pediting: 20px;

	}

	#allDays input, #allDays label {

		width: auto;
		height: auto;

	}

	.editEventFooter {

		width: 90%;
		height: 30%;
		display: flex;
		flex-direction: column;
		justify-content: flex-start;
		align-items: flex-start;

	}

	.editEventFooter p {

		font-size: 16px;
		text-align: left;
		color: #2D3C77;
		margin-bottom: 5px;
		width: 50%;
		height: auto;

	}

	.invited {

		width: 100%;
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		justify-content: flex-start;
		align-content: flex-start;

	}

	.inputsInvited {

		width: 25%;
		height: auto;
		display: flex;
		justify-content: flex-start;
		align-content: flex-start;
		align-items: center;

	}

	.inputsInvited p {

		margin-left: 5px;
		color: #2D3C77;
		font-size: 17px;
		position: relative;
		bottom: 5px;

	}

</style>
