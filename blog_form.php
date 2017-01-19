<?php
require 'header.php';
?>

  <form action='nowy.php' method="post">
  	Nazwa blogu: <input type="text" name="nazwa" /><br />
	  Nazwa uzytkownika: <input type="text" name="username" /><br />
	  Haslo: <input type="password" name="password" /><br />
	  Opis blogu: <textarea name="opis"></textarea><br />

	<input type="submit" value="Wyslij" />
	<input type="reset" value="Wyczyść" />
</form>

<?php
require 'footer.php';
?>
