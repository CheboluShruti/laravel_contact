<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Contact List</title>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>

	<script type="text/javascript">
  $(document).ready(function() {
    
    $('#contactData').DataTable();
} );
</script>
<style type="text/css">
		.bg-green-color{
			background-color: rgba(29,210,101,0.78);
		}
		.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
		

	</style>
</head>
<body>
<div class="container">
	<div class="col-md-3"></div>
	<div class="col-md-6">
@yield('header')
<div class="tab-content">
    <div id="recent" class="tab-pane fade in active">
		@yield('content1')
	</div>

	<div id="contactList" class="tab-pane fade">
		@yield('content2')
	</div>


	<div id="AddContact" class="tab-pane fade">
		@yield('content3')
	</div>


	<div id="MailContact" class="tab-pane fade">
		@yield('mail_contact')
	</div>

</div>
</div>
<div class="col-md-3"></div>
</div>
<input type="hidden" class="contact_ids" val="">
<script type="text/javascript">
  $('.DeleteCon').click(function(event) {
    var deletecontactField = $('.contact_ids').val();
     var contactID = $(this).attr('send-data');
  if($(this).is(':checked'))
  {
   
    
    $('.contact_ids').val(deletecontactField+contactID+',');
  }
  else
  {
	var indexofremovepart = deletecontactField.indexOf(contactID+',');
	var newcontactstring = deletecontactField.replace(contactID+',','');
	$('.contact_ids').val(newcontactstring);
  }
  });


$('.bulk_delete').click(function(event) {

var confirmDelete = confirm("Are you Sure you want to delete the Contacts?");
var contact_ids = $('.contact_ids').val();
if(confirmDelete==false)
{
	return false;
}
else
{
	$.ajax({
		url: '/delete_contact',
		method: 'POST',
		
		data: {
			deleteID: contact_ids,
			
		},
		success: function(result){
           var explodeDeleteContact = contact_ids.split(',');
           for (var i = 0; i < explodeDeleteContact.length; i++) {
           	$('.contact_no_'+explodeDeleteContact[i]).hide();
           }
        }
	});
	
	
}
});
 

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  
</script>


</body>
</html>