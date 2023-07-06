{{-- @extends('layouts.adminloginapp')

@section('content')
    <!-- import CSS -->
    <link rel="stylesheet" href="{{ asset('css/page-style/login-page.css') }}">
    <body>
        <!-- Nav start ----- -->
        <nav class="navbar is-fixed-top has-shadow" role="navigation" aria-label="main navigation">
            <div class="navbar-start">
                <a class="navbar-item title is-3" href="{{'/'}}">
                    <i class="fa-solid fa-swatchbook"></i>
                    <span class="site-title"> 後臺管理介面 </span>
                </a>
            </div>
        </nav>
        <!-- Nav ends ------ -->
        <!-- iframe start ----- -->
        <section class="iframe">
            <!-- Container start ----- -->
            <section class="container is-fluid">
                <!-- Box start ----- -->
                <form class="box" method="POST" action="{{ route('admin.forgetpassword.post') }}" >
                    <center>
                        @if(isset($error))
                            {{$error}}
                        @endif
                        <br>
                        <div class="buttons">
                            <a href="{{route('admin.main')}}"> 按我回到系統 </a>
                        </div>
                    </center>
                </form>
                <!-- Box ends ------ -->
            </section>
            <!-- Container ends ------ -->
        </section>
        <!-- iframe ends ------ -->
        <script src="{{asset('javascript/login-record.js')}}"></script>
    </body>

@endsection
 --}}

 <title> 後台管理入口 </title>
    <div class="text">
        <div>錯誤</div>
            <h1>{{$error}}</h1>
        <hr>
        @if(isset($error))
        <div><a href="{{route('admin.main')}}"  style="text-decoration:none;color:white;"> 按我回到系統 </a></div>
        @endif
    </div>

    <div class="astronaut">
       {{--  <img src="https://images.vexels.com/media/users/3/152639/isolated/preview/506b575739e90613428cdb399175e2c8-space-astronaut-cartoon-by-vexels.png" alt="" class="src"> --}}
    </div>

    <style>
body{
  margin:0;
  padding:0;
  font-family: 'Tomorrow', sans-serif;
  height:100vh;
background-image: linear-gradient(to top, #2e1753, #1f1746, #131537, #0d1028, #050819);
  display:flex;
  justify-content:center;
  align-items:center;
  overflow:hidden;
}
.text{
  position:absolute;
  top:40%;
  color:#fff;
  text-align:center;
}
h1{
  font-size:50px;
}
.star{
  position:absolute;
  width:2px;
  height:2px;
  background:#fff;
  right:0;
  animation:starTwinkle 3s infinite linear;
}
.astronaut img{
  width:100px;
  position:absolute;
  top:55%;
  animation:astronautFly 6s infinite linear;
}
@keyframes astronautFly{
  0%{
    left:-100px;
  }
  25%{
    top:50%;
    transform:rotate(30deg);
  }
  50%{
    transform:rotate(45deg);
    top:55%;
  }
  75%{
    top:60%;
    transform:rotate(30deg);
  }
  100%{
    left:110%;
    transform:rotate(45deg);
  }
}
@keyframes starTwinkle{
  0%{
     background:rgba(255,255,255,0.4);
  }
  25%{
    background:rgba(255,255,255,0.8);
  }
  50%{
   background:rgba(255,255,255,1);
  }
  75%{
    background:rgba(255,255,255,0.8);
  }
  100%{
    background:rgba(255,255,255,0.4);
  }
}
    </style>
    <script>
        document.addEventListener("DOMContentLoaded",function(){

        var body=document.body;
        setInterval(createStar,100);
        function createStar(){
            var right=Math.random()*500;
            var top=Math.random()*screen.height;
            var star=document.createElement("div");
        star.classList.add("star")
        body.appendChild(star);
        setInterval(runStar,10);
            star.style.top=top+"px";
        function runStar(){
            if(right>=screen.width){
            star.remove();
            }
            right+=3;
            star.style.right=right+"px";
        }
        }
        })
    </script>

