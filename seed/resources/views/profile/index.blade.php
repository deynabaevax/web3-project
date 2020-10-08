@extends('layouts.app')

@section('content')

<h1>Users</h1>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>User Since</th>
            <th width="70px"></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
            <td>
                <a href="/profile/{{$user->id}}/edit" class="btn btn-xs btn-primary">Edit</a>
                {!!Form::open(['action' => ['ProfileController@destroy', $user->id], 'method' => 'POST', 'class' =>'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger', 'style'=>'float:right'])}}
                {!!Form::close()!!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$users->links()}}
@endsection