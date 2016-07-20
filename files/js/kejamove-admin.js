var base_url = 'http://www.kejamove.com/';

function openModal(id)
{
	$('#modal-request').modal('show');
	$.get('/admin/getrequestcontent/'+id, function(response) {
		$('#request-modal-content').html(response);
	});
}
function updaterequest(request,user)
{
	var formdata = new FormData($('#update-form')[0]);
	$.ajax({
		url: '/admin/updaterequest/'+request+'/'+user,
		type: 'POST',
		dataType: 'html',
		cache : false,
		processData : false,
		contentType : false,
		data: formdata,
	})
	.done(function(response) {
		$('#request-modal-content').html(response);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
}

function filterrequests()
{
	var formdata = new FormData($('#filter-form')[0]);
	$.ajax({
		url: '/admin/filterrequests',
		type: 'POST',
		dataType: 'html',
		cache : false,
		processData : false,
		contentType : false,
		data: formdata,
	})
	.done(function(response) {
		$('.new-requests').html(response);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
}

