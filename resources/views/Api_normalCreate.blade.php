<head>
    <title>模擬美容鏡檢測數據</title>
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
        <button id="10times" class="">100次</button>

        <br><br>

        <div id="filter">

        </div>
{{--     <center><br><br><br><br><br>
        新增檢測結果
        <br>
        ----------------------------------------
        <form id="form">
            膚色結果-區域A: <input name=""> <br>
            膚色結果-區域B: <input name=""> <br>
            膚色結果-區域E: <input name=""> <br>
            膚色結果-區域F: <input name=""> <br>
            色斑結果-區域A: <input name=""> <br>
            色斑結果-區域B: <input name=""> <br>
            黑眼圈結果-區域B: <input name=""> <br>
            黑眼圈結果-區域C: <input name=""> <br>
            青春痘結果-區域A: <input name=""> <br>
            青春痘結果-區域B: <input name=""> <br>
            青春痘結果-區域C: <input name=""> <br>
            青春痘結果-區域D: <input name=""> <br>
            油水平衡結果-區域A: <input name=""> <br>
            油水平衡結果-區域A: <input name=""> <br>
            抬頭紋結果: <input name=""> <br>
            眉間紋結果: <input name=""> <br>
            魚尾紋結果-區域B: <input name=""> <br>
            魚尾紋結果-區域C: <input name=""> <br>
            淚溝紋結果-區域B: <input name=""> <br>
            淚溝紋結果-區域C: <input name=""> <br>
            法令紋結果-區域D: <input name=""> <br>
            法令紋結果-區域E: <input name=""> <br>
            <br><br>
            <button type="button">送出</button>
        </form>
        ----------------------------------------
    </center> --}}

    </div>
    <div class="right" id="right">


    </div>
</div><!--wrap-->

<script>
    var left = document.querySelector('#left');
    var post = document.querySelector("#right");
    const http="http://";
    const host= window.location.host;
    const link= http+host;

    fetch(link+"/api/normalinspection/")
      .then((response) => response.json())
      .then((json) => {
        const result=json.result;
        for(var i=0; i<result.length; i++)
        {
            const p=document.createElement("a");
            const content_title=document.createTextNode("檢測ID"+json.result[i].bmni_id+"分數"+json.result[i].bmni_result_rating+"優勝於"+json.result[i].bmni_result_ranking+"%的用戶");
            var br = document.createElement("br");
            //console.log(result[i].created_at);
            post.appendChild(p);
            p.appendChild(content_title);
            p.href=link+`/apipad/${json.result[i].bmni_id}`;
            post.appendChild(br);

        };
/*             const m=document.createElement("p");
            const min=document.createTextNode("下限:"+json.data_all.min);
            left.appendChild(m);
            m.appendChild(min); */
            console.log("總數:"+json.data_all.counts);
            console.log("最佳分數:"+json.data_all.min);
            console.log("平均數:"+json.data_all.mid);
            console.log("最差分數:"+json.data_all.max);
            console.log('最差族群(高於100分之用戶):'+json.data_all.worst);
            console.log('最佳族群(低於50分之用戶):'+json.data_all.best);
            console.log('於10~30分之用戶數:'+json.data_all.dataIn10to30);
            console.log('於30~59分之用戶數:'+json.data_all.dataIn31to50);
            console.log('於50~70分之用戶數:'+json.data_all.dataIn51to70);
            console.log('於70~90分之用戶數:'+json.data_all.dataIn71to90);
            console.log('於90~150分之用戶數:'+json.data_all.dataMoreThan91);
            console.log('2023年02月14日 平均值:'+json.data_all.data20230214_mid);
            console.log('2023年02月15日 平均值:'+json.data_all.data20230215_mid);
            console.log('2023年02月16日 平均值:'+json.data_all.data20230216_mid);
            console.log('2023年02月17日 平均值:'+json.data_all.data20230217_mid);
            console.log('2023年02月20日 平均值:'+json.data_all.data20230220_mid);
            //console.log("平均值:"+json.data_all.avg);


      });
</script>

<script>
    const onetime=document.getElementById('1time');
    const tentimes=document.getElementById('10times');
    const autoclickone=document.querySelector('.one');
    var p=0;
    //setInterval(" mutiCreate(200)",30000);

    onetime.addEventListener('click', function(){
        mutiCreate(0);
        document.location.reload();
    })

    function mutiCreate(num)
    {
        var i=0;

        for ( i=0; i<=num; i++)
        {
            sim_result();
            //console.log(i);
            p=p+1;
        }
        console.log(p);

    }

    tentimes.addEventListener('click', function(){

        mutiCreate(99);
        //document.location.reload();

    })
    function RamdomData(min,max)
    {
        return Math.floor(Math.random()*(max-min+1))+min;
    }

    function sim_result()
    {
        var bmni_head=RamdomData(0,10);

        var bmni_eyebrow=RamdomData(0,10);

        var bmni_fishtail_b=RamdomData(0,10);
        var bmni_fishtail_c=RamdomData(0,10);

        var bmni_tears_b=RamdomData(0,10);
        var bmni_tears_c=RamdomData(0,10);

        var bmni_nasolabial_d=RamdomData(0,10);
        var bmni_nasolabial_e=RamdomData(0,10);

        var bmni_mouth=RamdomData(0,10);

        var bmni_skin=RamdomData(-90,90);
        var bmni_skin_a=bmni_skin;
        var bmni_skin_b=bmni_skin;
        var bmni_skin_e=bmni_skin;
        var bmni_skin_f=bmni_skin;

        var bmni_pigmentation=RamdomData(100,0);
        var bmni_pigmentation_a=bmni_pigmentation;
        var bmni_pigmentation_b=bmni_pigmentation;

        var bmni_pandaeye_b=RamdomData(1,8);
        var bmni_pandaeye_c=RamdomData(1,8);

        var bmni_acne_a=RamdomData(0,4);
        var bmni_acne_b=RamdomData(0,4);
        var bmni_acne_c=RamdomData(0,4);
        var bmni_acne_d=RamdomData(0,4);

        var bmni_waterOil=RamdomData(0,20);
        var bmni_waterOil_d=bmni_waterOil;
        var bmni_waterOil_e=bmni_waterOil;

        var url = link+"/api/normalinspection";
        fetch(url, {
        method: 'POST', // or 'PUT'
        body: JSON.stringify({

            'bmni_head':bmni_head,

            'bmni_eyebrow':bmni_eyebrow,

            'bmni_fishtail_b':bmni_fishtail_b,
            'bmni_fishtail_c':bmni_fishtail_c,

            'bmni_tears_b':bmni_tears_b,
            'bmni_tears_c':bmni_tears_c,

            'bmni_nasolabial_d':bmni_nasolabial_d,
            'bmni_nasolabial_e':bmni_nasolabial_e,

            'bmni_mouth':bmni_mouth,

            'bmni_skin_a':bmni_skin_a,
            'bmni_skin_b':bmni_skin_b,
            'bmni_skin_e':bmni_skin_e,
            'bmni_skin_f':bmni_skin_f,

            'bmni_pigmentation_a':bmni_pigmentation_a,
            'bmni_pigmentation_b':bmni_pigmentation_b,

            'bmni_pandaeye_b':bmni_pandaeye_b,
            'bmni_pandaeye_c':bmni_pandaeye_c,

            'bmni_acne_a':bmni_acne_a,
            'bmni_acne_b':bmni_acne_b,
            'bmni_acne_c':bmni_acne_c,
            'bmni_acne_d':bmni_acne_d,

            'bmni_waterOil_d':bmni_waterOil_d,
            'bmni_waterOil_e':bmni_waterOil_e,


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
