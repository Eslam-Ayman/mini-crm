@extends('layouts.app')

@section('content')
	<h2 class="sub-header">All Employees</h2>
  {{$employees->links()}}
	<div class="table-responsive">
    <table id="myTable" class="table table-striped">
      <thead>
        <tr>
          <th>Company name</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Phone</th>
          @can('adminRole')
          <th>Edit</th>
          <th>Delete</th>
          @endcan
        </tr>
      </thead>
      <tbody>
        @if(count($employees) > 0)
          @foreach($employees as $user)
            <tr>
                <td>{{$user->company->name}}</td>
                <td><a href="/employee/{{$user->id}}">{{$user->f_name}}</a></td>
                <td>{{$user->l_name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone}}</td>
                <!-- @//cannot('adminRole') -->
                @can('adminRole')
                <td><a href="/employee/{{$user->id}}/edit" class="btn btn-primary">Edit</a></td>
                <td>
                  {!! Form::open(['action' => ['EmployeeController@destroy', $user->id], 'method'=>'delete']) !!}
                    {!! Form::submit('Del', ['class' => 'btn btn-danger']) !!}
                  {!! Form::close() !!}
                </td>
                @endcan
                <!-- @//endcannot -->
            </tr>
          @endforeach
      @endif
      </tbody>
    </table>
  </div>
@endsection