@extends('adminlte::page')

@section('content')
    <h1>Edit Role</h1> {{$role->name}}

	<section>
        @include('partials.flash')

        @can('editRoles')
            <form method="post" action="{{route('admin.roles.update')}}" autocomplete="off">
                {!! csrf_field() !!}
                <input type="hidden" name="id" value="{{$role->id}}">

                <table class="table">
                    <tr>
                        <td>Role Id</td>
                        <td>{{$role->id}}</td>
                    </tr>
                    <tr>
                        <td>Current Role Name</td>
                        <td>
                            {{$role->name}}
                        </td>
                    </tr>
                    <tr>
                        <td>New Role Name</td>
                        <td>
                            <input type="text" name="name" value="{{old('name')}}" size="25">
                            @error('name')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </td>
                    </tr>
                </table>
                <div style="text-align: right;">
                    <input class="btn bg-blue pull-right" type="submit" name="submit" value="Update">
                </div>
            </form>
        @else
            <h2>Problem:</h2>
            <p>You don't have enough permissions to perform the requested action.</p>
        @endcan
	</section>
@stop
