<?php

require "../../../models/home_model.php";

$calendar = new Calendar();
?>

<div class="agendaHeader">

	<img src="../jarvis/public/media/events/eventleft.svg" alt="" id="backToHome">
	<h3>Events</h3>
    <?php
    if (isset($_COOKIE['current_mode']) && $_COOKIE['current_mode'] !== 'open') {
        ?>
		<img src="../jarvis/public/media/events/addevent.svg" alt="" id="addEvents">
        <?php
    }
    ?>

</div>

<div class="agendaBody">


</div>

<div class="agendaFooter">

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

</div>

<style media="screen">

	.evtCont {

		width: 100%;
		height: 100%;
		display: flex;
		flex-direction: column;
		justify-content: space-around;
		align-items: center;

	}

	.evtHeader {

		width: 90%;
		height: 15%;
		display: flex;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;

	}

	.evtHeader img {

		width: 20px;
		height: 20px;
		cursor: pointer;

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

	.evtDetails {

		height: 90%;
		width: 100%;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;

	}

	.evtCont {

		width: 90%;
		height: auto;
		border: 1px solid #F65F59;
		border-radius: 3px;
		background-color: #F65F59;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		cursor: pointer;
		margin-bottom: 20px;

	}

	.evtCont h3 {

		color: white;
		text-align: center;
		width: 100%;
		height: 80%;

	}

	.evtDateTime {

		width: 100%;
		height: 20%;
		display: flex;
		flex-direction: row;
		justify-content: center;

	}

	.evtDateTime p {

		color: white;
		text-align: center;
		font-size: 15px;

	}


</style>
