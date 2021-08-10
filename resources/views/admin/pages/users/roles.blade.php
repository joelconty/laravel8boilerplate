@extends('adminlte::page')

@section('content')

	<h1>Update roles for user "{{ $user->name }}"</h1>
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<form method="post" action="{{route('adminusers.updateroles')}}">
		{!! csrf_field() !!}
		<input type="hidden" name="user_id" value="{{$user->id}}">
		<table class="table">
			<thead>
			<th>Role</th>
			<th>User has role?</th>
			</thead>
			@foreach($roles as $role)
				<tr>
					<td>
						{{$role->name}}
					</td>
					<td>
						@if ( in_array($role->id,$userroles))
							<input type="checkbox" name="role_id[{{$role->id}}]" value="1" checked>
						@else
							<input type="checkbox" name="role_id[{{$role->id}}]" value="1">
						@endif
					</td>
				</tr>
			@endforeach

		<tr>
			<td colspan="2">
				<input class="btn btn-primary pull-right" type="submit" value="Update">
			</td>
		</tr>
		</table>
	</form>
@stop
