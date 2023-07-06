<head>
    <title>模擬美容鏡 v1.0</title>
</head>

<article class="project-tablet">
    <center>
        <div class="screen-tablet" id="post" >
        </div>
        <div id="single_detention" hidden>
            <br><br><br><br><br><br>
            <p>延伸閱讀</p>
            ------------------------------------
            <div class="screen-tablet" id="read" >
            </div>
            ------------------------------------
        </div>
    </center>
</article>

<script>
    var post = document.querySelector("#post");
    var read = document.querySelector("#read");
    var skin_data = null;

    const http="http://";
    const host= window.location.host;
    const link= http+host;

    // 網址處理過程
    var nowUrl = window.location.href;
        let id = nowUrl.substring(nowUrl.lastIndexOf('/')+ 1);

    fetch(link+`/api/normalinspection/${id}`)
      .then((response) => response.json())
      .then((json) => {
        post.innerHTML = `
        ----------------<h1>一般檢測</h1><h4>檢測結果</h4>------------------
            <br>
            <p>${json.rawdata.created_at}</p>
            <h2>你的肌膚狀況高於${json.finalresult.ranking}%的用戶，分數為${json.finalresult.rating}</h2>
            <p>我是檢測結果總結</p>
            <p>皺紋等級: ${json.wrinkle.level}</p>
            <a href="javascript:skin_info()">膚色等級: ${json.skin.level}</a>
            <p>色斑等級: ${json.pigmentation.level}</p>
            <p>黑眼圈等級: ${json.pandaeye.level}</p>
            <p>青春痘等級: ${json.acne.level}</p>
            <p>水油平衡等級: ${json.waterOil.level}</p>
            ---------------------------------------------


        `
        skin_data=json.skin.data;
        result_id=json.rawdata.bmni_id;
        console.log(skin_data);
        const skin_info=document.getElementById('skin_info');


      });

    function skin_info()
    {
        const id=124;
        //console.log(skin_data);
        request_singleDetention(id)
    }
    function request_singleDetention(id)
    {

        let request_link=link+`/api/detectionShow`;
        let request_data=`detection_id=${id}&data=${skin_data}&result_id=${result_id}`;
        let request_url=request_link+'?'+request_data;

        fetch(request_url)
        .then((response) => response.json())
        .then((json) => {
                console.log(json);
            post.innerHTML = `
            ----------------<h1>${json.standard.bms_cname}</h1>------------------
            <br>
            <p>${json.date}</p>
            <img width="400" height="600" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1974&q=80">
            <p>等級:${json.standard.bms_lv}  檢測數值:${json.user_data}</p>
            <p>改善建議</p>
            <p>${json.standard.bms_cnt}</p>
            `;
            const single_detention=document.getElementById('single_detention');
            single_detention.removeAttribute("hidden");
            const suggest_list =json.suggests_contents;

            for(let i=0; i<suggest_list.length; i++)
            {
                var src=link+`/media/content_banner_image/small/${suggest_list[i].api_media.km_name}`;
                const img=document.createElement("img");
                img.src=src;
                img.width=160;
                img.height=90;
                read.appendChild(img);

                const paper=document.createElement("p");
                const content_title=document.createTextNode(suggest_list[i].api_content.bp_subsection_title );
                const keep=document.createTextNode("["+suggest_list[i].bp_type_keep+"]");
                const fix=document.createTextNode("["+suggest_list[i].bp_type_fix+"]");
                const info=document.createTextNode("["+suggest_list[i].bp_type_info+"]");
                const date=document.createTextNode("["+suggest_list[i].api_content.bp_subsection_enabled_date+"]");
                read.appendChild(paper);
                paper.appendChild(content_title);
                paper.appendChild(keep);
                paper.appendChild(fix);
                paper.appendChild(info);
                paper.appendChild(date);
                console.log(suggest_list[i].api_content.bp_subsection_title)
            };
        });



    }
</script>

