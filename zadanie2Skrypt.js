function listOfStyles() {
    var container = document.getElementById("style");
    var styles = document.styleSheets;
    var newElement;
    for (var i = 0; i < styles.length; i++){
        newElement = document.createElement("li");
        newElement.title = styles[i].title;
        newElement.innerHTML = "Styl " + newElement.title;
        newElement.onclick = function () {
            changeStyle(this.title)
        }
        container.appendChild(newElement);
    }
}

function changeStyle(styleName) {
    var styles = document.styleSheets;
    for (var i = 0; i < styles.length; i++){
        styles[i].disabled = (styles[i].title != styleName);
    }
    setCookie("styleName", styleName, 10);
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie() {
    var styleName = getCookie("styleName");
    if (styleName != "") {
        changeStyle(styleName);
    } else {
        var styles = document.styleSheets;
        for (var i = 0; i < styles.length; i++){
            if (!i.disabled){
                changeStyle(i.title);
            }
        }
    }
}
