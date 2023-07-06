<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> 帳號資料 </title>


    <!-- import font awesome -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css'
        integrity='sha512-HHsOC+h3najWR7OKiGZtfhFIEzg5VRIPde0kB0bG2QRidTQqf+sbfcxCTB16AcFB93xMjnBIKE29/MjdzXE+qw=='
        crossorigin='anonymous' />

    <!-- import CSS -->
    @vite('resources/css/app.css')
    @vite('resources/css/layout.css')
    @vite('resources/css/components/Nav.css')
    @vite('resources/css/components/SideMenu.css')
    @vite('resources/css/components/Breadcrumb.css')
    @vite('resources/css/pages/table.css')

</head>

<body>
    @include('layouts.adminAccountapp')

    <!-- Breadcrumb start ----- -->
    @include('breadcrumbs')
    <!-- Breadcrumb ends ------ -->

    <!-- back up for later update -->
    {{--     @livewireStyles
        @livewire('loginhistorytable')
        @livewireScripts --}}
    <!-- Container start ----- -->
    <section class="relative top-[68px] p-6 flex flex-col mx-auto max-w-3xl">

        <div>
            <h3 class="h2">登入紀錄</h3><p class="">(最近15筆)</p>
        </div>

        <table class="table table-auto mt-4">

            <thead>
                <tr>
                    <th>
                        登入時間
                    </th>
                    <th>
                        登入狀態
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach ($logs as $log)
                    <tr class="list-el">

                        <td class="login-time">
                            {{ $log->login_at }}
                        </td>
                        @switch($log->status)
                            @case(0)
                                <td class="is-failed">
                                    <span class="mr-1">
                                        <i class="fa-solid fa-xmark"></i>
                                    </span>
                                    登入失敗
                                </td>
                            @break

                            @case(1)
                                <td class="is-success">
                                    <span class="mr-1">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    登入成功
                                </td>
                            @break
                        @endswitch
                    </tr>
                @endforeach
            </tbody>

        </table>
    </section>
    <!-- Container ends ------ -->

</body>

</html>
