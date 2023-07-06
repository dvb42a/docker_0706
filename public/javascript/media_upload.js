    //const { ConcatenationScope } = require("webpack");
    const file_name=document.getElementById('file-name');
    const uploadButton=document.getElementById('uploadButton');
    $(document).ready(function(){

        var _URL = window.URL || window.webkitURL;

        //------------------------------送出按鈕開關設定----------------------//

        const saveBtn =document.getElementById('saveBtn');

        function turnoffbutton(){
            saveBtn.disabled=true;
        };

        //-------------------------------------------------------------------//
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
       //-----------------------檢查上傳圖片之規格---------------------------//
        $('#file').change(function () {

            //參數設定:
            var file  =  $(this)[0].files[0];
            var limited_setting=1;
            var limited_session=0;
            var limitedType_session=0;
            var limitedType_setting=1;
            img = new Image();
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

            //圖檔大小運算及設定檔
            if(file != null )
            {

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
                        $(".img-size").addClass("is-checked");
                        $('#icon_size_true').removeAttr('hidden');
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
                        saveBtn.disabled=false;
                        saveBtn.classList.remove('disabled');
                        saveBtn.title='';

                    }
                    else
                    {
                        saveBtn.disabled=true;
                        saveBtn.classList.add('disabled');
                        saveBtn.title='請檢查圖片規範是否符合!';
                    }
                };
            }


           //-------------------------------------------------------------------//

           //----------------------------顯示圖片-------------------------------//
           var file = $('#file')[0].files[0];
           var testlink="https://images.unsplash.com/photo-1672776720502-246e6bf9550c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80";
           var reader = new FileReader;
           reader.onload = function(e) {
               $('#demo').attr('src', e.target.result);
           };
           if(file!=null)
           {
            reader.readAsDataURL(file);
           }

           //----------------------------按鈕設定-------------------------------//
        });



    });


