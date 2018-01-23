<?php

require '../../../models/ajax_requests/pdo_connection.php';

$pdo = pdo();
// $dateTime = new DateTime();
// $dayNow = $dateTime->format('j').'-'.date('m').'-'.$dateTime->format('Y');
//$timeNow = $dateTime->format('H').":".$dateTime->format('i');

$curEvtName = htmlentities(htmlspecialchars($_GET['curEvtName']));

$getCurEvt = $pdo->prepare("SELECT * FROM events WHERE name=?");
$getCurEvt->execute(array($curEvtName));
$getEvtData = $getCurEvt->fetch();


function invitesStatus($status)
{
    
    $pdo        = pdo();
    $curEvtName = htmlentities(htmlspecialchars($_GET['curEvtName']));
    
    
    $getInvites = $pdo->prepare('SELECT * FROM invites WHERE event_name=?');
    $getInvites->execute(array($curEvtName));
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

		<img src="../jarvis/public/media/events/eventleft.svg" alt="" id="editBackToEvent">
		<h2>New Event</h2>
		<h3 id="editNewEvent">Edit</h3>

	</div>

	<div class="editEventBody">

		<form class="editEventForm" action="" method="">

			<div class="inputsCont">

				<label for="">Name</label>
				<input type="text" name="" id="eventName" placeholder="" value="<?php echo $curEvtName; ?>">

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

					<input type="checkbox" name="" id="allDay" placeholder="" value="allday" checked>
					<label for="">All day</label>
                    
                    <?php
                    
                } else {
                    
                    {
                        
                        ?>

						<input type="checkbox" name="" id="allDay" placeholder="" value="allday">
						<label for="">All day</label>
                        
                        <?php
                        
                    }
                    
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

		<p>Invite</p>
		<form action="" method="post" class="invited">

			<div class="inputsInvited">

				<input type="checkbox" name="sanne" class="invitedCheckbox" value="Sanne" id="sanne">
				<p>Sanne</p>

			</div>

			<div class="inputsInvited">

				<input type="checkbox" name="everyone" class="invitedCheckbox" value="Everyone" id="everyone">
				<p>Everyone</p>

			</div>

			<div class="inputsInvited">

				<input type="checkbox" name="alberto" class="invitedCheckbox" value="Alberto" id="alberto">
				<p>Alberto</p>

			</div>

		</form>

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

		width: 300px;
		height: 100%;
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		justify-content: flex-start;
		align-content: flex-start;

	}

	.inputsInvited {

		width: 150px;
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
