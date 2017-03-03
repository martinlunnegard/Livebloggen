<a name="bild"></a>

<section class="comment-container">
<!--Formulär för att ladda upp profilbild-->
<form class="upload-img" method="post" enctype="multipart/form-data">
    <input type="file" name="profile_pic">
    <input type="submit" name="upload" value="Ladda upp bild">
</form></section>
         
<!--Visningsbild för inloggade användaren.-->
<?php 
if(isset($_POST["upload"])) {
    $id = $_SESSION["id"];
    $un = $_SESSION["username"];
    $type = pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION); 

    if($type != "jpg") {  ?>
        <p class="message">Endast JPG-filer är tillåtna.</p> <?php        
        exit;
    }

    $target_folder = "userpics/";
    $target_name = $target_folder . basename($un . $id . ".jpg");

    // Ifall filen är större än 10mb så får man ett felmeddelande.
    if($_FILES["profile_pic"]["size"] > 10000000) { ?>
        <p class="message">Filen är för stor.</p> <?php
        exit;
    }

    // Flytta filen till userpics-mappen
    if(move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_name)) {
        
        $query = "UPDATE users SET profile_pic = '{$target_name}' WHERE id = '{$id}'";
        getDbConnection($query);
        $_SESSION["userimage"] = $target_name;
        header ("Location: dashboard.php");
    } 
}
?>