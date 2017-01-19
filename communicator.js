function isChecked(){
  return document.getElementById("isEnable").checked;
}

function isReadyToSend() {
    return (document.getElementById("username").value) && (document.getElementById("toSend").value);
}

function ajax(){
  document.getElementById("messages").innerHTML = "";
  //if(isChecked()){
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET","communicator_read.php",true);
    xhttp.onreadystatechange = function() {
        if ( (xhttp.readyState == 4 || xhttp.readyState==3)&& ((xhttp.status >= 200 && xhttp.status < 300) || xhttp.status == 304 || navigator.userAgent.indexOf("Safari") >= 0 && typeof xhttp.status == "undefined")) {
          if(isChecked()){
            document.getElementById("messages").innerHTML = xhttp.responseText;
          }
          setTimeout(function () {
              xhttp.open("GET", "communicator_read.php", true);
              xhttp.send();
          }, 500);
          //xhttp = null;

        }
    };
    xhttp.open("GET", "communicator_read.php", true);
    xhttp.send();
  //}
}

function send() {
    if (isChecked() && isReadyToSend()){
        var xhttp = new XMLHttpRequest();
        var username = document.getElementById("username").value;
        var toSend = document.getElementById("toSend").value;
        var page = "communicator_write.php?username=" + username + "&toSend=" + toSend;
        xhttp.open("GET", page, true);
        xhttp.send();
        document.getElementById("username").value = "";
        document.getElementById("toSend").value = "";
    }
}
