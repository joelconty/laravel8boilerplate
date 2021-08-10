@extends('adminlte::page')

@section('content')

	<h1>Add New Permission</h1>

    @include('partials.flash')

    @can('createPermissions')
        <form method="POST" action="{{route('admin.permissions.store')}}">
            @csrf
            <table class="table table-striped">
                <tr>
                    <td>
                        <label for="name">Permission Name:</label>
                    </td>
                    <td>
                        <input name="name" type="text" id="name" value="{{old('name')}}">
                        @error('name')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div style="text-align: right">
                            <input class="btn btn-success pull-right" type="submit" value="Add">
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    @else
        <h2>Problem:</h2>
        <p>You don't have enough permissions to perform the requested action.</p>
    @endcan
@stop
