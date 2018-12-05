<?php session_start();?>

@extends('layouts/master', ['title' => 'Login'])

    @section('header_body')
    <?php $_SESSION['header_create'] = "";?>
    <?php $_SESSION['header_delete'] = "";?>
    <?php $_SESSION['header_edit'] = "";?>
    @endsection

@section('main_body')
    <body ng-app="mainModule" ng-controller="mainController">
    <div id="login-page" class="row">
        <div class="col s12 z-depth-6 card-panel">
            <form class="login-form" action="/login" method="post">
                @csrf
                <div class="row"></div>
                <center><img class="responsive-img" style="width: 65%;" src="/assets/pics/Alcatel_Lucent_Enterprise_Logo.png.png"></center>
                <div class="row"></div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">code</i>
                        <input name="url" type="text" value="o2g-instance1.ale-aapp.com">
                        <label for="url">URL (ex: o2g-shared-sandboxe.ale-aapp.com)</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input class="validate" name="username" type="text">
                        <label for="username" data-error="wrong" data-success="Ok">Username</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock_outline</i>
                        <input name="password" type="password">
                        <label for="password" data-error="wrong" data-success="Ok">Password</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m12 l12  login-text">
                        <input type="checkbox" id="remember-me" />
                        <label for="remember-me">Remember me</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button href="#" type="submit" name="buttonLogIn" class="btn waves-effect waves-light col s12">Login</button>
                    </div>
                </div>
                <div class="row">
                    <br />
                </div>
            </form>
        </div>
    </div>
    </body>
</main>
@endsection