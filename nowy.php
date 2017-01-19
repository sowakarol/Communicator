<?php
require 'header.php';
?>

<?php
// utworzenie pliku

  $myDir = $_POST['nazwa'];
  $myDir = str_replace(" ", "_" , $myDir);

  // SEKCJA KRYTYCZNA BY NIE BYŁO DWÓCH TYCH SAMYCH BLOGÓW Z RÓZNYMI WŁAŚCICIELAMI
  $sem = sem_get(1);
  sem_acquire($sem);
  if (!file_exists($myDir)) {
    mkdir($myDir, 0755, true); //trzeci argument - rekursywa
    sem_release($sem);
    echo 'sukces';
    $myFile = fopen("$myDir/info","w");
    //SEKCJA KRYTYCZNA
    if(flock($myFile, LOCK_EX)){

      $username = $_POST['username'];
      $password = md5($_POST['password']);
      echo $password;
      echo $_POST['password']."\n";
      echo md5($_POST['password']);

      file_put_contents("$myDir/info", $_POST['username']."\n".md5($_POST['password'])."\n".$_POST['opis']."\n", FILE_APPEND);

      flock($myFile, LOCK_UN);
    } else {
      echo "Wystapil problem z flock'iem";
      sem_release($sem);
    }
    fclose($myFile);

  } else {
    echo 'Nazwa blogu juz zajeta :(';
  }


?>

<?php
require 'footer.php';
?>
