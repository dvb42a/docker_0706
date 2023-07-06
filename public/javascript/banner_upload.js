    const removeBtn=document.getElementById('removeimage');
    const edit_content=document.getElementById('edit_content');

    //增加欄位供後端判斷是否刪除照片
    var imageStatus= document.createElement('input');
    imageStatus.type="hidden";
    imageStatus.name="imgStatus";

    edit_content.appendChild(imageStatus);
    console.log(imageStatus);


    function reset_state()
    {
        $('#icon_size_true').prop('hidden',true);
        $('#icon_size_false').prop('hidden',true);
        $('#icon_file_true').prop('hidden',true);
        $('#icon_file_false').prop('hidden',true);
        $('#icon_type_true').prop('hidden',true);
        $('#icon_type_false').prop('hidden',true);

        $(".img-size").removeClass("is-checked");
        $(".img-size").removeClass("is-failed");
        $(".img-filesize").removeClass("is-checked");
        $(".img-filesize").removeClass("is-failed");
        $(".img-type").removeClass("is-checked");
        $(".img-type").removeClass("is-failed");
    }

    function turnonbutton(){
        if(driftBtn != null)
        {
            driftBtn.disabled=false;
        }
        previewBtn.disabled=false;
        saveBtn.disabled=false;
        saveBtn.classList.remove('disabled');
        previewBtn.classList.remove('disabled');
        saveBtn.title='';
        previewBtn.title='';
    };

    $(document).ready(function(){

        var _URL = window.URL || window.webkitURL;

        //------------------------------送出按鈕開關設定----------------------//




        function turnoffbutton(){
            if(driftBtn != null)
            {
                driftBtn.disabled=true;
            }
            previewBtn.disabled=true;
            saveBtn.disabled=true;
            saveBtn.classList.add('disabled');
            previewBtn.classList.add('disabled');
            saveBtn.title='請檢查圖片規範是否符合!';
            previewBtn.title='請檢查圖片規範是否符合!';
        };


        //-------------------------------------------------------------------//

       //-----------------------檢查上傳圖片之規格---------------------------//
        $('#file').change(function () {
            console.log($(".img-type"));
            //參數設定:
            var file  =  $(this)[0].files[0];

            var limited_setting=1;
            var limited_session=0;
            var limitedType_session=0;
            var limitedType_setting=1;
            img = new Image();
            //console.log(img);
            var imgwidth = 0;
            var imgheight = 0;
            var imgsize=0;
            var maxwidth = document.getElementById('file_limited_width').textContent;
            if(maxwidth !== "無限制")
            {
                var maxheight = document.getElementById('file_limited_height').textContent;
                limited_setting=limited_setting+1;
            }
            var maxsize = document.getElementById('file_limited_file').textContent;
            maxsize=Math.floor(maxsize);

            if(file != undefined)
            {
                reset_state();

            }

            if(file !=null)
            {
                //圖檔大小運算及設定檔

                imgsize = file.size/1024/1024;
                imgsize = imgsize.toFixed(2);

                img.src = _URL.createObjectURL(file);

                var fileExtension = ['jpeg', 'jpg', 'png', 'svg'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    $(".img-type").addClass("is-failed");
                    $('#icon_type_false').removeAttr('hidden');
                    $(".img-filesize").addClass("is-failed");
                    $('#icon_file_false').removeAttr('hidden');
                    $(".img-size").addClass("is-failed");
                    $('#icon_size_false').removeAttr('hidden');
                    turnoffbutton();
                }
                else
                {
                    limited_type=1;
                    $(".img-type").addClass("is-checked");
                    $('#icon_type_true').removeAttr('hidden');
                }

                img.onload = function() {


                    turnoffbutton();


                    imgwidth = this.width;
                    imgheight = this.height;

                    //判斷圖片尺寸大小是否合符
                    if(maxwidth =="無限制")
                    {
                        $('#response').text("無限制");
                    }
                    else
                    {
                            if(imgwidth == maxwidth && imgheight == maxheight){
                                    limited_session= limited_session+1;
                                    $(".img-size").addClass("is-checked");
                                    $('#icon_size_true').removeAttr('hidden');
                            }else{
                                    $(".img-size").addClass("is-failed");
                                    $('#icon_size_false').removeAttr('hidden');
                            }
                    }

                    //判斷圖片的檔案大小是否合符
                    //console.log(maxsize);
                    //console.log(imgsize);
                    if(imgsize<=maxsize)
                    {
                            limited_session=limited_session+1;
                            $(".img-filesize").addClass("is-checked");
                            $('#icon_file_true').removeAttr('hidden');
                    }
                    else
                    {
                            $(".img-filesize").addClass("is-failed");
                            $('#icon_file_false').removeAttr('hidden');
                    }
                    console.log('setting:'+ limited_setting+ '/' + 'session'+ limited_session);
                    if(limited_session== limited_setting)
                    {
                        turnonbutton();
                        imageStatus.value='';
                    }
                };
            }


           //-------------------------------------------------------------------//

           //----------------------------顯示圖片-------------------------------//
           var file = $('#file')[0].files[0];
           var reader = new FileReader;
           reader.onload = function(e) {
               $('#demo').attr('src', e.target.result);
           };
           if(file != null)
           {
               reader.readAsDataURL(file);
           }


           //----------------------------按鈕設定-------------------------------//

        });
    });


    $("#removeimage").on("click", function () {

        $("#file").get(0).files[0] = null;
        $("#demo").removeAttr("src");
        $("#file").val('');
        turnonbutton();
        reset_state();
        imageStatus.value='deleted';

    });
