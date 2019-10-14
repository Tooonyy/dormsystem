function createXHR() {
    if (typeof XMLHttpRequest != "undefined") {
        return new XMLHttpRequest();
    }
    else if (typeof ActiveXObject != "undefined") {
        if (typeof arguments.callee.activeXString != "string") {
            var versions = ["MSXML2.XMLHttp.6.0", "MSXML2.XMLHttp.3.0", "MSXML2.XMLHttp"], i ,len;
            for (i = 0, len = versions.length; i < len; i++) {
                try {
                    new ActiveXObject(versions[i]);
                    arguments.callee.activeXString = versions[i];
                    break;
                }
                catch (ex) {
                    //跳过
                }
            }
        }
        return new ActiveXObject(arguments.callee.activeXString);
    }
    else {
        throw new Error ("No XHR object available.");
    }
}


function getCookieItem(name) { //获取cookie里想要的项
    var strCookie = document.cookie;
    var arrCookie = strCookie.split("; ");
    for (var i = 0; i < arrCookie.length; i++) {
        var arr = arrCookie[i].split("=");
        if (arr[0] === name) {
            return arr[1];
        }
    }
    return "";
}

function setCookie(cname, cvalue) { //设置cookie
    document.cookie = cname + "=" + cvalue;
}

document.getElementById("dorm_managing").onclick = function() {
    var xhr = createXHR();
    var loginForm = {
        "token": getCookieItem("token"),
    };
    var stringData=JSON.stringify(loginForm);
    xhr.open("post", "/dormsystem/check_level2.php", true);
    xhr.setRequestHeader("Content-type","application/json;charset=UTF-8");
    xhr.send(stringData);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                if (data.code === 200){
                    // window.location.href="./admin_paging.php";
                    document.getElementById("iframepage").contentWindow.location.reload(true);
                    var object = document.getElementById("iframepage");
                    object.src='./admin_paging.php';
                }else {
                    alert(data.msg);
                }
            }
            else if(xhr.status >= 400) { //状态码>=400，没有该用户或密码错误
                var data = JSON.parse(xhr.responseText);
                alert(data.msg);
                document.getElementById("iframepage").contentWindow.location.reload(true);
                var object = document.getElementById("iframepage");
                object.src='./welcome2.html';
            }
        }
    }
}

document.getElementById("to_stu").onclick = function() {
    var xhr = createXHR();
    var loginForm = {
        "token": getCookieItem("token"),
    };
    var stringData=JSON.stringify(loginForm);
    xhr.open("post", "/dormsystem/check_level.php", true);
    xhr.setRequestHeader("Content-type","application/json;charset=UTF-8");
    xhr.send(stringData);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                if (data.code === 200){
                    // window.location.href="./admin_paging.php";
                    document.getElementById("iframepage").contentWindow.location.reload(true);
                    var object = document.getElementById("iframepage");
                    object.src='./paging.php';
                }else {
                    alert(data.msg);
                }
            }
            else if(xhr.status >= 400) { //状态码>=400，没有该用户或密码错误
                var data = JSON.parse(xhr.responseText);
                alert(data.msg);
                document.getElementById("iframepage").contentWindow.location.reload(true);
                var object = document.getElementById("iframepage");
                object.src='./paging.php';
            }
        }
    }
}

document.getElementById("to_discipline").onclick = function() {
    var xhr = createXHR();
    var loginForm = {
        "token": getCookieItem("token"),
    };
    var stringData=JSON.stringify(loginForm);
    xhr.open("post", "/dormsystem/check_level.php", true);
    xhr.setRequestHeader("Content-type","application/json;charset=UTF-8");
    xhr.send(stringData);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                if (data.code === 200){
                    // window.location.href="./admin_paging.php";
                    document.getElementById("iframepage").contentWindow.location.reload(true);
                    var object = document.getElementById("iframepage");
                    object.src='./discipline_paging.php';
                }else {
                    alert(data.msg);
                }
            }
            else if(xhr.status >= 400) { //状态码>=400，没有该用户或密码错误
                var data = JSON.parse(xhr.responseText);
                alert(data.msg);
            }
        }
    }
}