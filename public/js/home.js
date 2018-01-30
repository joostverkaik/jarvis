$(function () {

	var current_mode = 'open',
		current_page = '',
		last_event = '';
	Cookies.set('filter', '', {path: ''});
	Cookies.set('current_mode', current_mode, {path: ''});

	backToHome();
	changeUser();

	/* Weather */
	$(".weatherInfo").dragend({
		direction: 'horizontal'
	});
	setInterval(function () {
		var date = new Date;

		var minutes = Utils.pad(date.getMinutes(), 2);
		var hour = Utils.pad(date.getHours(), 2);
		$(".time_now").html(hour + ":" + minutes);


	}, 1000);

	//  let weather = Utils.weatherApi();
	setInterval(Utils.weatherApi(), 5000);

	/* Utils */
	function is_touch_device() {
		return 'ontouchstart' in window        // works on most browsers
			|| navigator.maxTouchPoints;       // works on IE10/11 and Surface
	}

	function getRandomArbitrary(min, max) {
		return Math.random() * (max - min) + min;
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

	$(document).on('click', '#prevMonth', function (e) {

		current_page = 'backToHome';

		var receiver = document.querySelector('.agenda');

		var tempName = 'eventHome';
		var xhr = Utils.initXHR();


		xhr.onreadystatechange = function () {

			if (this.readyState == 4 && this.status == 200) {

				receiver.innerHTML = xhr.responseText;

			}

		};


		xhr.open('GET', '../jarvis/site/models/' + tempName + '.php?month=' + $(this).data('month') + '&year=' + $(this).data('year'), true);
		xhr.send();

	});

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

	function getPosition(mouseEvent, sigCanvas) {
		var rect = sigCanvas.getBoundingClientRect();
		return {
			X: mouseEvent.clientX - rect.left,
			Y: mouseEvent.clientY - rect.top
		};
	}

	/*function getPosition(mouseEvent, sigCanvas) {
	  var x, y;
	  if (mouseEvent.pageX != undefined && mouseEvent.pageY != undefined) {
		x = mouseEvent.pageX;
		y = mouseEvent.pageY;

	  } else {
		x = mouseEvent.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
		y = mouseEvent.clientY + document.body.scrollTop + document.documentElement.scrollTop;
	  }

	  return {
		X: x - sigCanvas.offsetLeft,
		Y: y - sigCanvas.offsetTop
	  };
	}*/
	var context;

	function initialize(canvas_id) {
		// get references to the canvas element as well as the 2D drawing context
		var sigCanvas = document.getElementById(canvas_id);
		context = sigCanvas.getContext("2d");
		context.strokeStyle = "#000000";
		context.lineJoin = "round";
		context.lineWidth = 2;

		// This will be defined on a TOUCH device such as iPad or Android, etc.
		var is_touch_device = 'ontouchstart' in document.documentElement;

		if (is_touch_device) {
			// create a drawer which tracks touch movements
			var drawer = {
				isDrawing: false,
				touchstart: function (coors) {
					context.beginPath();
					context.moveTo(coors.x, coors.y);
					this.isDrawing = true;
				},
				touchmove: function (coors) {
					if (this.isDrawing) {
						context.lineTo(coors.x, coors.y);
						context.stroke();
					}
				},
				touchend: function (coors) {
					if (this.isDrawing) {
						this.touchmove(coors);
						this.isDrawing = false;
					}
				}
			};

			// create a function to pass touch events and coordinates to drawer
			function draw(event) {

				// get the touch coordinates.  Using the first touch in case of multi-touch
				var coors = {
					x: event.targetTouches[0].pageX,
					y: event.targetTouches[0].pageY
				};

				// Now we need to get the offset of the canvas location
				var obj = sigCanvas;

				if (obj.offsetParent) {
					// Every time we find a new object, we add its offsetLeft and offsetTop to curleft and curtop.
					do {
						coors.x -= obj.offsetLeft;
						coors.y -= obj.offsetTop;
					}
						// The while loop can be "while (obj = obj.offsetParent)" only, which does return null
						// when null is passed back, but that creates a warning in some editors (i.e. VS2010).
					while ((obj = obj.offsetParent) != null);
				}

				// pass the coordinates to the appropriate handler
				drawer[event.type](coors);
			}

			// attach the touchstart, touchmove, touchend event listeners.
			sigCanvas.addEventListener('touchstart', draw, false);
			sigCanvas.addEventListener('touchmove', draw, false);
			sigCanvas.addEventListener('touchend', draw, false);

			// prevent elastic scrolling
			sigCanvas.addEventListener('touchmove', function (event) {
				event.preventDefault();
			}, false);
		} else {

			// start drawing when the mousedown event fires, and attach handlers to
			// draw a line to wherever the mouse moves to
			$("#" + canvas_id).mousedown(function (mouseEvent) {
				var position = getPosition(mouseEvent, sigCanvas);
				context.moveTo(position.X, position.Y);
				context.beginPath();

				// attach event handlers
				$(this).mousemove(function (mouseEvent) {
					drawLine(mouseEvent, sigCanvas, context);
				}).mouseup(function (mouseEvent) {
					finishDrawing(mouseEvent, sigCanvas, context);
				}).mouseout(function (mouseEvent) {
					finishDrawing(mouseEvent, sigCanvas, context);
				});
			});
		}

		return sigCanvas;
	}

	function drawLine(mouseEvent, sigCanvas, context) {

		var position = getPosition(mouseEvent, sigCanvas);

		context.lineTo(position.X, position.Y);
		context.stroke();
	}

	function finishDrawing(mouseEvent, sigCanvas, context) {

		context.closePath();

		// unbind any events which could draw
		$(sigCanvas).unbind("mousemove")
			.unbind("mouseup")
			.unbind("mouseout");
	}

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
				top: '15%',
				width: '450px'
			},
			overlayCSS: {
				cursor: 'default'
			},
			onBlock: function () {
				//canvas = new CanvasDrawr({id: "draw_note", size: 2});
				canvas = initialize("draw_note");
			},
			onOverlayClick: $.unblockUI
		});
	});

	$(document).on('click', '#saveNote', saveNote);
	function saveNote() {

		var serialized_drawing = canvas.toDataURL();
		var eventPrivate = $('#private').val();
		var eventPrivateVal;

		if (eventPrivate.checked) {

			eventPrivateVal = '1';

		} else {

			eventPrivateVal = '0';

		}

		var invites = EventsTemplate.checkBoxs('invitedCheckbox');

		$.ajax({
			method: 'POST',
			url: 'site/models/ajax_requests/saveNote.php',
			data: {
				'data': serialized_drawing,
				'private': eventPrivateVal,
				'invites': JSON.stringify(invites)
			}
		})
			.done(function () {
				if (current_mode !== 'open') {
					fetchNotes();
				}
				$.unblockUI();
				context.clearRect(0, 0, canvas.width, canvas.height);
				$('#note').find('.invitedCheckbox').prop('checked', false);
			});
	}

	$(document).on('click', '#clearNote', clearNote);
	function clearNote() {
		context.clearRect(0, 0, canvas.width, canvas.height);
	}

	function fetchNotes() {
		$.ajax({
			method: 'GET',
			url: 'site/models/ajax_requests/fetchNotes.php',
			data: {
				'user_id': 1
			}
		})
			.done(function (data) {
				$('.displayNote').remove();
				data = JSON.parse(data);
				$.each(data, function (i, row) {
					var random_x = Math.floor(getRandomArbitrary(50, 1000));
					var random_y = Math.floor(getRandomArbitrary(50, 500));
					var notes_div = $('<div class="displayNote" style="top: ' + random_y + 'px; left: ' + random_x + 'px;"></div>');
					notes_div.html('<img src="' + row['note']['data'] + '"><p><button class="dismissNote" data-id="' + row['note']['note_id'] + '">Dismiss note</button>&nbsp;&nbsp;&nbsp;' + row['shares'] + '</p>');
					$('body').append(notes_div);
					notes_div.draggable();
					notes_div.resizable({
						aspectRatio: 450 / 350
					});
				});
			});
	}

	$(document).on('click', '.dismissNote', dismissNote);

	function dismissNote(e) {

		var target = $(e.target);
		$.ajax({
			method: 'GET',
			url: 'site/models/ajax_requests/dismissNote.php',
			data: {
				'note_id': target.data('id')
			}
		})
			.done(function () {
				fetchNotes();
			});
	}

	$("#micro").click(function () {

		$(this).addClass('active');
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
		$('#micro').removeClass('active');
		$('#audiowaves').removeClass('active');

		if (response.action === 'private') {
			console.log('private');
			current_mode_span.html('private');
			$('.background').css({'background-image': "url('public/media/backgrounds/private_mode.png')"})
				.animate({opacity: 1}, {duration: 750});
			Cookies.set('current_mode', 'private', {path: ''});
			current_mode = 'private';
			eval(current_page + "()");
			changeUser();
			fetchNotes();
		}
		else if (response.action === 'collective') {
			console.log('collective');
			current_mode_span.html('collective');
			$('.background').css({'background-image': "url('public/media/backgrounds/collective_mode.png')"})
				.animate({opacity: 1}, {duration: 750});
			Cookies.set('current_mode', 'collective', {path: ''});
			current_mode = 'collective';
			console.log(current_page);
			eval(current_page + "()");
			changeUser();
			fetchNotes();
		}
		else if (response.action === 'goodbye') {
			console.log('goodbye');
			current_mode_span.html('open');
			$('.background').css({'background-image': ""})
				.animate({opacity: 0}, {duration: 750});
			Cookies.set('current_mode', 'open', {path: ''});
			current_mode = 'open';
			eval(current_page + "()");
			changeUser();
			$('.displayNote').remove();
		}
		else if (response.action === 'weather') {
			console.log('weather');

		}
		else {
			console.log('unknown response');
		}

	};

	$('.changeMode').click(function () {
		$('#micro').removeClass('active');
		$('#audiowaves').removeClass('active');

		if ($(this).hasClass('goOpen')) {
			console.log('goodbye');
			current_mode_span.html('open');
			$('.background').css({'background-image': ""})
				.animate({opacity: 0}, {duration: 750});
			Cookies.set('current_mode', 'open', {path: ''});
			current_mode = 'open';
			eval(current_page + "()");
			changeUser();
			$('.displayNote').remove();
		}
		else if ($(this).hasClass('goCollective')) {
			console.log('collective');
			current_mode_span.html('collective');
			$('.background').css({'background-image': "url('public/media/backgrounds/collective_mode.png')"})
				.animate({opacity: 1}, {duration: 750});
			Cookies.set('current_mode', 'collective', {path: ''});
			current_mode = 'collective';
			console.log(current_page);
			eval(current_page + "()");
			changeUser();
			fetchNotes();
		}
		else if ($(this).hasClass('goPrivate')) {
			console.log('private');
			current_mode_span.html('private');
			$('.background').css({'background-image': "url('public/media/backgrounds/private_mode.png')"})
				.animate({opacity: 1}, {duration: 750});
			Cookies.set('current_mode', 'private', {path: ''});
			current_mode = 'private';
			changeUser();
			eval(current_page + "()");
			fetchNotes();
		}
	});


	$("#boredDialog").dialog({
		autoOpen: false,
		height: 600,
		width: 600,
		modal: true,
		title: 'Activity suggestions',
		hide: {
			effect: "explode",
			duration: 400
		},
		open: function (event, ui) {
			$('#boredContent').empty();
			var map;
			var service;

			var amsterdam = new google.maps.LatLng(52.354516, 4.955957);

			map = new google.maps.Map(document.getElementById('map'), {
				center: amsterdam,
				zoom: 17
			});

			var possible_types = ['museum', 'cafe', 'park', 'zoo', 'shopping_mall'];
			var selected_type = possible_types[Math.floor(Math.random() * possible_types.length)];

			var request = {
				location: amsterdam,
				radius: '3000',
				type: [selected_type]
			};

			service = new google.maps.places.PlacesService(map);
			service.nearbySearch(request, callback);

			function callback(results, status) {
				if (status === google.maps.places.PlacesServiceStatus.OK) {
					for (var i = 0; i < results.length; i++) {
						console.log(results[i]);
						var open_now = '<span style="color: orange;"><i class="fa fa-question-circle" aria-hidden="true"></i></span>';
						var show = false;
						if (results[i].hasOwnProperty('opening_hours')) {
							if (results[i].opening_hours.open_now === true) {
								open_now = '<span style="color: green;"><i class="fa fa-check-circle" aria-hidden="true"></i></span>';
								show = true;
							}
							else {
								open_now = '<span style="color: red;"><i class="fa fa-cross-circle" aria-hidden="true"></i></span>';
							}
						}

						var rating = '-';
						if (results[i].hasOwnProperty('rating')) {
							rating = results[i].rating;
						}

						var row = $('<div class="boredRow">' +
							'<img src="' + results[i].icon + '" width="50"><p style="display: inline-block; margin-left: 10px;"><strong>' + results[i].name + '</strong><br>' +
							'Open now: ' + open_now + ' | Rating: ' + rating + '/5<br>' +
							'Address: ' + results[i].vicinity +
							'</p></div>');
						if (show === true) {
							$('#boredContent').append(row);
						}
					}
				}

			}
		}
	});

	$(document).on('click', '#bored', function () {

		$("#boredDialog").dialog('open');
	});

});
