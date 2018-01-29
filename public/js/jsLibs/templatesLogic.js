EventsTemplate = {

	checkBoxs: function (target) {

		var boxs = document.querySelectorAll('.' + target);
		var boxsArr = [];
		for (var i = 0; i < boxs.length; i++) {

			var boxArr = boxs[i];

			var boxValue = boxArr.value;
			if (boxArr.checked && !boxArr.disabled) {

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
		var eventPrivate = document.getElementById("private");
		var allDay = document.getElementById("allDay");
		var allDayVal, eventPrivateVal;

		if (allDay.checked) {

			allDayVal = '1';
			eventTimeStart = '00:00';
			eventTimeEnd = '00:00';

		} else {

			allDayVal = '0';

		}

		if (eventPrivate.checked) {

			eventPrivateVal = '1';

		} else {

			eventPrivateVal = '0';

		}


		var invites = EventsTemplate.checkBoxs('invitedCheckbox');

		var xhr = Utils.initXHR();


		xhr.onreadystatechange = function () {

			if (this.readyState == 4 && this.status == 200) {

				//receiver.innerHTML = xhr.responseText;
				alert(xhr.responseText);
				//Utils.goHomeEvent();

				var eventStartDay = eventStart.substr(0, 2);
				var eventStartMonth = eventStart.substr(3, 2);

				$.ajax('site/models/eventHome.php')
					.done(function (data) {
						$('.agenda').html(data);
						EventsTemplate.displayEvents(eventStartDay, eventStartMonth)
					});

			}

		};

		if (eventName !== "" && eventStart !== "" && eventEnd !== "" && eventTimeStart !== "" && eventTimeEnd !== "") {

			xhr.open('GET', '../jarvis/site/models/ajax_requests/addEvent.php?eventName=' + eventName + '&eventLocation=' + eventLocation + '&eventStart=' + eventStart + '&eventEnd=' + eventEnd + '&eventTimeStart=' + eventTimeStart + '&eventTimeEnd=' + eventTimeEnd + '&private=' + eventPrivateVal + '&allDayVal=' + allDayVal + '&invites=' + JSON.stringify(invites), true);
			xhr.send();

		} else {

			alert("You have to fill all the fields...");

		}


	},


	displayEvents: function (dateNumb, curMonth) {

		var xhr = Utils.initXHR();
		var months_name = ['', 'January', 'Februari', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'Oktober', 'November', 'December'];
		var parsedCurMonth;

		if (curMonth.length === 2) {
			parsedCurMonth = curMonth
		}
		else {
			if (months_name.indexOf(curMonth) < 10) {

				parsedCurMonth = '0' + months_name.indexOf(curMonth);

			} else {

				parsedCurMonth = months_name.indexOf(curMonth);

			}
		}

		xhr.onreadystatechange = function () {

			if (this.readyState == 4 && this.status == 200) {

				var results = xhr.responseText;
				var evtDetails = document.querySelector('.agendaBody');

				$('#addEvents').data('date', dateNumb + '-' + parsedCurMonth + '-2018');

				evtDetails.innerHTML = results;

				$('.event').each(function (i, el) {
					if (parseInt($(el).data('id')) > 0) {
						$(el).click(function () {
							var eventId = $(el).data('id');
							EventsTemplate.displayEventTemplate(eventId);
						});
					}
				});

				document.getElementsByClassName('scrollablediv')[0].scrollTop = 400;

			}


		};

		xhr.open('GET', '../jarvis/site/models/ajax_requests/displayEvents.php?dateNumb=' + dateNumb + '&curMonth=' + parsedCurMonth, true);
		xhr.send();

	},


	displayEventTemplate: function (eventId) {

		var xhr = Utils.initXHR();
		var tempName = "eventsDetails";
		var receiver = document.querySelector('.agenda');

		xhr.onreadystatechange = function () {

			if (this.readyState == 4 && this.status == 200) {

				receiver.innerHTML = xhr.responseText;


				EventsTemplate.displayEventContent(eventId);


			}

		};


		xhr.open('GET', '../jarvis/site/views/templates/appTemplates/' + tempName + '.php', true);
		xhr.send();

	},


	displayEventContent: function (eventId) {

		var xhr = Utils.initXHR();

		xhr.onreadystatechange = function () {

			if (this.readyState == 4 && this.status == 200) {

				var evtContent = document.querySelector('.evtContent');
				evtContent.innerHTML = xhr.responseText;

				EventsTemplate.editEvent();
				EventsTemplate.deleteEvent(eventId);

			}

		};

		xhr.open('GET', '../jarvis/site/models/ajax_requests/displayEventsContent.php?eventId=' + eventId, true);
		xhr.send();

	},


	editEvent: function () {

		$("#editEvent").click(function (e) {

			var tempName = "editEvent";
			var receiver = document.querySelector('.agenda');
			var xhr = Utils.initXHR();

			var curEvtId = $('.evtDisplayBody').attr('data-id');

			xhr.onreadystatechange = function () {

				if (this.readyState == 4 && this.status == 200) {

					receiver.innerHTML = xhr.responseText;

					EventsTemplate.eventNewData();// update function

				}

			};

			xhr.open('GET', '../jarvis/site/views/templates/appTemplates/' + tempName + '.php?curEvtId=' + curEvtId, true);
			xhr.send();


		})

	},


	eventNewData: function () {


		$('#editNewEvent').click(function () {

			var eventId = document.getElementById("eventId").value;
			var eventName = document.getElementById("eventName").value;
			var eventLocation = document.getElementById("eventLocation").value;
			var eventStart = document.getElementById("eventStart").value;
			var eventEnd = document.getElementById("eventEnd").value;
			var eventTimeStart = document.getElementById("eventTimeStart").value;
			var eventTimeEnd = document.getElementById("eventTimeEnd").value;
			var eventPrivate = document.getElementById("private");
			var allDay = document.getElementById("allDay");
			var allDayVal, eventPrivateVal;

			if (allDay.checked) {

				allDayVal = '1';
				eventTimeStart = '00:00';
				eventTimeEnd = '00:00';

			} else {

				allDayVal = '0';

			}

			if (eventPrivate.checked) {

				eventPrivateVal = '1';

			} else {

				eventPrivateVal = '0';

			}

			var invites = EventsTemplate.checkBoxs('invitedCheckbox');

			var xhr = Utils.initXHR();


			xhr.onreadystatechange = function () {

				if (this.readyState === 4 && this.status === 200) {

					alert(xhr.responseText);

					var eventStartDay = eventStart.substr(0, 2);
					var eventStartMonth = eventStart.substr(3, 2);

					$.ajax('site/models/eventHome.php')
						.done(function (data) {
							$('.agenda').html(data);
							EventsTemplate.displayEvents(eventStartDay, eventStartMonth)
						});

				}

			};


			if (eventName !== "" && eventStart !== "" && eventEnd !== "" && eventTimeStart !== "" && eventTimeEnd !== "") {

				xhr.open('GET', '../jarvis/site/models/ajax_requests/updateEvent.php?eventId=' + eventId + '&eventName=' + eventName + '&eventLocation=' + eventLocation + '&eventStart=' + eventStart + '&eventEnd=' + eventEnd + '&eventTimeStart=' + eventTimeStart + '&eventTimeEnd=' + eventTimeEnd + '&private=' + eventPrivateVal + '&allDayVal=' + allDayVal + '&invites=' + JSON.stringify(invites), true);
				xhr.send();

			} else {

				alert("You have to fill in all the fields");

			}

		})

	},

	deleteEvent: function (evtId) {

		$("#deleteEvt").click(function () {

			var eventStartDay = $(this).data('day');
			var eventStartMonth = $(this).data('month');

			if (confirm('Are you sure that you want to delete this event?')) {

				var xhr = Utils.initXHR();

				xhr.onreadystatechange = function () {

					if (this.readyState == 4 && this.status == 200) {

						alert(xhr.responseText);

						$.ajax('site/models/eventHome.php')
							.done(function (data) {
								$('.agenda').html(data);
								EventsTemplate.displayEvents(eventStartDay, eventStartMonth)
							});

					}

				};


				xhr.open('GET', '../jarvis/site/models/ajax_requests/deleteEvent.php?curEvtId=' + evtId, true);
				xhr.send();

			}

		});

	}

};
