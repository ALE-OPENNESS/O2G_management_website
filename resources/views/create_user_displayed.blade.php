<?php //session_start();?>

@extends('layouts/master', ['title' => 'Create User'])

@section('header_body')
@endsection

    <?php /*print("AlcCookie = "); print($_SESSION['AlcCookie']);*/ ?>

@section('main_body')
<div style="display: flex;">

    <body ng-app="mainModule" ng-controller="mainController">
    <div id="login-page" class="row">
        <div class="col s12 z-depth-6 card-panel">
            <div class="row"></div>
            <center><img class="responsive-img" style="width: 65%;" src="/assets/pics/Alcatel_Lucent_Enterprise_Logo.png.png"></center>
            <div class="row"></div>
            <ul id="tabs-swipe" class="tabs">
                <li class="tab col s3"><a class="active teal-text" href="#createTab">Create user</a></li>
                <li class="tab col s3"><a class="teal-text" href="#deleteTab">Delete User</a></li>
                <li class="tab col s3"><a class="teal-text" href="#modifieTab">Edit user</a></li>
            </ul>
            <div id="createTab" class="col s12 teal-text">
                @include('layouts/partials/_create_form')
                @include('layouts/partials/_undisp_form', ['route' => '/user/create'])
                @include('layouts/partials/_log_out_form')
            </div>
            <div class="row">
                <div class="row">
                    <div id="deleteTab" class="col s12 teal-text">

                        @include('layouts/partials/_delete_form')

                            <div class="row">

                                @include('layouts/partials/_undisp_form', ['route' => '/user/delete'])

                                @include('layouts/partials/_log_out_form')

                            </div>
                    </div>
                    <div id="modifieTab" class="col s12 teal-text">

                        @include('layouts/partials/_edit_form')

                        <div class="row">

                            @include('layouts/partials/_undisp_form', ['route' => '/user/edit'])

                            @include('layouts/partials/_log_out_form')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>

    &nbsp;&nbsp;&nbsp;&nbsp;
    @include('layouts/partials/_disp_user_div')

</div>

@endsection