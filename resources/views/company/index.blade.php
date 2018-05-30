@extends('layouts.app')

@section('content')
	<h2 class="sub-header">All Companies</h2>
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
      	@if(count($companies) > 0)
      		@foreach($companies as $company)
            <tr>
              <td><a href="/company/{{$company->id}}">{{$company->name}}</a></td>
              <td>{{$company->email}}</td>
              <td><a href="{{$company->website}}/{{$company->id}}">{{$company->website}}/{{$company->id}}</a></td>
              <td><img src="/{{$company->logo_path}}" class="img-responsive" width="100" height="100"></td>
              <td><a href="/company/{{$company->id}}/edit" class="btn btn-primary">Edit</a></td>
              <td>
              	{!! Form::open(['action' => ['CompanyController@destroy', $company->id], 'method'=>'delete']) !!}
              		{!! Form::submit('Del', ['class' => 'btn btn-danger']) !!}
              	{!! Form::close() !!}
              </td>
            </tr>
          @endforeach
          {{$companies->links()}}
      @endif
      </tbody>
    </table>
  </div>
@endsection