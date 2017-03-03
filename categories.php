<?php
  include "header.php";

/* ---------------------------------------------------
Hämtar och loopar ut kategorier om uppkoppling lyckats
--------------------------------------------------- */
$query="SELECT * FROM categories"; 

//Sektion som loopar ut kategorier
?>
<section class="sort-posts">
  <h2>Kategorier</h2> <?php
  $result = getDbConnection($query); 
  foreach($result as $category): ?>
    <a href="?id=<?php echo $category['id']; ?>"><?= $category['cat_name'];?> </a> |
  <?php endforeach; ?>
</section> <!--sort-posts end-->

<?php
/* --------------------------------------------
Sektion som loopar ut posts inom vald kategori
-------------------------------------------- */

if ( isset($_GET['id'])) {                                    
  $query = "SELECT * FROM posts WHERE cat_id = " . $_GET['id'];

?>
<section class="container">
  <?php
  if( isset($_GET['id']) ) {
    $result = getDbConnection($query); 
    foreach($result as $post): ?>
      <article class="post">
        <a href="blog_post.php?id=<?php echo $post['id'];?>"><img class="post-image"src="<?php echo $post['post_img'];?>"> 
        <h3><?php echo $post['post_title'];?></h3>
        <p><?php echo $post['publish_date']; ?></p></a>
      </article> <!--post end-->
    <?php endforeach; 
  } ?>
</section> <!--container end--> 
<?php 
}

/* ------------------------------
Sektion gör att sortera inläggen
------------------------------- */
/*?>
<section class="sort-posts">
  <p><b>Sortera inläggen efter datum:</b>
    <a href ="categories.php?sort=asc&id=<?php echo $_GET['id'];?>">Stigande</a> |
    <a href ="categories.php?sort=desc&id=<?php echo $_GET['id'];?>">Fallande</a> 
  </p>
</section> <!--sort-posts end-->
<?php

$sort="";

if (isset($_GET["sort"]) ) {
  $sort= $_GET["sort"];

  if ($sort == "asc") {
    $query= "SELECT * FROM posts WHERE cat_id = {$_GET['id']} ORDER BY publish_date ASC";
    $result = getDbConnection($query); 

  } elseif ($sort == "desc") {
    $query= "SELECT * FROM posts WHERE cat_id = {$_GET['id']} ORDER BY publish_date DESC";
    $result = getDbConnection($query); 

  } else { 
    $_GET['id'] = "";   // HUR SKA MAN TÄNKA HÄR??
    $query = "SELECT * FROM posts WHERE cat_id = {$_GET['id']}" ?>   
    <p class="messages">Vänligen välj en kategori först</p> <?php
  }
}*/

include "footer.php"; 
?>