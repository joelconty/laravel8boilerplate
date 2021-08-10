@extends('adminlte::page')


@section('content')

	<h1>Roles</h1>
    <h4>[To turn on/off a permission associated to a role, click on the respective button]</h4>
    @include('partials.flash')

    @can('createRoles')
	    <div style="text-align: right; margin-bottom: 14px;">
            <a href="{{route('admin.roles.create')}}" class="btn btn-success btn-sm">Add New Role</a>
        </div>
    @endcan

	@if ($roles->count())
		<table class="table table-striped table-bordered">
			<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Related Permissions</th>
				<th colspan="2">Actions</th>
			</tr>
			</thead>

			<tbody>
			@foreach ($roles as $role)
				<tr>
					<td>{{ $role->id }}</td>
					<td>{{ $role->name }}</td>
                    <td>
                        @foreach ( $allpermissions as $permission)
                            @if ( in_array($permission, $rolePermissions[$role->id]))
                                <a href="{{route('admin.rolepermissionupdates', [$role->name, $permission, 'off'])}}"
                                   class="btn btn-light btn-sm"
                                   style="border: solid 1px green; color: green; font-weight: bold;"
                                >
                                    {{$permission}}
                                    <img src="/images/ok.png" width="12" height="12">
                                </a>
                            @else
                                <a href="{{route('admin.rolepermissionupdates', [$role->name, $permission, 'on'])}}"
                                   class="btn btn-light btn-sm"
                                   style="border: solid 1px gray; background-color: lightgrey;"
                                >
                                    {{$permission}}
                                </a>
                            @endif
                        @endforeach
                    </td>
					<td>
                        @can('editRoles')
                            <a href="{{route('admin.roles.edit', $role->id)}}" class="btn btn-primary btn-sm">Edit</a>
                        @endcan
                    </td>
					<td>
                        @can('deleteRoles')
                            <a href="{{route('admin.roles.delete', $role->id)}}" class="btn btn-danger btn-sm">Delete</a>
                        @endcan
                    </td>
				</tr>
			@endforeach
			</tbody>
		</table>

	@else
        At this moment there are no roles in the system. Click on the 'Add Role' button above to add roles.
	@endif



	<style>
		/*
		Max width before this PARTICULAR table gets nasty. This query will take effect for any screen smaller than
		760px and also iPads specifically.
		*/
		@media only screen
		and (max-width: 760px), (min-device-width: 768px)
		and (max-device-width: 1024px) {

			/* Force table to not be like tables anymore */
			table, thead, tbody, th, td, tr {
				display: block;
			}

			/* Hide table headers (but not display: none;, for accessibility) */
			thead tr {
				position: absolute;
				top: -9999px;
				left: -9999px;
			}

			tr {
				margin: 0 0 1rem 0;
			}

			tr:nth-child(odd) {
				background: #ccc;
			}

			td {
				/* Behave  like a "row" */
				border: none;
				border-bottom: 1px solid #eee;
				position: relative;
				padding-left: 50%;
			}

			td:before {
				/* Now like a table header */
				/*position: absolute;*/
				/*!* Top/left values mimic padding *!*/
				top: 0;
				left: 6px;
				width: 45%;
				padding-right: 10px;
				white-space: nowrap;
			}

			td:nth-of-type(1):before {
				content: "Id: ";
			}

			td:nth-of-type(2):before {
				content: "Name: ";
			}

			td:nth-of-type(3):before {
				content: "Related Permissions: ";
			}

			td:nth-of-type(4):before {
				content: "Edit: ";
			}

			td:nth-of-type(5):before {
				content: "Delete: ";
			}

		}
	</style>
@stop
