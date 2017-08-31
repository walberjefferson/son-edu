<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @php
        $navbar = Navbar::withBrand(config('app.name'), route('admin.dashboard'))->inverse();
        if (Auth::check()){
        $arrayLinks = [
            ['link' => route('admin.users.index'), 'title' => 'Usuário']
        ];
        $arrayLinksRight = [
        [
            Auth::user()->name,
            [
                [
                'link' => route('logout'),
                'title' => 'Logout',
                'linkAttributes' =>
                [
                'onclick' => "event.preventDefault(); document.getElementById(\"logout-form\").submit();"
                ]
                ]
            ]
        ]
        ];
        $navbar->withContent(Navigation::links($arrayLinks))->withContent(Navigation::links($arrayLinksRight)->right());
        $formLogout = FormBuilder::plain([
                'id' => 'logout-form',
                'url' => route('logout'),
                'method' => 'POST',
                'style' => 'display:none;'
            ]);
        }else{
        $arrayLinksRight = [
            ['link' => route('login'), 'title' => 'Login']
        ];
        $navbar->withContent(Navigation::links($arrayLinksRight)->right());
        }
    @endphp
    {!! $navbar !!}

    @if(Auth::check())
        {!! form($formLogout) !!}
    @endif

    @if(session()->has('message'))
        <div class="container">
            {!! Alert::success(session()->get('message'))->close() !!}
        </div>
    @endif



    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
