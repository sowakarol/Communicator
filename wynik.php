<?php
  header('Content-type: text/plain');
  	function witaj($imie = 'Jasiu') {
		return 'Cze�� ' . $imie . '!';
	}

	print_r($_GET);
	print_r($_POST);

	print(witaj($_GET['nazwa'])); printf(witaj());

	print(witaj($_POST['nazwa']));
	if(file_exists($_GET['id'].'.txt')){
		$plik = fopen($_GET['id'].'.txt', 'r');
		while (!feof($plik)) {
		  $s = fgets($plik);
		  echo $s;
		}

	} else {
		echo "FILE_NOT_FOUND";

	}
fclose($plik);

?>
