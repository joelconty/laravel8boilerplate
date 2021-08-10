@extends('adminlte::page')

@section('content')

	<h1>Permissions</h1>
    @include('partials.flash')

    @can('createPermissions')
        <div style="text-align: right; margin-bottom: 12px;">
            <a href="{{route('admin.permissions.create')}}" class="btn btn-success btn-sm">Add New Permission</a>
        </div>
    @endcan

	@if ($permissions->count())
        @can('viewPermissions')
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach ($permissions as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            @can('editPermissions')
                                <a href="{{route('admin.permissions.edit', $role->id)}}" class="btn btn-info btn-sm">Edit</a>
                            @endcan
                        </td>
                        <td>
                            @can('deletePermissions')
                                <a href="{{route('admin.permissions.delete', $role->id)}}" class="btn btn-danger btn-sm">Delete</a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h2>Problem:</h2>
            <p>You don't have enough permissions to perform the requested action.</p>
        @endcan
	@else
        There are no permissions currently in the system. Click on the "Add Permission" button above to create new permissions.
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

			/*
			Label the data
				You could also use a data-* attribute and content for this. That way "bloats" the HTML, this way means
				you need to keep HTML and CSS in sync. Lea Verou has a clever way to handle with text-shadow.
				<th>Id</th>
				<th>Tag</th>
				<th>Activo</th>
				<th>Streaming</th>
				<th>Mensajes Total</th>
				<th>Mens. Pendientes</th>
				<th>Fecha Creación</th>
				<th>Acciones</th>
			*/

			td:nth-of-type(1):before {
				content: "Id: ";
			}

			td:nth-of-type(2):before {
				content: "Name: ";
			}

			td:nth-of-type(3):before {
				content: "Display Name: ";
			}

			td:nth-of-type(4):before {
				content: "Description: ";
			}

			td:nth-of-type(5):before {
				content: "Edit: ";
			}

			td:nth-of-type(6):before {
				content: "Delete: ";
			}

			td:nth-of-type(7):before {
				content: "";
			}

			td:nth-of-type(8):before {
				content: "";
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
