@extends('layout')

@section('header')

<h2>Contacts Table</h2>
<div class="bg-green-color" style="width:100%">
  <ul class="nav nav-tabs">
    <li class="active" id="RecentCall"><a data-toggle="tab" href="#recent">Recent</a></li>
    <li id="Contactstable"><a data-toggle="tab" href="#contactList">Contact List</a></li>
    <li id="AddC"><a data-toggle="tab" href="#AddContact">Add Contact</a></li>
    <li id="MailContacts"><a data-toggle="tab" href="#MailContact">Mail Contact</a></li>
    
  </ul>
</div>
@endsection
<div class="col-md-3"></div>
<div class="col-md-6">
@section('content1')


                                                                                      
    
  <table id="recentData" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        
        <th>Profile Pic</th>
        <th>Name</th>
        
        <th>See Details</th>

        </tr>
    </thead>
    <tbody>

    	@foreach($Recent_data as $rec_data)

      <tr >
        <td style="width:10%" ><img src="
          @if ($rec_data->profile_pic==true) {{ url('/') }}/uploads/{{ $rec_data->profile_pic }} 
          @else
    {{ url('/') }}/uploads/defaultUser.png
@endif" width="80px" height="80px"></td>
        <td style="width:70%"><p>{{ $rec_data->name }}</p><p>{{ \Carbon\Carbon::parse($rec_data->updated_at)->diffForHumans()  }}</p></td>
         
        <td style="width:10%"><a href="{{ url('see-details') }}/{{$rec_data->id}}" class="btn btn-info"><i class="fa fa-chevron-right" aria-hidden="true"></i></a></td>
        {{--<td><a href="/edit/{{$rec_data->id}}" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>--}}
      </tr>
      @endforeach
    </tbody>
  </table>
  


@endsection


@section('content2')


                                                                                      
  
  <table id="contactData" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        
       <th>Profile Pic</th>
        <th>Name</th>
        <th>Delete</th>
        <th>See Details</th>

        </tr>
    </thead>
    <tbody>

      @foreach($contact_data as $con_data)

     

      <tr class="contact_no_{{ $con_data->id }}">
        <td style="width:10%" ><img src="
          @if ($con_data->profile_pic==true) {{ url('/') }}/uploads/{{ $con_data->profile_pic }} 
          @else
    {{ url('/') }}/uploads/defaultUser.png
@endif" width="80px" height="80px"></td>
        <td style="width:70%"><p>{{ $con_data->name }}</p></td>
         <td style="width:10%"> 
            <label class="switch">
              <input type="checkbox" name="deleteContact" send-data="{{ $con_data->id }}" class="DeleteCon">
                <span class="slider round"></span>
            </label>
        </td>
        <td style="width:10%"><a href="{{ url('/') }}/see-details/{{$con_data->id}}" class="btn btn-info"><i class="fa fa-chevron-right" aria-hidden="true"></i></a></td>
        {{--<td><a href="/edit/{{$con_data->id}}" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>--}}
      </tr>
      @endforeach
    </tbody>
  </table>
<br>
<button class="btn btn-danger btn-block bulk_delete">Delete</button>
<br>
<br>
<br>
@endsection

@section('content3')

  <h2 align="center">Add Contact</h2>
 <form class="form-horizontal" action="{{ url('/') }}/add_contact_details" enctype="multipart/form-data"  name="add_contact_form" id="edit_contact_form" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
  
        <input type="email" class="form-control" placeholder="Enter email" name="email" id="email" >
        

      </div>
    </div>
     @if ($errors->get('email')==true)
     <div class="alert alert-danger">{{ $errors->first('email') }}</div>
     @endif
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Name:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control"  placeholder="Enter name" name="name" id="name" >
        
      </div>
    </div>
      @if ($errors->get('name')==true)
     <div class="alert alert-danger">{{ $errors->first('name') }}</div>
     @endif

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Mobile:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control"  placeholder="Enter name" name="mobile" id="mobile" >
        
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
    
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary addContact">Add Contact</button>
      </div>
    </div>


  </form>


@endsection
@section ('mail_contact')

 <div class="card">
    <div class="card-header"><h2 class="text-center">Email</h2></div>
    <div class="card-body">
      <form class="form-horizontal" action="{{ url('/') }}/send_mail" enctype="multipart/form-data"  name="send_mail_form" id="send_mail_form" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
  
        <input type="email" class="form-control" placeholder="Enter email" name="emailAddress" id="emailAddress" >
        

      </div>
    </div>
     @if ($errors->get('emailAddress')==true)
     <div class="alert alert-danger">{{ $errors->first('email') }}</div>
     @endif
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Subject:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control"  placeholder="Enter Subject" name="subject" id="subject" >
        
      </div>
    </div>
      @if ($errors->get('subject')==true)
     <div class="alert alert-danger">{{ $errors->first('subject') }}</div>
     @endif

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Message:</label>
      <div class="col-sm-10">          
        <textarea name="Emailmessage" class="form-control" id="Emailmessage"></textarea>
        
      </div>
    </div>
     @if ($errors->get('Emailmessage')==true)
     <div class="alert alert-danger">{{ $errors->first('Emailmessage') }}</div>
     @endif
     <!--<div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Image:</label>
      <div class="col-sm-10">          
        <input type="file" class="form-control"  placeholder="Upload Image" name="ProfileImg" id="ProfileImg" >
        
      </div>
    </div>-->
    
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary ">Send Mail</button>
      </div>
    </div>


  </form>
    </div> 
    
  </div>

@endsection

</div>
<div class="col-md-3"></div>



