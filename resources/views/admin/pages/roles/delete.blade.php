@extends('adminlte::page')

@section('content')
	<h1>Delete Role</h1>

	<section>
        @include('partials.flash')

        @can('deleteRoles')
            <h2>You are about to delete the following role. Please confirm that you wish to delete it.</h2>
            <table class="table table-striped">
                <tr>
                    <td>Role Id</td>
                    <td>{{$role->id}}</td>
                </tr>
                <tr>
                    <td>Role Name:</td>
                    <td>{{$role->name}}</td>
                </tr>

            </table>
            <form method="post" action="{{route('admin.roles.destroy')}}" autocomplete="off">
                @csrf
                <input type="hidden" name="todo" value="destroy_role">
                <input type="hidden" name="id" value="{{$role->id}}">
                <div style="text-align: right;">
                    <input class="btn btn-danger pull-right" type="submit" name="submit" value="Delete">
                </div>
    		</form>
        @else
            <h2>Problem:</h2>
            <p>You don't have enough permissions to perform the requested action.</p>
        @endcan
	</section>
@stop
