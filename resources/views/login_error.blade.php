<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css'>
    <link rel='stylesheet' href='https://cdn.materialdesignicons.com/1.1.34/css/materialdesignicons.min.css'>
    <link rel="stylesheet" href="/assets/materialize/css/style.css">
</head>

<body>

<header>
    <script> alert("Bad username and/or password"); </script>
</header>

<main>
    <body ng-app="mainModule" ng-controller="mainController">
    <div id="login-page" class="row">
        <div class="col s12 z-depth-6 card-panel">
            <form class="login-form" action="authenticate.php" method="post">
                <div class="row"></div>
                <center><img class="responsive-img" style="width: 65%;" src="/assets/pics/Alcatel_Lucent_Enterprise_Logo.png.png"></center>
                <div class="row"></div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">code</i>
                        <input name="url" type="url">
                        <label for="url">URL (ex: o2g-shared-sandboxe.ale-aapp.com)</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input class="validate" name="username" type="text">
                        <label for="email" data-error="wrong" data-success="Ok">Username</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock_outline</i>
                        <input name="password" type="password">
                        <label for="password">Password</label>
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
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js'></script>
</body>

</html>
