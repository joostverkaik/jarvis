EventsTemplate = {


	checkBoxs: function (target) {

		var boxs = document.querySelectorAll('.' + target);
		var boxsArr = [];
		for (var i = 0; i < boxs.length; i++) {

			var boxArr = boxs[i];

			var boxValue = boxArr.value;
			if (boxArr.checked) {

				boxsArr.push(boxValue);

			} else {

				boxsArr.slice(boxsArr.indexOf(boxValue), 1);

			}

		}
		return boxsArr;

	},


	addEvents: function () {

		var eventName = document.getElementById("eventName").value;
		var eventLocation = document.getElementById("eventLocation").value;
		var eventStart = document.getElementById("eventStart").value;
		var eventEnd = document.getElementById("eventEnd").value;
		var eventTimeStart = document.getElementById("eventTimeStart").value;
		var eventTimeEnd = document.getElementById("eventTimeEnd").value;
		var allDay = document.getElementById("allDay");
		var allDayVal;

		//var dayStart = eventStartD.slice(0,2);
		//var dayEnd = eventEndD.slice(0,2);

		//var curYearStart = eventStartD.slice(6,10);
		//var curYearEnd = eventEndD.slice(6,10);


		// var eventStartS = Utils.parse_month(Utils.singleNumber(eventStartD));
		//var eventEndS = Utils.parse_month(Utils.singleNumber(eventEndD));

		//var = eventStart = dayStart+'-'+eventStartS+'-'+curYearStart;
		//var = eventEnd = dayEnd+'-'+eventEndS+'-'+curYearEnd;


		if (allDay.checked) {

			allDayVal = '1';

		} else {

			allDayVal = '0';

		}

		var invites = EventsTemplate.checkBoxs('invitedCheckbox');

		var xhr = Utils.initXHR();


		xhr.onreadystatechange = function () {

			if (this.readyState == 4 && this.status == 200) {

				//receiver.innerHTML = xhr.responseText;
				alert(xhr.responseText);
				Utils.goHomeEvent();

			}

		};


		if (eventName != "" && eventLocation != "" && eventStart != "" && eventEnd != "" && eventTimeStart != "" && eventTimeEnd != "") {

			xhr.open('GET', '../jarvis/site/models/ajax_requests/addEvent.php?eventName=' + eventName + '&eventLocation=' + eventLocation + '&eventStart=' + eventStart + '&eventEnd=' + eventEnd + '&eventTimeStart=' + eventTimeStart + '&eventTimeEnd=' + eventTimeEnd + '&allDayVal=' + allDayVal + '&invites=' + invites, true);
			xhr.send();

		} else {

			alert("You have to fill all the fields...");

		}


	},


	displayEvents: function (dateNumb, curMonth) {

		var xhr = Utils.initXHR();
		var months_name = ['', 'January', 'Februari', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'Oktober', 'November', 'December'];
		var parsedCurMonth;

		if (months_name.indexOf(curMonth) < 10) {

			parsedCurMonth = '0' + months_name.indexOf(curMonth);

		} else {

			parsedCurMonth = months_name.indexOf(curMonth);

		}


		xhr.onreadystatechange = function () {

			if (this.readyState == 4 && this.status == 200) {

				var results = xhr.responseText;
				var evtDetails = document.querySelector('.evtDetails');

				$('#addEvents').data('date', dateNumb + '-' + parsedCurMonth);

				evtDetails.innerHTML = results;

				var evtCont = document.querySelectorAll('.evtCont');

				for (var i = 0; i < evtCont.length; i++) {

					var evtContArr = evtCont[i];

					evtContArr.addEventListener('click', function (e) {

						var eventName = e.currentTarget.childNodes[1].textContent;
						EventsTemplate.displayEventTemplate(eventName);

					})

				}

			}

		};

		xhr.open('GET', '../jarvis/site/models/ajax_requests/displayEvents.php?dateNumb=' + dateNumb + '&curMonth=' + parsedCurMonth, true);
		xhr.send();

	},


	displayEventTemplate: function (eventName) {

		var xhr = Utils.initXHR();
		var tempName = "eventsDetails";
		var receiver = document.querySelector('.agenda');

		xhr.onreadystatechange = function () {

			if (this.readyState == 4 && this.status == 200) {

				receiver.innerHTML = xhr.responseText;


				EventsTemplate.displayEventContent(eventName);


			}

		};


		xhr.open('GET', '../jarvis/site/views/templates/appTemplates/' + tempName + '.php', true);
		xhr.send();

	},


	displayEventContent: function (eventName) {

		var xhr = Utils.initXHR();

		xhr.onreadystatechange = function () {

			if (this.readyState == 4 && this.status == 200) {

				var evtContent = document.querySelector('.evtContent');
				evtContent.innerHTML = xhr.responseText;

				EventsTemplate.editEvent();
				EventsTemplate.deleteEvent(eventName);

			}

		};

		xhr.open('GET', '../jarvis/site/models/ajax_requests/displayEventsContent.php?eventName=' + eventName, true);
		xhr.send();

	},


	editEvent: function () {

		$("#editEvent").click(function (e) {

			var tempName = "editEvent";
			var receiver = document.querySelector('.agenda');
			var xhr = Utils.initXHR();

			var curEvtName = e.currentTarget.parentNode.parentNode.childNodes[3].childNodes[1].textContent;

			xhr.onreadystatechange = function () {

				if (this.readyState == 4 && this.status == 200) {

					receiver.innerHTML = xhr.responseText;

					EventsTemplate.eventNewData();// update function

				}

			};


			xhr.open('GET', '../jarvis/site/views/templates/appTemplates/' + tempName + '.php?curEvtName=' + curEvtName, true);
			xhr.send();

		})

	},


	eventNewData: function () {


		$('#editNewEvent').click(function () {

			var eventName = document.getElementById("eventName").value;
			var eventLocation = document.getElementById("eventLocation").value;
			var eventStart = document.getElementById("eventStart").value;
			var eventEnd = document.getElementById("eventEnd").value;
			var eventTimeStart = document.getElementById("eventTimeStart").value;
			var eventTimeEnd = document.getElementById("eventTimeEnd").value;
			var allDay = document.getElementById("allDay");
			var allDayVal;

			if (allDay.checked) {

				allDayVal = '1';

			} else {

				allDayVal = '0';

			}


			var invites = EventsTemplate.checkBoxs('invitedCheckbox');

			var xhr = Utils.initXHR();


			xhr.onreadystatechange = function () {

				if (this.readyState == 4 && this.status == 200) {

					//receiver.innerHTML = xhr.responseText;
					alert(xhr.responseText);
					// Utils.goHomeEvent();

				}

			};


			if (eventName != "" && eventLocation != "" && eventStart != "" && eventEnd != "" && eventTimeStart != "" && eventTimeEnd != "") {

				xhr.open('GET', '../jarvis/site/models/ajax_requests/updateEvent.php?eventName=' + eventName + '&eventLocation=' + eventLocation + '&eventStart=' + eventStart + '&eventEnd=' + eventEnd + '&eventTimeStart=' + eventTimeStart + '&eventTimeEnd=' + eventTimeEnd + '&allDayVal=' + allDayVal + '&invites=' + invites, true);
				xhr.send();

			} else {

				alert("You have to fill all the fields...");

			}

		})

	},


	deleteEvent: function (evtName) {

		$("#deleteEvt").click(function () {

			var xhr = Utils.initXHR();

			xhr.onreadystatechange = function () {

				if (this.readyState == 4 && this.status == 200) {

					alert(xhr.responseText);

				}

			};


			xhr.open('GET', '../jarvis/site/models/ajax_requests/deleteEvent.php?curEvtName=' + evtName, true);
			xhr.send();

		})

	}

}
