
<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <title>  {{ $title }} </title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css'>
    <link rel='stylesheet' href='https://cdn.materialdesignicons.com/1.1.34/css/materialdesignicons.min.css'>
    <link rel="stylesheet" href="/assets/materialize/css/style.css">
</head>

<body>

    <header>
        @yield('header_body')
    </header>

    <main>
        @yield('main_body')
    </main>

</body>

<!-- <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js'></script> -->
<script src='/assets/js/jquery_2.1.3.min.js'></script>
<script src='/assets/materialize/js/materialize_0.97.6.min.js'></script>
<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>

@yield('script')

</html>