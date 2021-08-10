@extends('adminlte::page')

@section('content')

	<h1>Users list</h1>
    <h4>[To turn on/off a role or permission for any user, click on the respective button]</h4>
    @include('partials.flash')

    @can('createUsers')
	    <p style="text-align: right;">
            <a class="btn btn-success btn-sm" href="{{route('admin.users.create')}}">Add User</a>
        </p>
    @endcan

	@if ($users->count())
		<table class="table table-striped table-bordered">
			<thead>
			<tr>
				<th>Username</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
                <th>Roles</th>
                <th>Permissions</th>
				<th colspan="3">Actions</th>
			</tr>
			</thead>

			<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{{ $user->username }}</td>
					<td>{{ $user->firstname }}</td>
					<td>{{ $user->lastname }}</td>
					<td>{{ str_replace("@", " @ ", $user->email) }}</td>
                    <td>
                        @foreach($allroles as $role)
                            @if ( in_array($role, $userRoles[$user->id]))
                                <a href="{{route('admin.userrolesupdates', [$user->id, $role, 'off'])}}"
                                   class="btn btn-light btn-sm"
                                   style="border: solid 1px green; color: green; font-weight: bold;"
                                >
                                    {{$role}}
                                    <img src="/images/ok.png" width="12" height="12">
                                </a>
                            @else
                                <a href="{{route('admin.userrolesupdates', [$user->id, $role, 'on'])}}"
                                   class="btn btn-light btn-sm"
                                   style="border: solid 1px gray; background-color: lightgrey;"
                                >
                                    {{$role}}
                                </a>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ( $allpermissions as $permission)
                            @if ( in_array($permission, $userPermissions[$user->id]))
                                <a href="{{route('admin.userpermissionsupdates', [$user->id, $permission, 'off'])}}"
                                   class="btn btn-light btn-sm"
                                   style="border: solid 1px green; color: green; font-weight: bold;"
                                >
                                    {{$permission}}
                                    <img src="/images/ok.png" width="12" height="12">
                                </a>
                            @else
                                <a href="{{route('admin.userpermissionsupdates', [$user->id, $permission, 'on'])}}"
                                   class="btn btn-light btn-sm"
                                   style="border: solid 1px gray; background-color: lightgrey;"
                                >
                                    {{$permission}}
                                </a>
                            @endif
                        @endforeach

                    </td>
					<td>
                        @can('editUsers')
                            <a class="btn btn-primary btn-sm" href="{{route('admin.users.edit', $user->id)}}">Edit</a>
                        @endcan
                    </td>
					<td>
                        @can('deleteUsers')
                            <a class="btn btn-danger btn-sm" href="{{route('admin.users.delete', $user->id)}}">Delete</a>
                        @endcan
                    </td>
				</tr>
			@endforeach

			</tbody>
		</table>

	@else
		No users found
	@endif

@stop



@section('css')
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
                content: "Username: ";
            }

            td:nth-of-type(2):before {
                content: "First Name: ";
            }

            td:nth-of-type(3):before {
                content: "Last Name: ";
            }

            td:nth-of-type(4):before {
                content: "Email: ";
            }

            td:nth-of-type(5):before {
                content: "Roles: ";
            }

            td:nth-of-type(6):before {
                content: "Permissions: ";
            }

            td:nth-of-type(7):before {
                content: "Edit User";
            }

            td:nth-of-type(8):before {
                content: "Delete User";
            }

            td:nth-of-type(9):before {
                content: "";
            }
            td:nth-of-type(10):before {
                content: "";
            }
        }
    </style>
@stop
