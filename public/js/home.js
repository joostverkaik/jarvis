$(function () {

	$(document).on('click', "#addEvents", function (e) {

		var tempName = e.target.id;
		var receiver = document.querySelector('.agenda');
		$('.agendaHeader').hide('slow');

		var xhr = Utils.initXHR();

		xhr.onreadystatechange = function () {

			if (this.readyState === 4 && this.status === 200) {

				receiver.innerHTML = xhr.responseText;

				var addNewEvent = document.querySelector('.agenda #addNewEvent');
				addNewEvent.addEventListener('click', EventsTemplate.addEvents);

				$("#backToEvent").click(backToHome);

			}

		};
		console.log($(this));


		if (typeof $(this).data('date') != 'undefined') {
			xhr.open('GET', '../jarvis/site/views/templates/appTemplates/' + tempName + '.php?date=' + $(this).data('date'), true);
		}
		else {
			xhr.open('GET', '../jarvis/site/views/templates/appTemplates/' + tempName + '.php', true);
		}
		xhr.send();


	});


	$(document).on('click', '.daysNumb', function (e) {

		var tempName = "displayEvent";
		var receiver = document.querySelector('.agenda');
		var xhr = Utils.initXHR();

		xhr.onreadystatechange = function () {

			if (this.readyState === 4 && this.status === 200) {

				receiver.innerHTML = xhr.responseText;

				var dateNumb = e.currentTarget.childNodes[1].textContent;
				var curMonth = e.currentTarget.childNodes[1].className;

				EventsTemplate.displayEvents(dateNumb, curMonth);

				$("#backToEvent").click(backToHome);


			}

		};


		xhr.open('GET', '../jarvis/site/views/templates/appTemplates/' + tempName + '.php', true);
		xhr.send();

	});


	function backToHome() {

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


});
