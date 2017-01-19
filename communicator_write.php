<?php
$filename = "messages";
$text = $_GET["username"] . ": " . $_GET["toSend"] . "\n";
$file = fopen($filename, "a");
if(flock($file, LOCK_EX)){
  fwrite($file, $text);
  flock($file,LOCK_UN);
}
fclose($file);
if(file($filename) == true){
$fileArray = file($filename);
  while (count($fileArray) > 10){
      unset($fileArray[0]);
      file_put_contents($filename, $fileArray);
  }
}
?>
