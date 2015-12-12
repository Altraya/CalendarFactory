/**
*	Function who display a calendar in a div with calendar id 
*	@param dateDebut : the date where the calendar start (show on screen)
*/
function generateCalendar(dateDebut){
	alert("coucou");
	console.log("coucou");
	dateFinSemaine = new Date();

	$('#calendar').html(" \
		<div id='calendar' class='table-responsive'>\
			<div class='table'>\
			<table>\
				<thead>\
					<tr>\
						<th>Lundi</th>\
						<th>Mardi</th>\
						<th>Mercredi</th>\
						<th>Jeudi</th>\
						<th>Vendredi</th>\
						<th>Samedi</th>\
						<th>Dimanche</th>\
					</tr>\
				</thead>\
				<tbody>\
					<tr>\
						<td>1</td>\
						<td>Anna</td>\
						<td>Pitt</td>\
						<td>35</td>\
						<td>New York</td>\
						<td>USA</td>\
					</tr>\
				</tbody>\
	</table>\
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