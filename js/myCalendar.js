/**
*	Function who display a calendar in a div with calendar id 
*	@param dateDebut : the date where the calendar start (show on screen)
*/
function generateCalendar(dateDebut){
	alert("coucou");
	dateFinSemaine = new Date();

	$('#calendar').html(" <div id='calendar' class='fc-calendar-container'>\
			<div class='fc-calendar fc-five-rows'>\
				<div class='fc-head'>\
					<div>Monday</div>\
					<div>Tuesday</div>\
					<div>Wednesday</div>\
					<div>Thursday</div>\
					<div>Friday</div>\
					<div>Saturday</div>\
					<div>Sunday</div>\
				</div>\
			<div class='fc-body'>\
				<div class='fc-row'>\
				<div></div>\
			<div></div>\
			<div></div>\
			<div><span class='fc-date'>1</span><span class='fc-weekday'>Thu</span></div>\
			<div><span class='fc-date'>2</span><span class='fc-weekday'>Fri</span></div>\
			<div><span class='fc-date'>3</span><span class='fc-weekday'>Sat</span></div>\
			<div><span class='fc-date'>4</span><span class='fc-weekday'>Sun</span></div>\
			</div>\
			<div class='fc-row'>\
			<!-- ... -->\
			</div>\
			<div class='fc-row'>\
			<!-- ... -->\
			</div>\
			<div class='fc-row'>\
			<!-- ... -->\
			</div>\
			<!-- ... -->\
			</div>\
			</div>\
		</div>\
	");
}

function isValideDate(date){
	var monthNames = [
		"Janvier", "Fevrier", "Mars",
		"Avril", "Mai", "Juin", "Juillet",
		"Aout", "Septembre", "Octobre",
		"Novembre", "Decembre"
	];

}