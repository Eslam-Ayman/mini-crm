@extends('layouts.app')

@section('content')
	<h1>Edit New Company</h1>
 	{!! Form::open(['action'=>['CompanyController@update', $company->id], 'method'=>'put' , 'enctype'=>'multipart/form-data']) !!}
 	<div class="form-group">
 		{!! Form::label('name', 'Company Name') !!}
 		{!! Form::text('name', $company->name, ['class' => 'form-control' , 'placeholder' => 'insert Company Name here...']) !!}
 	</div>
 	<div class="form-group">
 		{{ Form::label('email', 'Company Email') }}
 		{{ Form::text('email', $company->email, ['class' => 'form-control' , 'placeholder' => 'insert Company Email here...']) }}
 	</div>
 	<div class="form-group">
 		{{ Form::label('website', 'Company Website') }}
 		{{ Form::text('website', $company->website, ['class' => 'form-control' , 'placeholder' => 'insert Company Website here...']) }}
 	</div>
 	<div class="form-group">
 		{!! Form::file('logo_path', ['class' => 'btn btn-success pull-right']) !!}
 		{!! Form::submit('Update...', ['class' => 'btn btn-primary']) !!}
 	</div>
 	{!! Form::close() !!}
@endsection

