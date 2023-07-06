    //const { ConcatenationScope } = require("webpack");

    $(document).ready(function(){

        var _URL = window.URL || window.webkitURL;

       //-----------------------檢查上傳圖片之規格---------------------------//
        $('#file').change(function () {

           //參數設定:
           var file  =  $(this)[0].files[0];

           var limited_setting=1;
           var limited_session=0;

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


           //圖檔大小運算及設定檔
           imgsize = file.size/1024/1024;
           imgsize = imgsize.toFixed(2);

           img.src = _URL.createObjectURL(file);
           img.onload = function() {

               imgwidth = this.width;
               imgheight = this.height;

               //顯
               //$("#width").text(imgwidth);
               //$("#height").text(imgheight);
               //$('#size').text(imgsize+"mb");

               //判斷圖片尺寸大小是否合符
               if(maxwidth =="無限制")
               {
                   $('#response').text("無限制");
               }
               else
               {
                   if(imgwidth == maxwidth && imgheight == maxheight){
                       limited_session= limited_session+1;
                       $("#response").text("符合尺寸");
                   }else{
                        $("#response").text("照片必須要合符"+maxwidth+"X"+maxheight+"之尺寸");
                   }
               }

               //判斷圖片的檔案大小是否合符
               console.log(maxsize);
               console.log(imgsize);
               if(imgsize<=maxsize)
               {
                   limited_session=limited_session+1;
                   $('#sizewarming').text("合符檔案大小");
               }
               else
               {
                   $('#sizewarming').text("檔案已超過類別要求"+maxsize+"mb的檔案大小");
               }

               console.log('setting:'+ limited_setting+ '/' + 'session'+ limited_session);

           };
           img.onerror = function() {
               $("#response").text("not a valid file: " + file.type);
           }
           //-------------------------------------------------------------------//

           //----------------------------顯示圖片-------------------------------//
           var file = $('#file')[0].files[0];
           var reader = new FileReader;
           reader.onload = function(e) {
               $('#demo').attr('src', e.target.result);
           };
           reader.readAsDataURL(file);
        });
    });


