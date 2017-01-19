<?php
require 'header.php';
?>

<?php

/*  function showMenu(){
    echo "<h1> NOWY BLOG/WPIS: </h1>";
    echo "<a href=http://student.agh.edu.pl/~karosowa/blog_form.php>Zaloz nowy blog</a> <br />";
    echo "<a href=http://student.agh.edu.pl/~karosowa/entry_form.php>Zrob nowy wpis</a><br />";
  }*/



  function readFromInfo($dir){
    $myFile = fopen("$dir/info", "r") or exit("Nie da się otworzyć pliku!");
    //SEKCJA KRYTYCZNA
    if(flock($myFile, LOCK_SH)){
      echo "<h1>Nazwa bloga: $dir </h1>";
      echo "<h1>Wykonawca: ".fgets($myFile)."</h1>";
      fgets($myFile); //ominięcie hasła
      while(!feof($myFile)){
        echo "<p>".fgets($myFile). "<br /></p>";
      }
      flock($myFile, LOCK_UN);
    } else{
      echo "Bład z flock'owaniem";
    }
      fclose($myFile);
  }

  function readComments($dir){
    $currentFiles = scandir($dir, 0);
    //echo count($currentFiles);
    //echo "$currentFiles[2]";
    for($i = 2; $i < count($currentFiles); $i++){
      if(is_file($dir."/".$currentFiles[$i])){

          $myFile = fopen($dir."/".$currentFiles[$i], "r");
          //SEKCJA KRYTYCZNA
          if(flock($myFile, LOCK_SH)){
          echo "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<br />";
          echo fgets($myFile)."<br />";
          echo "Komentarz napisany przez: ".fgets($myFile)."<br />";
          echo "O godzinie: ".fgets($myFile)."<br />";
          while(!feof($myFile)){
            echo "<p>".fgets($myFile)."<br /></p>";
          }
          flock($myFile, LOCK_UN);
        } else{
          echo "Błąd z flock'owaniem";
        }
        fclose($myFile);
      }


  }
}
  function readEntries($dir){
    $currentFiles = scandir($dir, 0);
    //echo count($currentFiles);
    //echo "$currentFiles[2]";
    for($i = 2; $i < count($currentFiles); $i++){
      if(is_file($dir."/".$currentFiles[$i])){
        if(count(explode(".",$currentFiles[$i])) > 1){
           //echo '<a href="' . "$dir/$currentFiles[$i]" . '">Zalacznik' . $currentFiles[$i] . '</a><br />';
        }else{
          if($currentFiles[$i] != "info"){
            $myFile = fopen($dir."/".$currentFiles[$i], "r");
            //SEKCJA KRYTYCZNA
            if(flock($myFile, LOCK_SH)){
              echo "===============================================================================<br />";
              echo $currentFiles[$i];
              while(!feof($myFile)){
                echo "<p>".fgets($myFile)."<br /></p>";
              }
              flock($myFile, LOCK_UN);
            }else {
              echo "Bład z flock'owaniem";
            }

          fclose($myFile);
            foreach (glob($dir."/".$currentFiles[$i]."*") as $zalacznik) {
              if(is_file($zalacznik) && $zalacznik != $dir."/".$currentFiles[$i]){
                 echo '<a href="' . "$zalacznik" . '">Zalacznik' . $zalacznik . '</a><br />';
              }
            }
            readComments($dir."/".$currentFiles[$i].".k");

          //**************

          /*if(file_exists()){
            readComments();
          }*/

            echo '<form action="comment_form.php" method="post">' .
            '<input type="hidden" name="blogName" value="' . $dir . '">' .
            '<input type="hidden" name="articleName" value="' . $currentFiles[$i] . '">' .
            '<input type="submit" name="submit" value="Skomentuj"></form>';


          }
        }
      }
    }
    /*foreach (scandir($myDir) as $currentFile) {
      if(is_file($currentFile)){
        $myFile = fopen("$dir/$currentFile", "r");
        //SEKCJA KRYTYCZNA
        if(flock($myFile, LOCK_SH)){
          while(!feof($myFile)){
            echo "<p>".fgets($myFile). "<br /></p>";
          }
          /*if(file_exists()){
            readComments();
          }
        flock($myFile, LOCK_UN);
      } else {
        echo "Błąd z flock'owaniem";
      }
        fclose($myFile);
      } else{
        echo "XD";
      }
    }*/
  }


  if(isset($_GET['nazwa'])){
    $nazwa = $_GET['nazwa'];
    $exist = false;

    foreach (glob($myDir."*" , GLOB_ONLYDIR) as $currentDir) {
      if(trim($currentDir) == trim($nazwa)){
        $exist = true;
        //showMenu();
        echo "-------------------";
        readFromInfo($currentDir);
        readEntries($currentDir);

      }
    }

    if($exist == false){
      echo 'Blog o podanej nazwie nie istnieje';
    }

}else{
  //showMenu();

  echo "<h1> BLOGI: </h1>";
  foreach (glob($myDir."*" , GLOB_ONLYDIR) as $currentDir) {
    echo "<a href=http://charon.kis.agh.edu.pl/~sowakaro/blog.php?nazwa=$currentDir>$currentDir</a><br />";
  }
}
?>

<?php
require 'communicator.html';
?>


<?php
require 'footer.php';
?>
