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

$("body").on("click", ".activite", function() { 
	console.log("That work !");
	
	//save this id here or we have an undefined context
	var idAct = $(this).attr('data-id');
	var idUtilisateur = $(this).attr('data-idUser');

	console.log("idUtilisateur = "+idUtilisateur)

	$('#myModalLabel').html("Informations de l\'activité");
    $('#myModalBody').html(function(){

        $.ajax({
            url: "script/getInfosActivity.php?idActivity="+idAct+"&idUtilisateur="+idUtilisateur,
            type: 'GET',
            success: function(msg){
                $('#myModalBody').html(msg);
            }
        })
        
    });

    $('#myModalBody').html(function(){

        $.ajax({
            url: "script/getActivityComment.php?idActivity="+idAct,
            type: 'GET',
            success: function(msg){
                $('#showComment2').html(msg);
            }
        })
        
    });

        

});

$("body").on("click", ".checkBoxShowAgenda", function() {
	if($(".checkBoxShowAgenda" ).prop( "checked" )){
		console.log("Hey click on agenda : "+$(this).attr('data-id'));
		$.ajax({
	        url: "script/getAgendaComments.php?idAgenda="+$(this).attr('data-id'), 
	        type: 'GET',
	        success: function(msg){
	            $('#showComment').html(msg);
	        }
	    })
	}
	
});

$("body").on("click", "#buttonInscriptionAct", function() {
	$.ajax({
        url: "script/inscriptionAct.php?idActivity="+$(this).attr('data-idAct')+"&idUtilisateur="+$(this).attr('data-idUser'), 
        type: 'GET',
        success: function(msg){
            $('#successSub').html(msg);
        }
    })
});