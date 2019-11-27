$(document).ready(function() {
	$('#schoolnametext').hide();
	$('#returning').hide();
	$('.checkInButton').hide();
	
	//toggle between adding new guest and table
	$('#toggle').mouseup(function() {
		$('#newguest').toggle();
		$('#returning').toggle();
		
		if ($('#toggle').html() === 'New Guest')
			$('#toggle').html('Returning Guest')
		else $('#toggle').html('New Guest')
	});
	
	//search functionality and table filtering
	$('input[name=gSearch]').on('keyup', function() {
		var value = $(this).val().toLowerCase();
		$('tr').not(':first').filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});
	
	//table row event handling
	$('.tblrow').on({
		mouseenter: function() {
			$(this).css({'background-color' : 'gray'});
			$(this).children().children('.checkInButton').toggle();
		},
		mouseleave: function() {
			$(this).css({'background-color' : 'white'});
			$(this).children().children('.checkInButton').toggle();
		},
		dblclick: function() {
			alert($(this).find(".fname").html());
		}
	});
	
	//add new guest
	$('button[name=submitAttendance]').click(function() {
		console.log("aaa");
		var fname = $('input[name=gFirstname]').val();
		var lname = $('input[name=gLastname]').val();
		var use = $('#use').val();
		
		// update school list combobox
		if ($('#schoolnametext').is(':visible')) {
			var school = $('#schoolnametext').val().toUpperCase();
			$('#schoolnameselect').append("<option value=" + school + ">" + school + "</option>");
		}
		else var school = $('#schoolnameselect').val();
		
		$.ajax({
			url: 'processGuest.php',
			method: 'GET',
			data: {
				fname:fname,
				lname:lname,
				school:school,
				use:use,
				submitAttendance:true
			},
			success: function(response) {
				window.location.reload();
				alert(response);
			}
		});
	});
	
	
	//add new school
	$('#toggleSchool').click(function() {
		$('#schoolnameselect').toggle();
		$('#schoolnametext').toggle();
		
		if ($('#toggleSchool').html() === 'Enter Another School')
			$('#toggleSchool').html('See List of Schools')
		else $('#toggleSchool').html('Enter Another School')
	});
	
	//checkin existing guest
	$('button.checkInButton').click(function() {
		var fname = $(this).parent().siblings('.fname').html();
		var lname = $(this).parent().siblings('.lname').html();
		var school = $(this).parent().siblings('.school').html();
		var use = $('#use').val();
		
		$.ajax({
			url: 'processGuest.php',
			method: 'GET',
			data: {
				fname:fname,
				lname:lname,
				school:school,
				use:use,
				submitAttendance:true,
				returning:true
			},
			success: function(response) {
				alert(response);
			}
		});
	});
});
