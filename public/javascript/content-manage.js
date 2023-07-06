const APIchapterWithTab ="http://192.168.1.128/api/chapter";
async function dataApi(data){

    // add chapter btn
    let addCatBtn = document.getElementById('addCatBtn');

    // tab Container
    let tabContainer1 = document.getElementById('tabContainer_1');
    let tabContainer2 = document.getElementById('tabContainer_2');
    let tabContainer3 = document.getElementById('tabContainer_3');

    // Tab
    let tabs = document.querySelectorAll('.tab');
    let tab1 = document.getElementById('tab_1');
    let tab2 = document.getElementById('tab_2');
    let tab3 = document.getElementById('tab_3');

    // add keyword btn & input
    let addKeywordBtn = document.getElementById('addKeywordBtn');
    let addKeywordInput = document.getElementById('addKeywordInput');
    let chapter = document.getElementById('chapter');

    // save btn
    let saveBtn = document.getElementById('saveChangeBtn');


    // Help Info
    let repeatInfo = document.getElementById("repeatInfo");
    let emptyInfo = document.getElementById("emptyInfo");
    let noDataInfo = document.getElementById("noDataInfo");

    //--------------------------------------------------------GET DATA from API-----------------------------------------------
    //  從 database 獲得的 array
    const response = await fetch(data);
    // Storing data in form of JSON
    var chapterWithTab = await response.json();

    //chapter1 = chapterWithTab[0];
    var chapters = new Array(chapterWithTab.length);

    for(var i=0; i < chapterWithTab.length; i++)
    {
        chapters[i] = chapterWithTab[i];
        //console.log(chapter[i]);
    }

    let keywordArray_1=chapterWithTab[0].tag;
    let keywordArray_2=chapterWithTab[1].tag;
    let keywordArray_3=chapterWithTab[2].tag;

    // api url
    const api_url =link+"/api/tags";
    // Defining async function
    async function getapi(url) {
        // Storing response
        const response = await fetch(url);
        // Storing data in form of JSON
        var datas = await response.json();
        const test_list=datas.map(bp_hashtag => Object.values(bp_hashtag)[1])
        //console.log(test_list);
        $(function() {
            $( "#addKeywordInput" ).autocomplete({
                source: test_list
                });
            });
        //console.log(test_list);
        let keywordDatabase = datas;
        let checkDataArray = keywordDatabase.map(item => Object.values(item)[1]);
            //---------------------------------------------------------------------------------------------------------------
                    /*資料結構

                    章當中已被選擇的關鍵字
                    API: http://127.0.0.1/api/chapter
                    [
                        {
                            "bp_chapter_id": 1,
                            "bp_chapter_name": "皮膚科學",
                            "tag": [
                                {
                                    "bp_tag_id": 62,
                                    "bp_hashtag": "毛囊炎",
                                    "content_count": 0,
                                    "laravel_through_key": 1
                                },
                        .
                        .
                        .
                        }
                    ]

                    關鍵字資料庫
                    API:http://127.0.0.1/api/tags
                    [
                        {
                            "bp_tag_id": 39,
                            "bp_hashtag": "除毛",
                            "content_count": 0
                        },
                        .
                        .
                        .
                    ]

                    */
            //---------------------------------------------------------------------------------------------------------------
    //------------------------------------------------End of API catching----------------------------------------------------


        // add keyword into container
        addKeywordBtn.addEventListener('click', e => {

            // avoid refresh
            e.preventDefault();

            // get value from input
            let addKeywordValue = addKeywordInput.value;
            // console.log(addKeywordValue);

            // 判斷目前在哪個 container
            if (!tabContainer1.hidden) {
                // console.log("append here in container 1");
                checkInput(keywordArray_1, tabContainer1);
                 console.log('keywordArray_1', keywordArray_1);
            } else if (!tabContainer2.hidden) {
                // console.log("append here in container 2");
                checkInput(keywordArray_2, tabContainer2);
                // console.log('keywordArray_2', keywordArray_2);
            } else if (!tabContainer3.hidden) {
                // console.log("append here in container 3");
                checkInput(keywordArray_3, tabContainer3);
                // console.log('keywordArray_3',keywordArray_3);
            }

            // Check Input value
            function checkInput(array, tabContainer) {

                // object ID array
                let keywordArrayId = array.map(item => Object.values(item)[0]);
                // console.log('keywordArrayID:', keywordArrayId);

                // object hashtag
                let keywordArrayHashtag = array.map(item => Object.values(item)[1]);
                // console.log('keywordArrayHashtag:', keywordArrayHashtag);

                // object article
                let keywordArrayNum = array.map(item => Object.values(item)[2]);
                // console.log('keywordArrayNum:', keywordArrayNum);

                if (addKeywordValue === "") {
                    // empty warning
                    addKeywordInput.classList.add("is-danger");
                    emptyInfo.classList.remove("hide");
                    repeatInfo.classList.add("hide");
                    return;
                } else {
                    // remove warning
                    addKeywordInput.classList.remove("is-danger");
                    emptyInfo.classList.add("hide");
                    repeatInfo.classList.add("hide");
                    noDataInfo.classList.add('hide');

                    // 確認是否加入重複關鍵字
                    if (keywordArrayHashtag.indexOf(addKeywordValue) !== -1) {
                        // repeat warning
                        // console.log(addKeywordValue, "有重複");
                        addKeywordInput.classList.add("is-danger");
                        repeatInfo.classList.remove("hide");
                        noDataInfo.classList.add('hide');

                    } else {
                        // console.log(addKeywordValue, "沒有重複值");
                        // remove warning
                        addKeywordInput.classList.remove("is-danger");
                        repeatInfo.classList.add("hide");
                        noDataInfo.classList.add('hide');

                        // 確認資料庫是否有這個關鍵字
                        if (checkDataArray.indexOf(addKeywordValue) == -1) {
                            // console.log('資料庫沒有此關鍵字');
                            // no data warning
                            addKeywordInput.classList.add("is-danger");
                            noDataInfo.classList.remove('hide');
                        } else {
                            // console.log('資料庫有關鍵字,可使用');
                            console.log(chapter.value, '加入關鍵字:', addKeywordValue);
                            // remove warning
                            addKeywordInput.classList.remove("is-danger");
                            noDataInfo.classList.add('hide');

                            // check keyword 在資料庫的資料
                            let keywordIndex = checkDataArray.indexOf(addKeywordValue);
                            // console.log(keywordDatabase[keywordIndex]);

                            // Push into Array
                            array.push(keywordDatabase[keywordIndex]);

                            // add Keyword
                            createElement(keywordDatabase, keywordIndex, tabContainer, array);
                        }
                    }
                }
            }

            // create keyword Element
            function createElement(keywordDatabase, keywordIndex, tabContainer, array) {

                let tabEl = document.createElement('div');
                tabEl.classList.add('tab-element');

                // keyword
                let keyword = document.createElement('span');
                keyword.classList.add('keywords');
                let keywordLink = document.createElement('a');
                keywordLink.innerText = keywordDatabase[keywordIndex].bp_hashtag;
                keyword.appendChild(keywordLink);
                let keywordNum = document.createElement('span');
                keywordNum.classList.add('tag');
                keywordNum.classList.add('is-light');
                keywordNum.innerText = keywordDatabase[keywordIndex].content_count;
                keyword.appendChild(keywordNum);

                // tabBtn
                let tabBtn = document.createElement('div');
                tabBtn.classList.add('tab-btns');

                // delBtn
                let delBtn = document.createElement('button');
                delBtn.classList.add('button');
                delBtn.classList.add('is-small');
                delBtn.classList.add('is-danger');
                delBtn.type = "button";
                let xIcon = document.createElement('span');
                xIcon.classList.add('icon')
                xIcon.classList.add('is-small')
                xIcon.innerHTML = '<i class="fa-solid fa-xmark"></i>';
                delBtn.appendChild(xIcon);
                let delBtnText = document.createElement('span');
                delBtnText.innerText = "移除"
                delBtn.appendChild(delBtnText);

                // upBtn
                let upBtn = document.createElement('button');
                upBtn.classList.add('button');
                upBtn.classList.add('is-small');
                upBtn.type = "button";
                let upICon = document.createElement('span');
                upICon.classList.add('icon');
                upICon.classList.add('is-small');
                upICon.innerHTML = '<i class="fa-solid fa-arrow-up"></i>';
                upBtn.appendChild(upICon);

                // downBtn
                let downBtn = document.createElement('button');
                downBtn.classList.add('button');
                downBtn.classList.add('is-small');
                downBtn.type = "button";
                let downIcon = document.createElement('span');
                downIcon.classList.add('icon');
                downIcon.classList.add('is-small');
                downIcon.innerHTML = '<i class="fa-solid fa-arrow-down"></i>';
                downBtn.appendChild(downIcon);

                // append to tabBtn
                tabBtn.appendChild(upBtn);
                tabBtn.appendChild(downBtn);
                tabBtn.appendChild(delBtn);

                // append to tabEl
                tabEl.appendChild(keyword);
                tabEl.appendChild(tabBtn);
                // append to keyword
                tabContainer.appendChild(tabEl);

                // delete function
                delBtn.addEventListener('click', (e) => {
                    // get element
                    let keywordEl = e.target.parentElement;
                    let delEL = keywordEl.parentElement;
                    // console.log(delEL);

                    // get element keyword value
                    let deleteKeyword = delEL.querySelector(".keywords");
                    console.log(deleteKeyword);
                    let deleteKeywordValue = deleteKeyword.querySelector('a').innerText;
                    console.log('要刪除的關鍵字:', deleteKeywordValue);

                    // delete it
                    delEL.remove();

                    // object hashtag
                    let keywordArrayHashtag = array.map(item => Object.values(item)[1]);
                    let keywordIndex = keywordArrayHashtag.indexOf(deleteKeywordValue);
                    // console.log('keywordArrayHashtag', keywordArrayHashtag);
                    // console.log('keywordIndex:', keywordIndex);

                    // delete from array
                    Array.prototype.remove = function(value) {
                        this.splice(this.indexOf(value), 1);
                    }
                    array.remove(array[keywordIndex]);
                    console.log('刪除後的 array', array);
                    return;
                })

            }



            // clear input value
            addKeywordInput.value = "";

        });



        // create keyword from data
        function createFromData(array, tabContainer) {
            for (var i = 0; i <= (array.length - 1); i++) {
                // console.log(array[i]);
                let tabEl = document.createElement('div');
                tabEl.classList.add('tab-element');

                // keyword
                let keyword = document.createElement('span');
                keyword.classList.add('keywords');
                let keywordLink = document.createElement('a');
                keywordLink.innerText = array[i].bp_hashtag;
                keywordLink.href = "section/" + array[i].bp_tag_id;
                keyword.appendChild(keywordLink);
                let keywordNum = document.createElement('span');
                keywordNum.classList.add('tag');
                keywordNum.classList.add('is-light');
                keywordNum.innerText = array[i].content_count;
                keyword.appendChild(keywordNum);

                // tabBtn
                let tabBtn = document.createElement('div');
                tabBtn.classList.add('tab-btns');

                // delBtn
                let delBtn = document.createElement('button');
                delBtn.classList.add('button');
                delBtn.classList.add('is-small');
                delBtn.classList.add('is-danger');
                delBtn.type = "button";
                let xIcon = document.createElement('span');
                xIcon.selectable = false;
                xIcon.classList.add('icon')
                xIcon.classList.add('is-small')
                xIcon.innerHTML = '<i class="fa-solid fa-xmark"></i>';
                delBtn.appendChild(xIcon);
                let delBtnText = document.createElement('span');
                delBtnText.selectable = false;
                delBtnText.innerText = "移除"
                delBtn.appendChild(delBtnText);

                // upBtn
                let upBtn = document.createElement('button');
                upBtn.classList.add('button');
                upBtn.classList.add('is-small');
                upBtn.type = "button";
                let upICon = document.createElement('span');
                upICon.classList.add('icon');
                upICon.classList.add('is-small');
                upICon.innerHTML = '<i class="fa-solid fa-arrow-up"></i>';
                upBtn.appendChild(upICon);

                // downBtn
                let downBtn = document.createElement('button');
                downBtn.classList.add('button');
                downBtn.classList.add('is-small');
                downBtn.type = "button";
                let downIcon = document.createElement('span');
                downIcon.classList.add('icon');
                downIcon.classList.add('is-small');
                downIcon.innerHTML = '<i class="fa-solid fa-arrow-down"></i>';
                downBtn.appendChild(downIcon);

                // append to tabBtn
                tabBtn.appendChild(upBtn);
                tabBtn.appendChild(downBtn);
                tabBtn.appendChild(delBtn);

                // append to tabEl
                tabEl.appendChild(keyword);
                tabEl.appendChild(tabBtn);
                // append to keyword
                tabContainer.appendChild(tabEl);

                // delete function
                delBtn.addEventListener('click', (e) => {
                    // get element
                    let keywordEl = e.target.parentElement;
                    let delEL = keywordEl.parentElement;
                    // console.log(delEL);

                    // get element keyword value
                    let deleteKeyword = delEL.querySelector(".keywords");
                    // console.log(deleteKeyword);
                    let deleteKeywordValue = deleteKeyword.querySelector('a').innerText;
                    console.log('要刪除的關鍵字:', deleteKeywordValue);

                    // delete it
                    delEL.remove();

                    // object hashtag
                    let keywordArrayHashtag = array.map(item => Object.values(item)[1]);
                    let keywordIndex = keywordArrayHashtag.indexOf(deleteKeywordValue);
                    // console.log('keywordArrayHashtag', keywordArrayHashtag);
                    // console.log('keywordIndex:', keywordIndex);

                    // delete from array
                    Array.prototype.remove = function(value) {
                        this.splice(this.indexOf(value), 1);
                    }
                    array.remove(array[keywordIndex]);
                    console.log(chapter.value,'刪除後的 array', array);
                    return;
                })

            }
        }


        // on Load
        createFromData(keywordArray_1, tabContainer1);
        createFromData(keywordArray_2, tabContainer2);
        createFromData(keywordArray_3, tabContainer3);


        // switch tabs addEventListener
        tab1.addEventListener("click", (e) => {

            // give value to button
            addKeywordBtn.value = "tab1";
            // console.log(addKeywordBtn.value);
            chapter.value = "tab1";
            // console.log('chapter', chapter.value);

            tabContainer1.hidden = false;
            tabContainer2.hidden = true;
            tabContainer3.hidden = true;

            tab1.classList.add('is-active');
            tab2.classList.remove('is-active');
            tab3.classList.remove('is-active');

        });

        tab2.addEventListener("click", (e) => {

            // give value to button
            addKeywordBtn.value = "tab2";
            // console.log(addKeywordBtn.value);
            chapter.value = "tab2";
            // console.log('chapter', chapter.value);

            tabContainer1.hidden = true;
            tabContainer2.hidden = false;
            tabContainer3.hidden = true;

            tab1.classList.remove('is-active');
            tab2.classList.add('is-active');
            tab3.classList.remove('is-active');
        });

        tab3.addEventListener("click", (e) => {

            // give value to button
            addKeywordBtn.value = "tab3";
            // console.log(addKeywordBtn.value);
            chapter.value = "tab3";
            // console.log('chapter', chapter.value);

            tabContainer1.hidden = true;
            tabContainer2.hidden = true;
            tabContainer3.hidden = false;

            tab1.classList.remove('is-active');
            tab2.classList.remove('is-active');
            tab3.classList.add('is-active');
        });

        // save Btn
        saveBtn.addEventListener('click', () => {
            console.log('送出資料檢查 ---------------------')
            // console.log('send chapter', chapter.value);
            const keywordArray_submit1=keywordArray_1.map(item => Object.values(item)[0]);
            const keywordArray_submit2=keywordArray_2.map(item => Object.values(item)[0]);
            const keywordArray_submit3=keywordArray_3.map(item => Object.values(item)[0]);
            console.log('tab1 send keywordArray_1', keywordArray_submit1);
            console.log('tab1 send keywordArray_2', keywordArray_submit2);
            console.log('tab1 send keywordArray_3', keywordArray_submit3);

/*             if(keywordArray_submit1 != '' || keywordArray_submit2!='' || keywordArray_submit3!='')
            { */
                var url = link+'/api/chapter';
                fetch(url, {
                method: 'POST', // or 'PUT'
                body: JSON.stringify({
                    ky_array1:keywordArray_submit1,
                    ky_array2:keywordArray_submit2,
                    ky_array3:keywordArray_submit3,
                }), // data can be `string` or {object}!
                headers: new Headers({
                    'Content-Type': 'application/json'
                })
                }).then(res => res.json())
                .catch(error => console.error('Error:', error))
                .then(function (response) {
                    window.location.reload();
                });
           // }

        });
    }
    getapi(api_url);
}
    dataApi(APIchapterWithTab);
