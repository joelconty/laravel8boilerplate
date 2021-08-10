@extends('adminlte::page')

@section('content')
    <h1>Delete Users</h1>
    <br>
    @include('partials.flash')
	<section>
        @can('deleteUsers')
            <h2>Please confirm that you wish to delete the following user:</h2>
            <table class="table table-striped">
                <tr><td>Id:</td><td>{{$user->id}}</td></tr>
                <tr><td>Username:</td><td>{{$user->username}}</td></tr>
                <tr><td>First Name:</td><td>{{$user->firstname}}</td></tr>
                <tr><td>Last Name:</td><td>{{$user->lastname}}</td></tr>
            </table>
            <div style="text-align: right;">
                <form method="post" action="{{route('admin.users.destroy')}}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <input class="btn btn-danger pull-right" type="submit" name="submit" value="Delete">
                </form>
            </div>
        @else
            <h2>Problem:</h2>
            <p>You don't have enough permissions to perform the requested action.</p>
        @endcan
	</section>
@stop
