<?php
require 'header.php';
?>

<?php
  $folder = $_POST['blogName'];
  $commentFolder = $_POST['articleName'];
  echo "jestem tu";
  echo $folder;
  echo $commentFolder;

  $fullCommentFolderName = $folder."/".$commentFolder.".k";
  if(!file_exists(($fullCommentFolderName))){
    @mkdir($fullCommentFolderName, 0755);
  }






  //SEKCJA KRYTYCZNA
  //$numberOfComments = glob($fullCommentFolderName."/*");
  $sem = sem_get(3);
  sem_acquire($sem);
  $allComments = scandir($fullCommentFolderName);
  $numberOfNewComment = count($allComments)-2;

  echo $numberOfNewComment;
  sem_release($sem);


  $myFile = fopen("$fullCommentFolderName/$numberOfNewComment", "w");
  if(flock($myFile, LOCK_SH)){

    echo "$fullCommentFolderName/$numberOfNewComment";

    switch($_POST['commentValue']){
      case "Pozytywny":
        fwrite($myFile, "Komentarz pozytywny\n");
        break;
      case "Negatywny":
        fwrite($myFile, "Komentarz negatywny\n");
        break;
      case "Neutralny":
        fwrite($myFile, "Komentarz neutralny\n");
        break;
      }

      fwrite($myFile, $_POST['login']."\n");
      fwrite($myFile, date('Y-m-d').", ".date('H-i-s')."\n");
      fwrite($myFile, $_POST['komentarz']);
      flock($myFile, LOCK_UN);
  } else{
    echo "Błąd w flock'owaniu";
  }

    fclose($myFile);

?>

<?php
require 'footer.php';
?>
