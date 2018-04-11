<!DOCTYPE html>
<html>
<head>
	<title>Contact List</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

		#contactData_wrapper > div:first-child {
			width: 50%;
		}
		#contactData_wrapper > div:nth-child(3) {
     
			width: 50%;
		}

	</style>
</head>
<body>
<div class="container">
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

</div>
</div>
</body>
</html>