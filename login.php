<?php
  include "header.php";

  if(isset($_GET["registered"]) && $_GET["registered"] == true) {
    echo "<p class='messages'>Du är nu registrerad och kan logga in nedan.</p>";
  } 

  if(isset($_GET["wrongpass"]) && $_GET["wrongpass"] == true ) {
   echo "<p class='messages'>Fel användarnamn eller lösenord. Försök igen!</p>";
  }

  if(isset($_GET["logout"]) && $_GET["logout"] == true ) { 
   echo "<p class='messages'>Du är nu utloggad. Välkommen åter!</p>";
  }
?>

<fieldset class="login">
  <h2>Logga in</h2>
  <form action="logincheck.php" method="post">
    <input class="input" required="required" type="text" name="user" placeholder="Användarnamn"><br>
    <input class="input" required="required" type="password" name="pass" placeholder="Lösenord"><br>
    <input class="button" type="submit" name="login" value="Logga in">
  </form>
  <p>Ej medlem? Registrera dig <span class="link-styling"><a href="register.php">här!</a></span><p>
</fieldset>

<?php
  include "footer.php";
?>