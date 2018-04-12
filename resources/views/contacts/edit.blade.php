<!DOCTYPE html>
<html>
<head>
	<title>EDIT CONTACT</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="{{ asset('js/jquery.validate.js') }}"></script>
  
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
      <h2 align="center">Edit Contact</h2>
	 <form class="form-horizontal" action="/edit_contact_details" enctype="multipart/form-data"  name="edit_contact_form" id="edit_contact_form" method="POST">
	 	{{ csrf_field() }}
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
	
        <input type="email" class="form-control" placeholder="Enter email" name="email" id="email" value="@if ($edit_data->email!='') {{ $edit_data->email }}  @endif">
        

      </div>
    </div>
     @if ($errors->get('email')==true)
     <div class="alert alert-danger">{{ $errors->first('email') }}</div>
     @endif
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Name:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control"  placeholder="Enter name" name="name" id="name" value="@if ($edit_data->name!='') {{ $edit_data->name }}  @endif">
        
      </div>
    </div>
      @if ($errors->get('name')==true)
     <div class="alert alert-danger">{{ $errors->first('name') }}</div>
     @endif

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Mobile:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control"  placeholder="Enter name" name="mobile" id="mobile" value="@if ($edit_data->mobile!='') {{ $edit_data->mobile }}  @endif">
        
      </div>
    </div>
     @if ($errors->get('mobile')==true)
     <div class="alert alert-danger">{{ $errors->first('mobile') }}</div>
     @endif
     <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Image:</label>
      <div class="col-sm-10">          
        <input type="file" class="form-control"  placeholder="Upload Image" name="ProfileImg" id="ProfileImg" >
        
      </div>
    </div>
    @if ($errors->get('ProfileImg')==true)
     <div class="alert alert-danger">{{ $errors->first('ProfileImg') }}</div>
     @endif
    <input type="hidden" value="{{$edit_data->id}}" name="ContactID">
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button>   <a href="{{ url('/') }}" class="btn btn-success" style="float:right;"><i class="fa fa-reply"></i> Back</a>
      </div>
    </div>


  </form>

    
</div>
	<div class="col-md-3"></div>
</div>
<script type="text/javascript">
    

    // $( document ).ready( function () {
    //   $( "#edit_contact_form" ).validate( {
    //     rules: {
    //       name: "required",
    //       email: {
    //         required: true,
    //         email: true
    //       },

    //        mobile: {
    //         required: true,
    //         number: true
    //       },
          
    //     },
    //     messages: {
    //       name: "Please enter your firstname",
          
    //       email: "Please enter a valid email address",
          
    //     },
    //     errorElement: "em",
    //     errorPlacement: function ( error, element ) {
    //       // Add the `help-block` class to the error element
    //       error.addClass( "help-block" );

    //       if ( element.prop( "type" ) === "checkbox" ) {
    //         error.insertAfter( element.parent( "label" ) );
    //       } else {
    //         error.insertAfter( element );
    //       }
    //     },
    //     highlight: function ( element, errorClass, validClass ) {
    //       $( element ).parents( ".col-sm-10" ).addClass( "has-error" ).removeClass( "has-success" );
    //     },
    //     unhighlight: function (element, errorClass, validClass) {
    //       $( element ).parents( ".col-sm-10" ).addClass( "has-success" ).removeClass( "has-error" );
    //     }
    //   } );

    // });
  </script>
</body>
</html>