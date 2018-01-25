$(function () {

	var current_mode = 'open',
		allowed_modes = ['open', 'collective', 'private'],
		current_page = '',
		last_event = '';
	Cookies.set('current_mode', 'open', { path: '' });

	backToHome();

	$(document).on('click', '#backToEvent', backToHome);
	function backToHome() {
		current_page = 'backToHome';

		var receiver = document.querySelector('.agenda');
		var tempName = 'eventHome';
		var xhr = Utils.initXHR();


		xhr.onreadystatechange = function () {

			if (this.readyState == 4 && this.status == 200) {

				receiver.innerHTML = xhr.responseText;

				//alert(xhr.responseText);

			}

		};


		xhr.open('GET', '../jarvis/site/models/' + tempName + '.php', true);
		xhr.send();

	}

	$(document).on('click', "#addEvents", addEvent);
	function addEvent(e) {
		current_page = 'addEvent';
		if (last_event != e && typeof e !== 'undefined') {
			last_event = e;
		}
		var tempName = e.target.id;
		var receiver = document.querySelector('.agenda');
		$('.agendaHeader').hide('slow');

		var xhr = Utils.initXHR();

		xhr.onreadystatechange = function () {

			if (this.readyState === 4 && this.status === 200) {

				receiver.innerHTML = xhr.responseText;

				var addNewEvent = document.querySelector('.agenda #addNewEvent');
				addNewEvent.addEventListener('click', EventsTemplate.addEvents);

			}

		};

		if (typeof $(this).data('date') !== 'undefined') {
			xhr.open('GET', '../jarvis/site/views/templates/appTemplates/' + tempName + '.php?date=' + $(this).data('date'), true);
		}
		else {
			xhr.open('GET', '../jarvis/site/views/templates/appTemplates/' + tempName + '.php', true);
		}
		xhr.send();
	}


	$(document).on('click', '.daysNumb', showDay);
	function showDay(e) {
		current_page = 'showDay';
		if (last_event != e && typeof e !== 'undefined') {
			last_event = e;
		}

		var tempName = "displayEvent";
		var receiver = document.querySelector('.agenda');
		var xhr = Utils.initXHR();

		xhr.onreadystatechange = function () {

			if (this.readyState === 4 && this.status === 200) {

				receiver.innerHTML = xhr.responseText;

				var dateNumb = last_event.currentTarget.childNodes[1].textContent;
				var curMonth = last_event.currentTarget.childNodes[1].className;

				EventsTemplate.displayEvents(dateNumb, curMonth);


			}

		};


		xhr.open('GET', '../jarvis/site/views/templates/appTemplates/' + tempName + '.php', true);
		xhr.send();

	}

	$(document).on('click', '.whiteBlock', function (e) {

		var tempName = 'addEvents';
		var receiver = document.querySelector('.agenda');
		$('.agendaHeader').hide('slow');

		var xhr = Utils.initXHR();

		xhr.onreadystatechange = function () {

			if (this.readyState === 4 && this.status === 200) {

				receiver.innerHTML = xhr.responseText;

				var addNewEvent = document.querySelector('.agenda #addNewEvent');
				addNewEvent.addEventListener('click', EventsTemplate.addEvents);

			}

		};

		if (typeof $(this).data('date') !== 'undefined') {
			xhr.open('GET', '../jarvis/site/views/templates/appTemplates/' + tempName + '.php?date=' + $(this).data('date'), true);
		}
		else {
			xhr.open('GET', '../jarvis/site/views/templates/appTemplates/' + tempName + '.php', true);
		}
		xhr.send();

	});

	$(document).on('focus', '#eventStart,#eventEnd', function () {
		$(this).pickadate({
			format: 'dd-mm-yyyy',
			clear: false
		});
	});
	$(document).on('change', '#eventStart', function () {
		$('#eventEnd').val($(this).val());
	});

	$(document).on('focus', '#eventTimeStart,#eventTimeEnd', function () {
		$(this).pickatime({
			format: 'HH:i'
		});
	});
	$(document).on('change', '#eventTimeStart', function () {
		if ($(this).val() !== '') {
			var hour = parseInt($(this).val().substring(0, 2));
			var minute = $(this).val().substring(3, 5);
			$('#eventTimeEnd').val((hour + 1) + ":" + minute);
		}
		else {
			$('#eventTimeEnd').val('');
		}
	});

	$(document).on('change', '#allDay', function () {
		if (this.checked) {
			$('#eventTimeStart,#eventTimeEnd').prop('disabled', true);
			$('#eventTimeStart,#eventTimeEnd').animate({
					color: '#ccc'
				},
				250);
		}
		else {
			$('#eventTimeStart,#eventTimeEnd').prop('disabled', false);
			$('#eventTimeStart,#eventTimeEnd').animate({
					color: '#2D3C77'
				},
				250);
		}
	});

	$("#micro").click(function () {

		$('#audiowaves').addClass('active');

		setTimeout(function() {
			/*var url = '';
			if (current_mode === 'open') {
				url = "https://api.dialogflow.com/v1/query?v=20170712&query=go%20collective&lang=en&sessionId=feef5c41-7c1a-42ce-b7d7-8f4b1429ed0d&timezone=Europe/Amsterdam";
				current_mode = 'collective';
			}
			else if (current_mode === 'collective') {
				url = "https://api.dialogflow.com/v1/query?v=20170712&query=go%20private&lang=en&sessionId=feef5c41-7c1a-42ce-b7d7-8f4b1429ed0d&timezone=Europe/Amsterdam";
				current_mode = 'private';
			}
			else if (current_mode === 'private') {
				url = "https://api.dialogflow.com/v1/query?v=20170712&query=I'm%20done&lang=en&sessionId=feef5c41-7c1a-42ce-b7d7-8f4b1429ed0d&timezone=Europe/Amsterdam";
				current_mode = 'open';
			}

			$.ajax(url, {
				beforeSend: function (xhr) {
					xhr.setRequestHeader("Authorization", "Bearer 508906854a4b43e387ba73b458951b42");
				},
				type: 'GET',
				dataType: 'json',
				contentType: 'application/json',
				processData: false
			});*/
		}, 2000);
	});

	var socket = new WebSocket("ws://joostverkaik.nl:8080/");
	var current_mode_span = $('.current_mode'),
		body = $('.background');

	socket.onmessage = function (msg) {
		var response = JSON.parse(msg.data);
		console.log(response);
		$('#audiowaves').removeClass('active');

		if (response.action === 'private') {
			console.log('private');
			current_mode_span.html('private');
			$('.background').css({'background-image': "url('public/media/backgrounds/private_mode.png')"})
					.animate({opacity: 1}, {duration: 750});
			Cookies.set('current_mode', 'private', { path: '' });
			current_mode = 'private';
			eval(current_page + "()");
		}
		else if (response.action === 'collective') {
			console.log('collective');
			current_mode_span.html('collective');
			$('.background').css({'background-image': "url('public/media/backgrounds/collective_mode.png')"})
					.animate({opacity: 1}, {duration: 750});
			Cookies.set('current_mode', 'collective', { path: '' });
			current_mode = 'collective';
			console.log(current_page);
			eval(current_page + "()");
		}
		else if (response.action === 'goodbye') {
			console.log('goodbye');
			current_mode_span.html('open');
			$('.background').css({'background-image': ""})
					.animate({opacity: 0}, {duration: 750});
			Cookies.set('current_mode', 'open', { path: '' });
			current_mode = 'open';
			eval(current_page + "()");
		}
		else if (response.action === 'weather') {
			console.log('weather');

		}
		else {
			console.log('unknown response');
		}

	};

});
