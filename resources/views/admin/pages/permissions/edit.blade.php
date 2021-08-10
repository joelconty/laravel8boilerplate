@extends('adminlte::page')

@section('content')
    <h1>Edit Permission</h1>

    <section>
        @include('partials.flash')

        @can('editPermissions')
            <form method="post" action="{{route('admin.permissions.update')}}" autocomplete="off">
                @csrf
                <input type="hidden" name="id" value="{{$permission->id}}">

                <table class="table">
                    <tr>
                        <td>Id</td>
                        <td>{{$permission->id}}</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>
                            <input type="text" name="name" value="{{$permission->name}}" size="25">
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
