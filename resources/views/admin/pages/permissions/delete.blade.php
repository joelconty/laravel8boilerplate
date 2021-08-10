@extends('adminlte::page')

@section('content')
    <h1>Delete Permission</h1>
	<section>
        @include('partials.flash')
        <h2>You are about to delete the following permission. Please confirm that you wish to delete it.</h2>
		<table class="table table-striped">
			<tr>
				<td>Permission Id</td>
				<td>{{$permission->id}}</td>
			</tr>
			<tr>
				<td>Name:</td>
				<td>{{$permission->name}}</td>
			</tr>
        </table>
        @can('deletePermissions')
            <form method="post" action="{{route('admin.permissions.destroy')}}" autocomplete="off">
                @csrf
                <input type="hidden" name="todo" value="destroy_role">
                <input type="hidden" name="id" value="{{$permission->id}}">
                <div style="text-align: right;">
                    <input class="btn btn-danger btn-sm" type="submit" name="submit" value="Delete">
                </div>
            </form>
        @else
            <h2>Problem:</h2>
            <p>You don't have enough permissions to perform the requested action.</p>
        @endcan
	</section>
@stop
