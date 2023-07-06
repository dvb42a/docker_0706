{{-- <h1>驗證你的email</h1>


<a href="{{route('account.checkedEmail', $token)}}">點我驗證你的電郵地址</a> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> 後台管理入口 </title>

    <style>
        * {
            padding: 0;
            margin: 0;
        }

        .container {
            display: flex;
            padding: 2rem;
            justify-content: center;
            align-items: center;
            max-height: 100vh;
            background: hsl(172, 28%, 80%);
        }

        .box {
            position: relative;
            background: #fff;
            margin: auto;
            max-width: 800px;
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 0.5em 1em -0.125em rgba(0, 0, 0, 0.1);
        }

        .small-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .box p {
            margin: 1rem 0;
            font-size: 1.2rem;
        }

        .highlight-text {
            color: hsl(348, 100%, 61%);
            font-weight: 700;
        }

        hr {
            margin: 1rem 0;
        }

        .info-text {
            color: hsl(0, 0%, 48%);
            background-color: #fff;
        }

        .verity-btn {
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: 1%;
        }


        /* .verity-btn {
            background: #113051;
            border: none;
            padding: .5rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 1rem;
            color: #fff;
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.3);
            text-decoration: none;

            width: 200px;
        }

        .verity-btn:hover {
            background-color: #1d518a;
        } */

    </style>

</head>

<body>


    <!-- Container start ----- -->
    <section class="container">

        <!-- Box start ----- -->
        <div class="box">

            <h4 class="small-title"> 你好! </h4>
            <p>
                歡迎使用美容百科後台管理系統！這是自動發送的電子郵件認證信件，
                請在
                <span class="highlight-text">
                    15 分鐘
                </span>
                內確定點選下方按鈕驗證電子郵件。
            </p>

            <p>
                若超過時間此連結便會失效，請重新申請驗證信。
            </p>

            <br>

            <a class="verity-btn" href="{{ route('account.checkedEmail', $token) }}">
                驗證電郵地址 >>
            </a>

            <hr>

            <p class="info-text">
                有其他疑問請聯繫系統管理員 :
                <a href="admin@email.com" target="_blank">
                    admin@email.com
                </a>
            </p>


        </div>
        <!-- Box ends ------ -->


    </section>
    <!-- Container ends ------ -->






</body>

</html>
