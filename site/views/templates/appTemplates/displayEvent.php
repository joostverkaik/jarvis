<div class="evtHeader">

	<img src="../jarvis/public/media/events/eventleft.svg" alt="" id="backToEvent">
	<h2>Events</h2>
	<img src="../jarvis/public/media/events/addevent.svg" alt="" id="addEvents">

</div>

<div class="evtDetails">


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

	.evtCont:hover {

		transition: transform 0.3 linear 0s;
		transform: scale(0.9, 0.9);

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
		justify-content: space-around;
		justify-content: center;

	}

	.evtDateTime p {

		color: white;
		text-align: center;
		font-size: 15px;

	}


</style>
