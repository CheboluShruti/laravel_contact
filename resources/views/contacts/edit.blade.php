<!DOCTYPE html>
<html>
<head>
	<title>EDIT CONTACT</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		.editForm{
			margin-top:70px;
		}
	</style>
</head>
<body>
<div class="container editForm">

	<div class="col-md-3"></div>
		<div class="col-md-6">
	 <form class="form-horizontal" action="/edit_contact_details" method="POST">
	 	{{ csrf_field() }}
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
	
        <input type="email" class="form-control" placeholder="Enter email" name="email" value="@if ($edit_data->email!='') {{ $edit_data->email }}  @endif">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Name:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control"  placeholder="Enter name" name="name" value="@if ($edit_data->name!='') {{ $edit_data->name }}  @endif">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Mobile:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control"  placeholder="Enter name" name="mobile" value="@if ($edit_data->mobile!='') {{ $edit_data->mobile }}  @endif">
      </div>
    </div>
    <input type="hidden" value="{{$edit_data->id}}" name="ContactID">
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Edit</button>
      </div>
    </div>
  </form>
</div>
	<div class="col-md-3"></div>
</div>
</body>
</html>