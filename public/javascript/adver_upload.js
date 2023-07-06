

    //const { ConcatenationScope } = require("webpack");
    const file_name=document.getElementById('file-name');
    const uploadButton=document.getElementById('uploadButton');
    const files=document.getElementsByClassName('upload-input');
    const del_btn=document.getElementsByClassName('button danger-btn');


    $(document).ready(function(){


        for(var i=0; i<files.length; i++)
        {
            files[i].addEventListener('click',(e)=>{

                let nowfile=e.target;
                console.log(nowfile);
                const div=nowfile.parentNode.parentNode.parentNode.parentNode;
                //const div_demo=div.parentNode;
                const demo=div.querySelector('.object-center').id;
                //console.log(div);

                var icon= div.querySelectorAll('.check-icon');
                var icon_size_true='#'+icon[4].id;
                var icon_size_false='#'+icon[5].id;
                var icon_file_true='#'+icon[2].id;
                var icon_file_false='#'+icon[3].id;
                var icon_type_true='#'+icon[0].id;
                var icon_type_false='#'+icon[1].id;
               // console.log(icon);

                var img_status=div.querySelectorAll('.img-status');
                //console.log(img_status);
                var img_type=img_status[0].id;
                var img_filesize=img_status[1].id;
                var img_size=img_status[2].id;

                //console.log(img_type);
                var fileimg_name='#'+nowfile.id;
                var fileimg=$(fileimg_name);
                //console.log(fileimg_name);
                $(fileimg).change(function(){
                    imgcheck(fileimg,icon_size_true,icon_size_false,icon_file_true,icon_file_false,
                            icon_type_true,icon_type_false,img_filesize,img_size,img_type,demo);
                })
                reset_state(icon_size_true,icon_size_false,icon_file_true,icon_file_false,
                    icon_type_true,icon_type_false,img_filesize,img_size,img_type);

            });
        }
        var _URL = window.URL || window.webkitURL;

        //------------------------------送出按鈕開關設定----------------------//

        const saveBtn =document.getElementById('saveBtn');

        function turnoffbutton(){
            saveBtn.disabled=true;
        };

        function turnonbutton(){
            saveBtn.disabled=false;
        };
        //turnoffbutton();

        //-------------------------------------------------------------------//
        function reset_state(icon_size_true,icon_size_false,icon_file_true,icon_file_false,
            icon_type_true,icon_type_false,img_filesize,img_size,img_type)
        {
            $(icon_size_true).prop('hidden',true);
            $(icon_size_false).prop('hidden',true);
            $(icon_file_true).prop('hidden',true);
            $(icon_file_false).prop('hidden',true);
            $(icon_type_true).prop('hidden',true);
            $(icon_type_false).prop('hidden',true);

            $('#'+img_size).removeClass("is-checked");
            $('#'+img_size).removeClass("is-failed");
            $('#'+img_filesize).removeClass("is-checked");
            $('#'+img_filesize).removeClass("is-failed");
            $('#'+img_type).removeClass("is-checked");
            $('#'+img_type).removeClass("is-failed");
        }
       //-----------------------檢查上傳圖片之規格---------------------------//
        function imgcheck(files,icon_size_true,icon_size_false,icon_file_true,icon_file_false,
            icon_type_true,icon_type_false,img_filesize,img_size,img_type,demo) {
            //參數設定:
            //console.log(img_type);
            var file  =  $(files)[0].files[0];
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

            //圖檔大小運算及設定檔
            if(file != null )
            {

                imgsize = file.size/1024/1024;
                imgsize = imgsize.toFixed(2);
                img.src = _URL.createObjectURL(file);

                var fileExtension = ['jpeg', 'jpg', 'png', 'svg'];
                if ($.inArray($(files).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    $("#"+img_type).addClass("is-failed");
                    $(icon_type_false).removeAttr('hidden');
                    $("#"+img_filesize).addClass("is-failed");
                    $(icon_file_false).removeAttr('hidden');
                    $("#"+img_size).addClass("is-failed");
                    $(icon_size_false).removeAttr('hidden');
                    turnoffbutton();
                }
                else
                {
                    limited_type=1;
                    $("#"+img_type).addClass("is-checked");
                    $(icon_type_true).removeAttr('hidden');
                    //console.log('type_true');
                }

                img.onload = function() {


                    turnoffbutton();


                    imgwidth = this.width;
                    imgheight = this.height;
                    //判斷圖片尺寸大小是否合符
                    if(maxwidth =="無限制")
                    {
                        $("#"+img_size).addClass("is-checked");
                        $(icon_size_true).removeAttr('hidden');
                    }
                    else
                    {
                            if(imgwidth == maxwidth && imgheight == maxheight){
                                    limited_session= limited_session+1;
                                    $("#"+img_size).addClass("is-checked");
                                    $(icon_size_true).removeAttr('hidden');
                            }else{
                                    $("#"+img_size).addClass("is-failed");
                                    $(icon_size_false).removeAttr('hidden');
                            }
                    }

                    //判斷圖片的檔案大小是否合符
                    //console.log(maxsize);
                    //console.log(imgsize);
                    if(imgsize<=maxsize)
                    {
                            limited_session=limited_session+1;
                            $("#"+img_filesize).addClass("is-checked");
                            $(icon_file_true).removeAttr('hidden');
                    }
                    else
                    {
                            $("#"+img_filesize).addClass("is-failed");
                            $(icon_file_false).removeAttr('hidden');
                    }


                    //console.log('setting:'+ limited_setting+ '/' + 'session'+ limited_session);
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
           var file = $(files)[0].files[0];
           var testlink="https://images.unsplash.com/photo-1672776720502-246e6bf9550c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80";
           var reader = new FileReader;
           reader.onload = function(e) {
               $('#'+demo).attr('src', e.target.result);

           };
           if(file!=null)
           {
            reader.readAsDataURL(file);
           }

           //----------------------------按鈕設定-------------------------------//
        };
        //console.log(del_btn);
        for(var i=0; i<del_btn.length; i++)
        {
            var del='.'+del_btn[i].id;
            del_btn[i].addEventListener('click',(e)=>{
                //console.log(e);
                var del_file=e.target.parentNode;
                var del_father=del_file.parentNode.parentNode;
                var del_mother=del_file.parentNode;
                var del_div=del_file.parentNode.parentNode.parentNode;
                //console.log(del_div);

                var icon= del_mother.querySelectorAll('.check-icon');
                var icon_size_true='#'+icon[4].id;
                var icon_size_false='#'+icon[5].id;
                var icon_file_true='#'+icon[2].id;
                var icon_file_false='#'+icon[3].id;
                var icon_type_true='#'+icon[0].id;
                var icon_type_false='#'+icon[1].id;
                //console.log(icon_type_false);

                var img_status=del_mother.querySelectorAll('.img-status');
                //console.log(img_status);
                var img_type=img_status[0].id;
                var img_filesize=img_status[1].id;
                var img_size=img_status[2].id;

                var del_filename=del_file.querySelector('.file-name');
                var del_demo=del_father.querySelector('.object-center').id;
                var del_section=del_file.querySelector('.upload-input').id;
                var currentID=del_section.substring(del_section.lastIndexOf('e')+1);
                var checkbox=del_div.querySelector('.checkbox');
                var input=del_div.querySelectorAll('.input');
                //console.log(input);
                input.forEach(function(input){
                    input.value="";
                })
                checkbox.checked=false;


                $("#"+del_section).get(0).files[0] = null;
                $("#"+del_demo).removeAttr("src");
                $("#"+del_section).val('');
                turnonbutton();
                reset_state(icon_size_true,icon_size_false,icon_file_true,icon_file_false,
                    icon_type_true,icon_type_false,img_filesize,img_size,img_type);

                var deletedImg=document.createElement("input");
                del_file.appendChild(deletedImg);
                deletedImg.type="hidden";
                deletedImg.name=`deleted_img_${currentID}`;
                deletedImg.value="deleted";

                saveBtn.disabled=false;
                saveBtn.classList.remove('disabled');
                saveBtn.title='';
               // console.log(del_demo);
            });


        };


    });


