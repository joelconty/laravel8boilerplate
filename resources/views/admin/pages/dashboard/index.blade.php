@extends('adminlte::page')

@section('content')


    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{$userscount}}</h3>
                        <p>Registered Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('admin.users.index')}}" class="small-box-footer">Go <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>




            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>{{$rolescount}}</h3>
                        <p>Existing Roles</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('admin.roles.index')}}" class="small-box-footer">Go <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>




            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{$permissionscount}}</h3>
                        <p>Existing Permissions</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('admin.permissions.index')}}" class="small-box-footer">Go <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>



        </div>
    </section>

@stop
