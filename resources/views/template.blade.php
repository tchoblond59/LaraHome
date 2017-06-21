<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Lara Home</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{asset('css/bulma.css')}}" />
        <link rel="stylesheet" href="{{asset('css/custom.css')}}" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <body>
    <nav class="nav has-shadow">
        <div class="container">
            <div class="nav-left">
                <a class="nav-item">
                    <img src="http://bulma.io/images/bulma-logo.png" alt="Bulma logo">
                </a>
                <a class="nav-item is-tab is-hidden-mobile is-active">Home</a>
            </div>
    <span class="nav-toggle">
      <span></span>
      <span></span>
      <span></span>
    </span>
            <div class="nav-right nav-menu">
                <a class="nav-item is-tab is-hidden-tablet is-active">Home</a>
                <a class="nav-item is-tab is-hidden-tablet">Features</a>
                <a class="nav-item is-tab is-hidden-tablet">Pricing</a>
                <a class="nav-item is-tab is-hidden-tablet">About</a>
                <a class="nav-item is-tab">
                    <figure class="image is-16x16" style="margin-right: 8px;">
                        <img src="http://bulma.io/images/jgthms.png">
                    </figure>
                    Profile
                </a>
                <a class="nav-item is-tab">Log out</a>
            </div>
        </div>
    </nav>
    @yield('content')
    </body>
</html>
