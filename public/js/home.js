$(function () {

	var current_mode = 'collective',
		allowed_modes = ['open', 'collective', 'private'],
		current_page = '',
		last_event = '';
	Cookies.set('filter', '', {path: ''});
	Cookies.set('current_mode', current_mode, {path: ''});

	backToHome();
	changeUser();

	function is_touch_device() {
		return 'ontouchstart' in window        // works on most browsers
			|| navigator.maxTouchPoints;       // works on IE10/11 and Surface
	}

	document.ontouchmove = function (event) {
		event.preventDefault();
	};

	function changeUser() {

		var receiver = document.querySelector('.users');
		var tempName = 'users';
		var xhr = Utils.initXHR();


		xhr.onreadystatechange = function () {

			if (this.readyState == 4 && this.status == 200) {

				receiver.innerHTML = xhr.responseText;

				//alert(xhr.responseText);

			}

		};


		xhr.open('GET', '../jarvis/site/views/templates/appTemplates/' + tempName + '.php', true);
		xhr.send();

	}

	$(document).on('click', '#backToHome', backToHome);

	function backToHome(e) {
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

	$(document).on('click', '#backToEvent', backToEvent);

	function backToEvent(e) {
		current_page = 'backToHome';

		var button = $(e.target);
		var day = button.data('day');
		var month = button.data('month');

		var tempName = "displayEvent";
		var receiver = document.querySelector('.agenda');
		var xhr = Utils.initXHR();

		xhr.onreadystatechange = function () {

			if (this.readyState === 4 && this.status === 200) {

				receiver.innerHTML = xhr.responseText;
				EventsTemplate.displayEvents(day, month);


			}

		};

		xhr.open('GET', '../jarvis/site/views/templates/appTemplates/' + tempName + '.php', true);
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

	$(document).on('click', '#resetFilter', resetFilter);

	function resetFilter(e) {
		$('.owner').find('span').removeClass('filterActive');

		Cookies.set('filter', '', {path: ''});

		eval(current_page + "()");
	}

	$(document).on('click', '.owner', filterOwner);

	function filterOwner(e) {
		var target = $(e.currentTarget);

		if (target.find('span').hasClass('filterActive')) {
			$('.owner').find('span').removeClass('filterActive');

			Cookies.set('filter', '', {path: ''});
		} else {
			$('.owner').find('span').removeClass('filterActive');
			target.find('span').addClass('filterActive');

			Cookies.set('filter', target.data('id'), {path: ''});
		}

		eval(current_page + "()");

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

	var CanvasDrawr = function (options) {
		var canvas = document.getElementById(options.id), ctxt = canvas.getContext("2d");
		ctxt.lineWidth = options.size || Math.ceil(Math.random() * 35);
		ctxt.lineCap = options.lineCap || "round";
		ctxt.pX = undefined;
		ctxt.pY = undefined;
		var lines = [, ,];
		var offset = $(canvas).offset();
		var self = {
			init: function () {
				canvas.addEventListener('touchstart', self.preDrawTouch, false);
				canvas.addEventListener('touchmove', self.drawTouch, false);
			}, preDrawTouch: function (event) {
				$.each(event.touches, function (i, touch) {
					var id = touch.identifier;
					lines[id] = {x: this.pageX - offset.left, y: this.pageY - offset.top};
				});
				event.preventDefault();
			}, drawTouch: function (event) {
				$.each(event.touches, function (i, touch) {
					var id = touch.identifier, moveX = this.pageX - offset.left - lines[id].x,
						moveY = this.pageY - offset.top - lines[id].y;
					var ret = self.move(id, moveX, moveY);
					lines[id].x = ret.x;
					lines[id].y = ret.y;
				});
				event.preventDefault();
			}, move: function (i, changeX, changeY) {
				ctxt.strokeStyle = 'black';
				ctxt.beginPath();
				ctxt.moveTo(lines[i].x, lines[i].y);
				ctxt.lineTo(lines[i].x + changeX, lines[i].y + changeY);
				ctxt.stroke();
				ctxt.closePath();
				return {x: lines[i].x + changeX, y: lines[i].y + changeY};
			}
		};
		return self.init();
	};

	var addNote = $("#addNote"),
		canvas;
	addNote.hover(function () {
			$(this).attr('src', 'public/media/notes/new_note_hover.png');
		},
		function () {
			$(this).attr('src', 'public/media/notes/new_note.png');
		});
	addNote.click(function () {
		$.blockUI({
			message: $('#note'),
			css: {
				backgroundColor: '#eabc31',
				color: '#fff',
				border: '',
				top: '30%',
				width: '450px'
			},
			overlayCSS: {
				cursor: 'default'
			},
			onBlock: function () {
				canvas = new CanvasDrawr({id: "draw_note", size: 2});
			},
			onOverlayClick: $.unblockUI,
			onUnblock: saveNote
		});
	});

	$(document).on('click', '#saveNote', saveNote);
	function saveNote() {

	}

	$("#micro").click(function () {

		$('#audiowaves').addClass('active');

		setTimeout(function () {
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
			changeUser();
			Cookies.set('current_mode', 'private', {path: ''});
			current_mode = 'private';
			eval(current_page + "()");
		}
		else if (response.action === 'collective') {
			console.log('collective');
			current_mode_span.html('collective');
			$('.background').css({'background-image': "url('public/media/backgrounds/collective_mode.png')"})
				.animate({opacity: 1}, {duration: 750});
			changeUser();
			Cookies.set('current_mode', 'collective', {path: ''});
			current_mode = 'collective';
			console.log(current_page);
			eval(current_page + "()");
		}
		else if (response.action === 'goodbye') {
			console.log('goodbye');
			current_mode_span.html('open');
			$('.background').css({'background-image': ""})
				.animate({opacity: 0}, {duration: 750});
			changeUser();
			Cookies.set('current_mode', 'open', {path: ''});
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
