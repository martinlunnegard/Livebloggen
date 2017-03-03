<?php
  include "header.php";
?>

<form method="post">
	<fieldset class="register">
		<h2>Registrera ett bloggkonto</h2>
		<input class="input" type ="text" name="username" required="required" placeholder="Användarnamn"> <br>
		<input class="input" type ="password" name="password" required="required" placeholder="Lösenord"> <br>
		<input class="input" type ="text" name="firstname" required="required" placeholder="Förnamn"> <br>
		<input class="input" type ="text" name="lastname" required="required" placeholder="Efternamn"> <br>
		<input class="input" type ="text" name="e-mail" required="required" placeholder="E-post"> <br>

		<input class="button" type="submit" name="submit" value="Registrera"> <br>
	</fieldset>
</form>

<?php
if (isset($_POST["submit"])); {															

	if(!empty($_POST["username"]) &&												
	!empty ($_POST["password"]) &&
	!empty ($_POST["firstname"]) &&
	!empty ($_POST["lastname"]) &&
	!empty ($_POST["e-mail"]) ) {

		$un = strip_tags ($_POST["username"]);										 
		$up = strip_tags ($_POST["password"]);

		$up = password_hash ($up, PASSWORD_DEFAULT); 

		$uFn = strip_tags ($_POST["firstname"]);
		$uLn = strip_tags ($_POST["lastname"]);
		$uMail = strip_tags ($_POST["e-mail"]);

		$query ="INSERT INTO users VALUES (NULL, '$un', '$up', '$uFn','$uLn', '$uMail', NULL, NULL, 0)"; 

		getDbConnection($query);
		header("Location:login.php?registered=true");
	}
}
?>

<?php 
include "footer.php";
?>