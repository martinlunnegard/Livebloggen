<?php

?>
<a name="text"></a>
<section class="comment-container">
    <form method="post">
        <textarea name="userdesc" class="comment-input" placeholder="Skriv in en beskrivning om dig själv">
            <?php if(isset($_SESSION["description"]) && $_SESSION["description"] == true) { echo $_SESSION['description']; }?>
        </textarea> 
        <input class="post-button" type="submit" name="upload" value="Spara beskrivning">  <!--kanske skall döpa om denna class till ett allmänt namn-->
    </form>
</section> <!--comment-container end-->

<?php
if (isset($_POST["upload"])) {
    $id = $_SESSION["id"]; //Behövs denna? Borde den inte känna av detta om man lägger in session start?
    $desc = mysql_real_escape_string($_POST['userdesc']);

    //$query = "UPDATE users SET description = '$desc' WHERE id = '{$id}'";
    $query = "UPDATE users SET description = '$desc' WHERE id = '{$id}'";
    getDbConnection($query);
    $_SESSION["description"] = $desc;
    header ("Location: dashboard.php");
} 
?>