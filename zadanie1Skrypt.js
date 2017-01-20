function setDate(){
  var d = new Date();
  var dd = d.getDate();
  if (dd<10) dd= '0'+dd;
  var mm = d.getMonth() + 1;
  if (mm<10) mm= '0'+mm;

  var yy = d.getFullYear();
  if ( yy < 10 ) yy = '0' + yy;
  document.getElementById('date').value = yy+'-'+mm+'-'+dd;

  //document.getElementById('date').innerHTML = dd+'.'+mm+'.'+yy;
}

function setHour(){
  var d= new Date();
  var h = d.getHours();
  if(h < 10) h= '0'+ h;
  var min = d.getMinutes();
  if(min < 10) min= '0'+ min;

  document.getElementById('hour').value = h+':'+min;
}

function isInt(n){
    return Number(n) === n && n % 1 === 0;
}


function validateDate(){
  var inputDate = document.getElementById('date').value;
  var isCorrect = true;

  inputDate = inputDate.split('-');
  if(inputDate.length !== 3){
    isCorrect = false;
  }
  if(inputDate[2] < 0 || inputDate[2] > 31 || inputDate[2].length != 2){
    isCorrect = false;
  }
  if(inputDate[1] <= 0 || inputDate[1] > 12 || inputDate[1].length != 2){
    isCorrect = false;
  }
  if(inputDate[0] <= 0 || inputDate[0].length != 4){
    isCorrect = false;
  }
  if(isNan(inputDate[0]) || isNan(inputDate[1]) || isNan(inputDate[2]) || inputDate == null){
    isCorrect = false;
  }




      if (isCorrect) {
  	var month = inputDate[1];
	var year = inputDate[0];
	var date = inputDate[2];

            var ListofDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

            if (month == 1 || month > 2) {
                if (date > ListofDays[month - 1]) {
            	    isCorrect = false;
                }
            }

            if (month == 2) {
                var leapYear = false;
                if ((!(year % 4) && year % 100) || !(year % 400)) {
                    leapYear = true;
                }

                if ((leapYear == false) && (date >= 29)) {
            	    isCorrect = false;
                }

                if ((leapYear == true) && (date > 29)) {
            	    isCorrect = false;
                }

            }

        }

        else {
            isCorrect = false;
        }





  if(isCorrect == false){
    setDate();
    setHour();
  }
}


function validateDate1(){
  var textbox = document.getElementById("date").value;
  var currentInputArray = textbox.split("-");

  if (!textbox) {
    setDate();
    setHour();
  }

  if (currentInputArray.length != 3) {
    setDate();
    setHour();
  }


  if(currentInputArray[0] < 1 || currentInputArray[0].length != 4 || isNaN(currentInputArray[0])){
    setDate();
    setHour();
  }

  if (currentInputArray[1] < 1|| currentInputArray[1] > 12 || currentInputArray[1].length != 2 || isNaN(currentInputArray[1])) {
    setDate();
    setHour();
  }

  if(currentInputArray[2] < 1 || currentInputArray[2] > 31 || currentInputArray[2].length != 2 || isNaN(currentInputArray[2])){
    setDate();
    setHour();
  }


var month = currentInputArray[1];
var year = currentInputArray[0];
var date = currentInputArray[2];
var isValid = true;
        var ListofDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        if (month == 1 || month > 2) {
            if (date > ListofDays[month - 1]) {
              isValid = false;
            }
        }

        if (month == 2) {
            var leapYear = false;
            if ((!(year % 4) && year % 100) || !(year % 400)) {
                leapYear = true;
            }

            if ((leapYear == false) && (date >= 29)) {
              isValid = false;

            }

            if ((leapYear == true) && (date > 29)) {
              isValid = false;

            }
        }
        if(!isValid){
            setDate();
            setHour();
        }


}

function validateHour(){
  var input = document.getElementById('hour').value;
  var inputDate = input.split(':');

  if(inputDate.length != 2){
    setDate();
    setHour();
  }
  if(inputDate[0] <= 0 || inputDate[0] >= 24 || inputDate[0].length != 2 || isNaN(inputDate[0])) {
    setDate();
    setHour();
  }
  if(inputDate[1] <= 0 || inputDate[1] >= 60 || inputDate[1].length != 2 || isNaN(inputDate[1])){
    setDate();
    setHour();
  }

}

var fileCount = 1;

function addNewFile(){
  fileCount = fileCount + 1;

  var newFile = document.createElement("input");
  newFile.type = "file";
  newFile.name = "fileName" + fileCount;
  newFile.onchange = function(){
    addNewFile();
  }
  document.getElementById("files").appendChild(newFile);
  //document.getElementById("file" + fileCount).innerHTML = "<br />";
}

setDate();
setHour();
