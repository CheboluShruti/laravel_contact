@extends('layout')

@section('header')
<h2>Contacts Table</h2>

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#recent">Recent</a></li>
    <li><a data-toggle="tab" href="#contactList">Contact List</a></li>
    
  </ul>
@endsection
@section('content1')


                                                                                      
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        
        <th>Full Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Action</th>

        </tr>
    </thead>
    <tbody>

    	@foreach($Recent_data as $rec_data)

      <tr>
        <td>{{ $rec_data->name }}</td>
        <td>{{ $rec_data->email }}</td>
        <td>{{ $rec_data->mobile }}</td>
        <td><a href="/edit/{{$rec_data->id}}" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>


@endsection


@section('content2')


                                                                                      
   <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        
        <th>Full Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Action</th>

        </tr>
    </thead>
    <tbody>

      @foreach($contact_data as $con_data)

      <tr>
        <td>{{ $con_data->name }}</td>
        <td>{{ $con_data->email }}</td>
        <td>{{ $con_data->mobile }}</td>
        <td><a href="/edit/{{$con_data->id}}" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>

@endsection
