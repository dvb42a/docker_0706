<script>
    var CSRF_TOKEN = '<?= csrf_token(); ?>';
    console.log(CSRF_TOKEN);

    var cookie = document.cookie;
    console.log(cookie);
    </script>
    <div id="timer">
    <p id="time">10</p>
  </div>

  <button onclick="start()">start</button>

  <button id="submit"> submit</button>

  @foreach($admins->admins as $admin)
        {{$admin->name}}
  @endforeach

<script>
    const submit = document.getElementById('submit');
    var timeout=document.getElementById('timer').innerText;
    start();
    submit.disabled=true;
    //consoloe.log()
    function start()
    {
        //   按下 start 後 id 為 timer 的 DIV 內容可以開始倒數到到 0。
        var timer = document.querySelector("#timer");
        var number = 10;
        setInterval(function()
        {
            number -- ;
            if(number <= 0 )
            number = 0;
            timer.innerText = number + 0
            if(number ==0)
            {
                submit.disabled=false;
            }
        }, 1000);


    }



</script>
