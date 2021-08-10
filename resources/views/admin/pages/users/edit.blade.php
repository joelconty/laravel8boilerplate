@extends('adminlte::page')

@section('content')
	<h1>User Update</h1>
    <br>
    @include('partials.flash')
    @can('editUsers')
        <form method="post" action="{{route('admin.users.update')}}">
            @csrf
            <input type="hidden" name="id" value="{{$user->id}}">
            <input type="hidden" name="option" value="userinfo">

            <table class="table">
                <thead>
                    <th colspan="2">Edit User Info</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <label for="username">Username:</label>
                        </td><td>
                            @if ($errors->any())
                                @error('password')
                                    <input name="username" type="text" id="username" value="{{$user->username}}">
                                @else
                                    <input name="username" type="text" id="username" value="{{old('username')}}">
                                @enderror
                            @else
                                <input name="username" type="text" id="username" value="{{$user->username}}">
                            @endif
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
                            @if ($errors->any())
                                @error('password')
                                    <input name="firstname" type="text" id="firstname" value="{{$user->firstname}}">
                                @else
                                    <input name="firstname" type="text" id="firstname" value="{{old('firstname')}}">
                                @enderror
                            @else
                                <input name="firstname" type="text" id="firstname" value="{{$user->firstname}}">
                            @endif
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
                            @if ($errors->any())
                                @error('password')
                                    <input name="lastname" type="text" id="lastname" value="{{$user->lastname}}">
                                @else
                                    <input name="lastname" type="text" id="lastname" value="{{old('lastname')}}">
                                @enderror
                            @else
                                <input name="lastname" type="text" id="lastname" value="{{$user->lastname}}">
                            @endif
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
                            @if ($errors->any())
                                @error('password')
                                    <input name="email" type="text" id="email" value="{{$user->email}}">
                                @else
                                    <input name="email" type="text" id="email" value="{{old('email')}}">
                                @enderror
                            @else
                                <input name="email" type="text" id="email" value="{{$user->email}}">
                            @endif
                            @error('email')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div style="text-align: right">
                                <input class="btn btn-primary pull-right" type="submit" value="Update">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

        <form method="post" action="{{route('admin.users.update')}}">
            @csrf
            <input type="hidden" name="id" value="{{$user->id}}">
            <input type="hidden" name="option" value="userpassword">
            <table class="table">
                <thead>
                    <th colspan="2">Edit Password</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <label for="password">New Password:</label>
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
                            <label for="password">Confirm new password:</label>
                        </td><td>
                            <input name="password_confirmation" type="password" value="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div style="text-align: right">
                                <input class="btn btn-primary pull-right" type="submit" value="Update">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    @else
        <h2>Problem:</h2>
        <p>You don't have enough permissions to perform the requested action.</p>
    @endcan

@stop
