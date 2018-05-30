@extends('layouts.app')

@section('content')
	<div class="row">
	  <div class="col-sm-6 col-md-8 col-md-offset-2">
	    <div class="thumbnail">
	      <div class="caption text-center">
	        <h3>Name : {{$employee->f_name}} {{$employee->l_name}}</h3>
	        <p>Email : {{$employee->email}}</p>
	        <p>phone : {{$employee->phone}}</p>
	        <p>
	        	<a href="/employee/{{$employee->id}}/edit" class="btn btn-primary pull-right" role="button">Edit</a>
	        	{!! Form::open(['action' => ['EmployeeController@destroy', $employee->id], 'method'=>'delete']) !!}
              		{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
              	{!! Form::close() !!}
	        	<!-- <a href="#" class="btn btn-danger" role="button">Delete</a> -->
	        </p>
	      </div>
	    </div>
	  </div>
	</div>
	<h2 class="sub-header">Company Information</h2>
	<div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th>
	          <th>Email</th>
	          <th>Website</th>
	          <th>Logo</th>
	          <th>Edit</th>
	          <th>Delete</th>
            </tr>
          </thead>
          <tbody>
	          <tr>
	              <td><a href="/company/{{$employee->company->id}}">{{$employee->company->name}}</a></td>
	              <td>{{$employee->company->email}}</td>
	              <td><a href="{{$employee->company->website}}/{{$employee->company->id}}">{{$employee->company->website}}/{{$employee->company->id}}</a></td>
	              <td><img src="/{{$employee->company->logo_path}}" class="img-responsive" width="100" height="100"></td>
	              <td><a href="/company/{{$employee->company->id}}/edit" class="btn btn-primary">Edit</a></td>
	              <td>
	              	{!! Form::open(['action' => ['CompanyController@destroy', $employee->company->id], 'method'=>'delete']) !!}
	              		{!! Form::submit('Del', ['class' => 'btn btn-danger']) !!}
	              	{!! Form::close() !!}
	              </td>
	            </tr>
          </tbody>
        </table>
      </div>
@endsection