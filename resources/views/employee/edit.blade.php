@extends('layouts.app')

@section('content')
	<h1>Create New Employee</h1>
 	{!! Form::open(['action'=>['EmployeeController@update', $employee->id], 'method'=>'put']) !!}
 	<div class="form-group">
 		{!! Form::label('f_name', 'Employee First Name') !!}
 		{!! Form::text('f_name', $employee->f_name, ['class' => 'form-control' , 'placeholder' => 'insert First Name here...']) !!}
 	</div>
 	<div class="form-group">
 		{!! Form::label('l_name', 'Employee Last Name') !!}
 		{!! Form::text('l_name', $employee->l_name, ['class' => 'form-control' , 'placeholder' => 'insert Last Name here...']) !!}
 	</div>
 	<div class="form-group">
 		{{ Form::label('email', 'Employee Email') }}
 		{{ Form::text('email', $employee->email, ['class' => 'form-control' , 'placeholder' => 'insert Employee Email here...']) }}
 	</div>
 	<div class="form-group">
 		{{ Form::label('phone', 'Employee Phone') }}
 		{{ Form::text('phone', $employee->phone, ['class' => 'form-control' , 'placeholder' => 'insert Employee Phone here...']) }}
 	</div>
 	<div class="form-group">
 		{{ Form::label('password', 'Password of Employee') }}
 		{{ 	Form::password('password' , ['class' => 'form-control' , 'placeholder' => 'insert Employee Password here...']) }}
 	</div>
 	<div class="form-group pull-right">
 		{{ Form::label('company_id', 'Company Name') }}
 		{{ Form::select('company_id', $company_arr , $employee->company_id, ['style'=>'width:150px', 'class' => 'form-control']) }}
 	</div>
 	<div class="form-group">
	{{ Form::label('role', 'Role') }}
	{{ Form::select('role', ['employee'=>'Employee', 'admin'=>'Admin'] , null, ['style'=>'width:150px', 'class' => 'form-control']) }}
 	</div>
 	<div class="form-group">
 		{!! Form::submit('Update...', ['class' => 'btn btn-primary']) !!}
 	</div>
 	{!! Form::close() !!}
@endsection

