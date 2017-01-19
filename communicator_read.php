<?php
$filename = "messages";
if (!file_exists($filename)) {
	$file = fopen($filename, "w");
	fclose($file);
} else {
  $file = fopen($filename, "r");

  if(flock($file,LOCK_SH)){
  	//$file = fopen($filename, "r");
  	$text = fread($file, filesize($filename));
    flock($file,LOCK_UN);
  }
	fclose($file);
	echo $text;
}
?>
