<head>
    <title>模擬會員帳號新增</title>
</head>
<style>
.wrap{ /*父元素*/
    width: 100%;
    height: 200px;
    display: flex;
    justify-content: space-between;
}
.left{

    width: 50%;
    height: 200px;
}
.right{

    width: 50%;
    height: 200px;
}
</style>
<div class="wrap"><!--父元素-->
    <div class="left">

        <button id="1time" class="one">1次</button>
        <button id="10times" class="">50次</button>

        <br><br>

        <div id="filter">

        </div>

    </div>
    <div class="right" id="right">


    </div>
</div><!--wrap-->


<script>
    const http="http://";
    const host= window.location.host;
    const link= http+host;
    const onetime=document.getElementById('1time');
    const tentimes=document.getElementById('10times');
    const autoclickone=document.querySelector('.one');
    var p=0;
    //setInterval(" mutiCreate(200)",30000);

    onetime.addEventListener('click', function(){
        mutiCreate(0);
        //document.location.reload();
    })

    function mutiCreate(num)
    {
        var i=0;

        for ( i=0; i<=num; i++)
        {
            sim_result();
            console.log(i);
            p=p+1;
        }
        //console.log(p);

    }

    tentimes.addEventListener('click', function(){

        mutiCreate(50);
        //document.location.reload();

    })
    function RamdomData(min,max)
    {
        return Math.floor(Math.random()*(max-min+1))+min;
    }

    function sim_result()
    {
        var ramdom=RamdomData(0,1000000);
        var username = "ac"+ramdom;
        var email = "ac"+ramdom+"@gmail.com";
        var password = "88888888";

        var url = link+"/api/register";
        //console.log(url);
        fetch(url, {
        method: 'POST', // or 'PUT'
        body: JSON.stringify({
            'username':username,
            'email':email,
            'password':password,
        }), // data can be `string` or {object}!
        headers: new Headers({
            'Content-Type': 'application/json'
        })
        }).then(res => res.json())
        //.catch(error => console.error('Error:', error))
        .then(function () {


        });

    }


</script>
