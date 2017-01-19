<?php
require 'header.php';
?>

<?php
$username = $_POST['username'];
$myDir = '';

function sendFile($fileToUpload, $number, $fileNamePartTmp){
  if(isset($_FILES[$fileToUpload])){
        $errors= array();
        $file_name = $_FILES[$fileToUpload]['name'];
        $file_tmp = $_FILES[$fileToUpload]['tmp_name'];
        $file_ext=strtolower(end(explode('.',$_FILES[$fileToUpload]['name'])));


        if(empty($errors)==true) {
           move_uploaded_file($file_tmp,$fileNamePartTmp.$number.$file_ext);
           echo "Success";
           return true;
        }else{
           print_r($errors);
           echo "przypal";
        }
     }else{
       echo "nie jestem";
     }
     return false;
}

$userExist = false;


foreach (glob($myDir."*" , GLOB_ONLYDIR) as $currentDir) {
  if (file_exists("$currentDir/info")){
    $currentFile = fopen("$currentDir/info", "r");
    //SEKCJA KRYTYCZNA
    if(flock($currentFile, LOCK_SH)){
      $firstLine = fgets($currentFile);
        if(trim($firstLine) == trim($username)){
          $userExist = true;
          $password = md5($_POST['password']);

          $secondLine = fgets($currentFile);
          if(trim($password) == trim($secondLine)){
            echo "haslo super tez\n";
            $date =  str_replace("-","",$_POST['date']);
            $tmp = explode(":",$_POST['hour']);
            $date = $date.$tmp[0].$tmp[1].date('s');
            echo $date;
            $increment = "A00";
            //SEKCJA KRYTYCZNA PRZY INKREMENTACJI PLIKÓW
            $sem = sem_get(2);
            sem_acquire($sem);

            while(file_exists("$currentDir/$date".substr($increment,1,2))){
              $increment++.PHP_EOL;
            }

            $newFile = fopen("$currentDir/$date".substr($increment,1,2), "w");
            sem_release($sem);

            //SEKCJA KRYTYCZNA
            if(flock($newFile, LOCK_EX)){
              echo "$currentDir/$date".substr($increment,1,2)."\n";
              fwrite($newFile, $_POST['wpis']);
              flock($newFile, LOCK_UN);
            } else{
              echo "Problem z flock'iem";
            }

            fclose($newFile);

            $fileNamePart = "$currentDir/$date".substr($increment,1,2);


            echo $fileNamePart;

            /*for ($i=0;; $i++) {
              echo "fileName".$i;
              echo $fileNamePart;


              $tmp = $tmp + 1;
              if(sendFile("fileName".$i, $tmp."." , $fileNamePart)==false) break;
            }*/

            $f = 1;
            while (true) {
              if (sendFile("fileName" . $f,$f.".",$fileNamePart)==false) break;
              $f = $f + 1;

            }
            //sendFile( 'fileName1',"1.",$fileNamePart);
            //sendFile( 'fileName2',"2.",$fileNamePart);
            //sendFile( 'fileName3',"3.",$fileNamePart);

            /*if(isset($_FILES['file1'])){
                  $errors= array();
                  $file_name = $_FILES['file1']['name'];
                  $file_tmp = $_FILES['file1']['tmp_name'];
                  $file_ext=strtolower(end(explode('.',$_FILES['file1']['name'])));


                  if(empty($errors)==true) {
                     move_uploaded_file($file_tmp,"$fileNamePart"."$file_ext");
                     echo "Success";
                  }else{
                     print_r($errors);
                  }
               }*/

            //sendFile("fileName1", "$currentDir/$date".substr($increment,1,2)."1");

            /* TESTING INCREMENTATION
            $incrementTest = "A00";
            for($n = 0; $n < 7; $n++){
              echo "$currentDir/$date".substr($incrementTest++.PHP_EOL,1,2)."\n";
            }*/
          } else {
            //echo "$password\n";
            //echo "$secondLine\n";
            //echo $_POST['password'];
            echo "zle haslo!1!";
          }
        }
//
      flock($myFile, LOCK_UN);
    }else{
      echo "Problem z flock'iem";
    }
    fclose($currentFile);
  }
}

if($userExist == false){
  echo "Nie ma takiego uzytkownika";
}
?>

<?php
require 'footer.php';
?>
