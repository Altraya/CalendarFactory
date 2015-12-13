/**
*	Function who display a calendar in a div with calendar id 
*	@param dateDebut : the date where the calendar start (show on screen)
*/
function generateCalendar(dateDebut){

	dateFinSemaine = new Date();

	$('#calendar').html(" \
		<div id='calendar' class='table-responsive'>\
			<table class='table'>\
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
						<td class='case unused'>1</td>\
						<td class='case normal'>Anna</td>\
						<td class='case day'>Pitt</td>\
						<td class='case normal'>35</td>\
						<td class='case normal'>New York</td>\
						<td class='case normal'>USA</td>\
					</tr>\
				</tbody>\
			</table>\
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