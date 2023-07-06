<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> 後台管理入口 </title>


    <!-- import font awesome -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css'
        integrity='sha512-HHsOC+h3najWR7OKiGZtfhFIEzg5VRIPde0kB0bG2QRidTQqf+sbfcxCTB16AcFB93xMjnBIKE29/MjdzXE+qw=='
        crossorigin='anonymous' />


    {{-- import CSS --}}
    @vite('resources/css/app.css')
    @vite('resources/css/layout.css')
    @vite('resources/css/components/Nav.css')
    @vite('resources/css/components/SideMenu.css')
    @vite('resources/css/components/Breadcrumb.css')


</head>

<body>
    @yield('content')
</body>

</html>
