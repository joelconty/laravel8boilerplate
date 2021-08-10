@extends('adminlte::page')

@section('content')

	<h1>Create New User</h1>
    @include('partials.flash')

    @can('createUsers')
        <form method="post" action="{{route('admin.users.store')}}">
            @csrf
            <table class="table">
                <tr>
                    <td>
                        <label for="username">Username:</label>
                    </td><td>
                        <input name="username" type="text" id="username" value="{{old('username')}}">
                        @error('username')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="firstname">First Name:</label>
                    </td><td>
                        <input name="firstname" type="text" id="firstname" value="{{old('firstname')}}">
                        @error('firstname')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="lastname">Last Name:</label>
                    </td><td>
                        <input name="lastname" type="text" id="lastname" value="{{old('lastname')}}">
                        @error('lastname')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email:</label>
                    </td><td>
                        <input name="email" type="text" id="email" value="{{old('email')}}">
                        @error('email')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password">Password: </label>
                    </td><td>
                        <input name="password" type="password" value="" id="password">
                        @error('password')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password">Password Confirmation:</label>
                    </td><td>
                        <input name="password_confirmation" type="password" value="">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div style="text-align: right;">
                            <input class="btn btn-success" type="submit" value="Submit">
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
