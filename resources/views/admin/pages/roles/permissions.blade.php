@extends('adminlte::page')

@section('content')

	<h1>Update permissions for role "{{ $role->name }}"</h1>
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<form method="post" action="{{route('roles.updatepermissions')}}">
		{!! csrf_field() !!}
		<input type="hidden" name="role_id" value="{{$role->id}}">
		<table class="table">
			<thead>
			<th>Permission</th>
			<th>Description</th>
			<th>Role has permission?</th>
			</thead>
			@forelse($permissions as $permission)
				<tr>
					<td>
						{{$permission->name}}
					</td>
                    <td>
                        {{ $permission->description }}
                    </td>
					<td>
						@if ( isset($rolepermissions[$permission->id]))
							<input type="checkbox" name="permission_id[{{$permission->id}}]" value="1" checked>
						@else
							<input type="checkbox" name="permission_id[{{$permission->id}}]" value="1">
						@endif
					</td>
				</tr>
            @empty
                <tr>
                    <td colspan="3">
                        No permission assigned to the current role.
                    </td>
                </tr>
			@endforelse

		<tr>
			<td colspan="3" align="right">
				<input class="btn btn-primary pull-right" type="submit" value="Update">
			</td>
		</tr>
		</table>
	</form>
@stop
