var currentUrl = window.location.pathname.split("/")[2];
const platform_beauty=document.getElementById('beauty');
const platform_ultra=document.getElementById('UltraAdmin');
const selectplatform=document.getElementById('selectplatform');
const platform_center=document.getElementById('center');
const locationURL=document.getElementById('location');
// console.log('currentUrl:', currentUrl);

if(currentUrl =="beauty" || currentUrl=="center" )
{
    //console.log(locationURL.innerHTML);
    switch(currentUrl)
    {
        case('beauty'):
        platform_beauty.selected=true;
        break;
        case('UltraAdmin'):
        platform_ultra.selected=true;
        break;
        case('center'):
        platform_center.selected=true;
        break;
    }
    localStorage.setItem('last_platform', currentUrl);
    localStorage.setItem('last_platformURL', locationURL);
    localStorage.setItem('last_html',locationURL.innerHTML);
}


const beautyaddress="/root/beauty";
const ultraaddress="/root/UltraAdmin/search";
const centeraddress="/root/center";

function platformchange(){
    var value=selectplatform.value;
    switch(value)
    {
        case('beauty'):
            window.location.href=link+beautyaddress;
            break;
        case('UltraAdmin'):
            window.location.href=link+ultraaddress;
            break;
        case('center'):
            window.location.href=link+centeraddress;
    }
}
