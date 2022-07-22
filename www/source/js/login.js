window.onload=adjust();

function CheckILeaglInput(str){
    
    var xmlhttp;
    if (str.length==0)//检查是否有输入内容
    { 
        alert('输入框不可为空!');
        return;
    }
    if (window.XMLHttpRequest)
    {
        // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        // IE6, IE5 浏览器执行代码
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","/try/ajax/gethint.php?q="+str,true);
    xmlhttp.send();
}

function getBrowser() {  
    var ua = window.navigator.userAgent;  
    var isIE = window.ActiveXObject != undefined && ua.indexOf("MSIE") != -1;
    var isIEEdge = ua.indexOf("Windows NT 6.1; WOW64; Trident/7.0;") != -1;  
    var isFirefox = ua.indexOf("Firefox") != -1;  
    var isOpera = window.opr != undefined;  
    var isChrome = ua.indexOf("Chrome") && window.chrome;  
    var isSafari = ua.indexOf("Safari") != -1 && ua.indexOf("Version") != -1;  
    if (isIE) {  
        return "IE";  
    }else if (isIEEdge) {  
        return "Edge";  
    } else if (isFirefox) {  
        return "Firefox";  
    } else if (isOpera) {  
        return "Opera";  
    } else if (isChrome) {  
        return "Chrome";  
    } else if (isSafari) {  
        return "Safari";  
    } else {  
        return "Unkown";  
    }  
}
function adjust(){
    var linkNode = document.createElement("link");
    linkNode.setAttribute("rel", "stylesheet");
    linkNode.setAttribute("type", "text/css");
    if (getBrowser() == "Firefox") {
    linkNode.setAttribute("href", "../source/css/firefox/home.css");
    }
    else{
        linkNode.setAttribute("href", "../source/css/chrome/home.css");
    }
    document.head.appendChild(linkNode);
}