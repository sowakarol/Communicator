<?php
require 'header.php';
?>

  <form action='wpis.php' method="post" enctype="multipart/form-data">
	Nazwa uzytkownika: <input type="text" name="username" /><br />
	Haslo: <input type="password" name="password" /><br />
  Wpis:<textarea name="wpis"></textarea><br />

	Data: <input id="date" type='date' name="date" value="" onchange="validateDate1()"/><br />
	Godzina: <input id="hour" type='date' name="hour" value="" onchange="validateHour()"/><br />
	Załączniki:
  <div id="files">
    <input type="file" name="fileName1" onchange="addNewFile()"/>
    <br />
  </div>
	<input type="submit" value="Wyslij" name="submit"/>
	<input type="reset" value="Wyczyść" />
  </form>

  <script type="text/javascript" src="zadanie1Skrypt.js"></script>





  <?php
  require 'footer.php';
  ?>
