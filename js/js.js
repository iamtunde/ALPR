
var targetUrl = "index.php"; // show all records

// update status
function update_status(id)
{
	if (document.getElementById(id).checked == false) 
	var status = 0;
	else
	var status = 1;
	
	$("#message").text('');
	var id = id.replace('active_','');
	
	$.ajax({
		type: 'post',
		url: 'update_status.php',			
		data: 'id='+id+"&status="+status,
		beforeSend: function(){
			
			$("#loader-"+id).show();
		},
		success: function(e){
			$("#loader-"+id).hide();
			if(e==1)
			$("#message").append("<span>Status has been activated.</span>");
			else
			$("#message").append("<span>Status has been inactivated.</span>");
		}
	});
}

// update order 
$(document).ready(function(){
	$('#sortable').sortable({
		update: function(event, ui) {
			var itemOrder = $(this).sortable('toArray').toString();
			
			$.get('update_order.php', {itemOrder:itemOrder});
		}
	});
});


$(document).ready(function(){	
/// first time record 
var content = $("#sortable"); // main content ul
//content.load(targetUrl);

// delete record

$('a#delete').livequery('click', function(e) {
	if(confirm('Are you sure you want to delete this record?')==false)
	return false;
	e.preventDefault();
	var parent  = $(this).parent();
	var temp    = parent.attr('id').replace('delete-','');
	var main_tr = $('#id-'+temp);
	
		$.ajax({
			type: 'get',
			url: 'delete.php?id='+ parent.attr('id').replace('delete-',''),
			data: '',
			beforeSend: function(){
			},
			success: function(){
				main_tr.fadeOut(700,function(){
					main_tr.remove();
				});
			}
		});
	});
	
	// sorting records
	$('.hover').click(function(){
		 var content = $("#sortable"); // main content ul
		 content.load(targetUrl+'?sort='+$(this).html());
		 $('.hover').css('background-color','');
		 $(this).css('background-color','#99CC99');
	});
								 
});

// formValidation
function validateFrm(formType)
{
	if($('#email').val().length < 1 || $('#name').val().length < 1){
		alert('Please fill the required field.');
	}
	else
	{
	    var formParam = $("#customForm").serialize(); 
		if(formType == 'add')
		{
			var file = 'add_record.php';
			var message = 'Record Added !';
		}
		else
		{
			var file = 'update_record.php';
			var message = 'Record Updated !';
		}
		
		$.post(file+"?"+formParam,{
		}, function(response){
			
			 get_result = response;
			if(response == 1)
			{ 
				$('#faceBoxmessage').fadeOut();
				 $('#faceBoxmessage').html(unescape(message));
				 $('#faceBoxmessage').fadeIn();
				
				 setTimeout(" $.facebox.close();",1000)
				 //////////////
				 var content = $("#sortable"); // main content ul
				 content.load(targetUrl);
				 $('.hover').css('background-color','');
			}
		});
	}
}
