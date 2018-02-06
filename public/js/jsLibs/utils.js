Utils = {

	initXHR: function () {

		var xhr;
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xhr = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xhr = new ActiveXObject("Microsoft.XMLHTTP");
		}

		return xhr;

	},


	sendTemplateName: function (tempName, receiver) {

		var xhr = Utils.initXHR();


		xhr.onreadystatechange = function () {

			if (this.readyState == 4 && this.status == 200) {

				receiver.innerHTML = xhr.responseText;

				//alert(xhr.responseText);

			}

		};


		xhr.open('GET', '../jarvis/site/models/' + tempName, true);
		xhr.send();

	},

	pad: function (n, width, z) {
		z = z || '0';
		n = n + '';
		return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
	},


	weatherApi: function () {

		var tempDateInfo = $('.currentWeather');
		var temperatureDeg = $('.temperature h1');
		var temperatureName = $('.tempName');

		var weekday = new Array(7);
		weekday[0] = "su";
		weekday[1] = "mo";
		weekday[2] = "tu";
		weekday[3] = "we";
		weekday[4] = "th";
		weekday[5] = "fr";
		weekday[6] = "sa";

		$.get('https://api.apixu.com/v1/forecast.json?key=1549521ef1e546d6ae3133207183001&q=Amsterdam&days=8')
			.done(function (result) {
				console.log(result);
				temperatureDeg.html(result.current.temp_c + '&deg;');
				temperatureName.html(result.current.condition.text);
				tempDateInfo.css({backgroundImage: "url(" + result.current.condition.icon + ")"});

				var curDate = new Date();
				var curHour = curDate.getHours();
				console.log(curHour);

				var hourly = result.forecast.forecastday[0].hour;
				var hourlyForecast = hourly.slice(curHour);
				var remaining = 24 - curHour;
				if (remaining < 7) {
					var getNextDay = 7 - remaining;
					var hourlyNextDay = result.forecast.forecastday[1].hour.slice(0, getNextDay);
					hourly = hourlyForecast.concat(hourlyNextDay);
				}

				for (var i = 0; i < 7; i++) {

					var hour = hourly[i];

					var divHour = $(".tempDateInfoHour[data-num='" + i + "']");
					divHour.find('h1').html(hour.time.substr(10, 3) + "<small>" + hour.time.substr(14, 3) + "</small>");
					divHour.find('.weatherIcon').html('<img src="' + hour.condition.icon + '" width="28">');
					divHour.find('.tempCelsius').html(Math.round(hour.temp_c) + '&deg;');
				}

				for (var j = 0; j < result.forecast.forecastday.length; j++) {

					var forecast = result.forecast.forecastday[j];
					var forecastDate = new Date(forecast.date);
					var dayOfWeek = weekday[forecastDate.getDay()];

					var divDay = $(".tempDateInfoDay[data-num='" + j + "']");
					divDay.find('h1').html(dayOfWeek);
					divDay.find('.weatherIcon').html('<img src="' + forecast.day.condition.icon + '" width="28">');
					divDay.find('.tempCelsius').html(Math.round(forecast.day.avgtemp_c) + '&deg;');

				}
			});
	},


	parse_month: function (month) {

		var monthArr = ['', 'January', 'Februari', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'Oktober', 'November', 'December'];

		return monthArr[month];

	},


	singleNumber: function (month) {
		var getMonth = month.slice(3, 5);
		if (getMonth == '01') {

			getMonth = '1';

		} else if (getMonth == '02') {

			getMonth = '2';

		} else if (getMonth == '03') {

			getMonth = '3';

		} else if (getMonth == '04') {

			getMonth = '4';

		} else if (getMonth == '05') {

			getMonth = '5';

		} else if (getMonth == '06') {

			getMonth = '6';

		} else if (getMonth == '07') {

			getMonth = '7';

		} else if (getMonth == '08') {

			getMonth = '8';

		} else if (getMonth == '09') {

			getMonth = '9';

		}

		return getMonth;

	}


}
