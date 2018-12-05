<?php session_start();?>

@extends('layouts/master', ['title' => 'Edit User'])

@section('header_body')
@endsection

@section('main_body')
<body ng-app="mainModule" ng-controller="mainController">
<div id="login-page" class="row">
    <div class="col s12 z-depth-6 card-panel">
        <div class="row"></div>
        <center><img class="responsive-img" style="width: 65%;" src="/assets/pics/Alcatel_Lucent_Enterprise_Logo.png.png"></center>
        <div class="row"></div>
        <ul id="tabs-swipe" class="tabs">
            <li class="tab col s3"><a class="teal-text" href="#createTab">Create user</a></li>
            <li class="tab col s3"><a class="teal-text" href="#deleteTab">Delete User</a></li>
            <li class="tab col s3"><a class="active teal-text" href="#modifieTab">Edit user</a></li>
        </ul>
        <div id="createTab" class="col s12 teal-text">
            @include('layouts/partials/_create_form')
            @include('layouts/partials/_disp_form')
            @include('layouts/partials/_log_out_form')
        </div>
        <div class="row">
            <div class="row">
                <div id="deleteTab" class="col s12 teal-text">

                    @include('layouts/partials/_delete_form')

                        <div class="row">

                            @include('layouts/partials/_disp_form')

                            @include('layouts/partials/_log_out_form')

                        </div>
                </div>
                <div id="modifieTab" class="col s12 teal-text">

                    @include('layouts/partials/_edit_form')

                    <div class="row">

                        @include('layouts/partials/_disp_form')

                        @include('layouts/partials/_log_out_form')

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection

<script>
    if ("<?php echo $_SESSION['header_edit'] ?>" != "") {
        setTimeout(function() { window.Materialize.toast("<?php echo $_SESSION['header_edit'] ?>", 5000) }, 500);
        <?php echo $_SESSION['header_edit'] = "" ;?>
    }
</script>

<script type="text/javascript">
    function submitForm(action) {
        alert("mdemdemdem");
        var form = document.getElementById('login-form');
        form.action = action;
        form.submit();
    }
</script>