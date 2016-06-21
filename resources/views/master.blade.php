<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Env Setting</title>
    <meta name="description" content="Set your .env file">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://opensource.keycdn.com/fontawesome/4.6.3/font-awesome.min.css" integrity="sha384-Wrgq82RsEean5tP3NK3zWAemiNEXofJsTwTyHmNb/iL3dP/sZJ4+7sOld1uqYJtE" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('css/skeleton.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>
<body>

<!-- Primary Page Layout
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<div class="appnav"></div>
<div class="container">
    @yield('content')
</div>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<script src="{{asset('js/index.js')}}"></script>
@yield('script')

</body>
</html>
