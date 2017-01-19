<?php
require 'header.php';
?>

  <form action='koment.php' method="post">
	Rodzaj komentarza:
  <select name="commentValue">
    <option value="Pozytywny">Pozytywny</option>
    <option value="Negatywny">Negatywny</option>
    <option value="Neutralny">Neutralny</option>
  </select>
  <br />
	Komentarz: <br /><textarea name="komentarz"/></textarea><br />
	Twórca: <input type="text" name="login" /><br />
  <input type="hidden" name="blogName" value="<?php echo $_POST['blogName'] ?>">
  <input type="hidden" name="articleName" value="<?php echo $_POST['articleName'] ?>">

	<input type="submit" value="Wyslij" />
	<input type="reset" value="Wyczyść" />



  </form>

  <?php
  require 'footer.php';
  ?>
