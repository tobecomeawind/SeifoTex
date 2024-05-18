var specifications = document.currentScript.getAttribute('specifications');

$(document).ready(function(){
	$('#data_table').Tabledit({
		deleteButton: false,
		editButton: false,
		columns: {
			identifier: [0, 'id'],
			editable: [[1, 'name'], [2, 'specification', specifications], [3, 'factory_id'], [4, 'cost']]
		},
	hideIdentifier: false,
	url: 'live_edit.php'
	});
});
