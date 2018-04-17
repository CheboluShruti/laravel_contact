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

		.btn-primary:hover,
.btn-primary:focus {
    background-color: #108d6f;
    border-color: #108d6f;
    box-shadow: none;
    outline: none;
}

.btn-primary {
    color: #fff;
    background-color: #007b5e;
    border-color: #007b5e;
}

section {
    padding: 60px 0;
}

section .section-title {
    text-align: center;
    color: #007b5e;
    margin-bottom: 50px;
    text-transform: uppercase;
}

#team .card {
    border: none;
    background: #ffffff;
}



.frontside {
    position: relative;
    -webkit-transform: rotateY(0deg);
    -ms-transform: rotateY(0deg);
    z-index: 2;
    margin-bottom: 30px;
    border: 2px solid #000;
}

.backside {
    position: absolute;
    top: 0;
    left: 0;
    background: white;
    -webkit-transform: rotateY(-180deg);
    -moz-transform: rotateY(-180deg);
    -o-transform: rotateY(-180deg);
    -ms-transform: rotateY(-180deg);
    transform: rotateY(-180deg);
    -webkit-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
    -moz-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
    box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
}

.frontside,
.backside {
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    -ms-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transition: 1s;
    -webkit-transform-style: preserve-3d;
    -moz-transition: 1s;
    -moz-transform-style: preserve-3d;
    -o-transition: 1s;
    -o-transform-style: preserve-3d;
    -ms-transition: 1s;
    -ms-transform-style: preserve-3d;
    transition: 1s;
    transform-style: preserve-3d;
}

.frontside .card,
.backside .card {
    min-height: 312px;
}

.backside .card a {
    font-size: 18px;
    color: #007b5e !important;
}

.frontside .card .card-title,
.backside .card .card-title {
    color: #007b5e !important;
}

.frontside .card .card-body img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
}
	</style>
	</head>
<body>
<div class="container">
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6 editForm">
		 <div class="image-flip" >
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card">
                            	<div class="card-header text-center">
                            		<h2>Contact Details</h2>
                            	</div>
                                <div class="card-body text-center">
                                    <p><img class=" img-fluid" src="@if ($edit_data->profile_pic==true) {{ url('/') }}/uploads/{{ $edit_data->profile_pic }} 
          @else
    {{ url('/') }}/uploads/defaultUser.png
@endif" alt="card image" style="border:5px solid #ccc;"></p>
                                    <h4 class="card-title">@if ($edit_data->name!='') {{ $edit_data->name }}  @endif</h4>
                                    <span>@if ($edit_data->email!='') {{ $edit_data->email }}  @endif</span><br><br$>
                                    <span>@if ($edit_data->mobile!='') {{ $edit_data->mobile }}  @endif</span><br>
                                    <a href="{{ url('/') }}/edit/{{$edit_data->id}}" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
	</div>
	<div class="col-md-3"></div>
</div>


</div>