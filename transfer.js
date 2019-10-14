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

/*与后台交互，登录*/
document.getElementById("login-button").onclick = function() { //提交登录数据
    var xhr = createXHR();
    var loginForm = {
        "token": "login",
        "data": {
            "admin": document.getElementById("account").value,
            "password": document.getElementById("login_password").value
        }
    };
    var stringData=JSON.stringify(loginForm);
    // alert(stringData);
    xhr.open("post", "/dormsystem/login.php", true);
    xhr.setRequestHeader("Content-type","application/json;charset=UTF-8");
    xhr.send(stringData);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);

                if (data.code === 200){
                    setCookie('token', data.msg); //将token设置在cookie
                    alert('登录成功!');
                    window.location.href="./welcome2.html";
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
};



