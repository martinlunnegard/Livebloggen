<?php
  include "header.php";
 
?>

<!-- Start banner -->
<div class="start-banner"></div>

<section class="container">
<?php
  $query="SELECT * FROM posts WHERE is_published = 1 ORDER BY publish_date DESC LIMIT 6";
  
  $result = getDbConnection($query); foreach($result as $post): ?>
  <article class="post">
    <a href="blog_post.php?id=<?php echo $post['id'];?>"><img class="post-image" src="<?php echo $post['post_img']; ?>" >
    <h3><?php echo $post['post_title']; ?></h3>
  </article>
  <?php endforeach; ?>
</section>

<?php
  include "footer.php";
?>