var currentPlatform=localStorage.getItem('last_platform');
var nowURL=localStorage.getItem('last_platformURL');
var currentHTML=localStorage.getItem('last_html');
var DisplayPlatform=document.getElementById('DisplayPlatform');

DisplayPlatform.href=nowURL;
DisplayPlatform.innerHTML=currentHTML;
