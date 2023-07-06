const ContentStateDisplay = document.getElementById('ContentStateDisplay');

// console.log(ContentStateDisplay);


function contentState(content_state)
{
    //console.log(content_state);
    // Checkbox 條件設定 --------------------------
    if(content_state != 2 && content_state != 3)
    {
        const datePicker = document.getElementById("datePicker");
        const specialDateInput = document.getElementById("specialDate");

        // 設定在 checked 的情況下才可選擇排程發布日期
        if(specialDateInput.checked == true )
        {
            //console.log('checked');
            datePicker.disabled = false;
        }
        else
        {
            //console.log('none');
            datePicker.disabled = true;
        }

        specialDateInput.addEventListener('click', () => {
            if (specialDateInput.checked) {
                //console.log('checked');
                datePicker.disabled = false;
                console.log(specialDateInput.checked);
            } else {
                //console.log('none');
                datePicker.disabled = true;
                console.log(specialDateInput.checked);
            }
        });
    // 限制日期必須選擇大於當前時間 ------------------------

        // 取得當前時間
        var today = new Date();
        var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        // var dateTime = date+' '+time;
        var dateTime = date +'T'+ time;
        // console.log("dateTime:", dateTime, typeof(dateTime));

        // 設定 input min 限制
        // datePicker.setAttribute("min", "2022-11-30T16:48:55");
        datePicker.setAttribute("min", dateTime);

    }

}
