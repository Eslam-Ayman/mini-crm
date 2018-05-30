@extends('layouts.app')

@section('content')
	<div class="row">
	  <div class="col-sm-6 col-md-8 col-md-offset-2">
	    <div class="thumbnail">
	      <img src="/{{$company->logo_path}}" alt="logo" class="img-responsive" height="300">
	      <div class="caption text-center">
	        <h3>Name : {{$company->name}}</h3>
	        <p>Email : {{$company->email}}</p>
	        <p>Website : {{$company->website}}</p>
	        <p>
	        	<a href="/company/{{$company->id}}/edit" class="btn btn-primary pull-right" role="button">Edit</a>
	        	{!! Form::open(['action' => ['CompanyController@destroy', $company->id], 'method'=>'delete']) !!}
              		{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
              	{!! Form::close() !!}
	        	<!-- <a href="#" class="btn btn-danger" role="button">Delete</a> -->
	        </p>
	      </div>
	    </div>
	  </div>
	</div>
	<h2 class="sub-header">All Employees in this Company</h2>
    {{$users->links()}}
	<div class="table-responsive">
            <table class="table table-striped" id="myTable">
              <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
              	@if(count($users) > 0)
              		@foreach($users as $user)
		                <tr>
		                  <td><a href="/employee/{{$user->id}}">{{$user->f_name}}</a></td>
		                  <td>{{$user->l_name}}</td>
		                  <td>{{$user->email}}</td>
		                  <td>{{$user->phone}}</td>
		                  <td><a href="/employee/{{$user->id}}/edit" class="btn btn-primary">Edit</a></td>
		                  <td>
		                  	{!! Form::open(['action' => ['EmployeeController@destroy', $user->id], 'method'=>'delete']) !!}
		                  		{!! Form::submit('Del', ['class' => 'btn btn-danger']) !!}
		                  	{!! Form::close() !!}
		                  </td>
		                </tr>
	                @endforeach
	            @endif
              </tbody>
            </table>
          </div>
@endsection