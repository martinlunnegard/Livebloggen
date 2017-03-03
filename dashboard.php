<?php
  include "header.php";


  // $conn = new mysqli("localhost", "root", "", "blog");
  // mysqli_set_charset($conn, "utf8");
  // setlocale(LC_ALL, 'sv_SE');
  // $stmt = $conn->stmt_init();

  $uFn = $_SESSION["firstname"];  //Här kan vi bara ha en session start. redan definierat i logincheck.
  $uLn = $_SESSION["lastname"];
  $uMail = $_SESSION["e-mail"];
  $desc = $_SESSION["description"];
  $user_id = $_SESSION['id'];
  $uImg = $_SESSION["userimage"];
  $usN = $_SESSION["username"];
  // $user_img = isset($_SESSION["userimage"]) ? $_SESSION["userimage"] : NULL;

  if( isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {

  } else {
    header ("Location: login.php");
  } 
?>

<!--Sektion som visar användaruppgifter-->
<section class="profile-content-holder">
  <div class="profile_img_placeholder">
    <?php if(isset($_SESSION["userimage"])) { ?>
      <img class="profile_img" src="<?php echo $_SESSION['userimage']; ?> " alt="Profilbild på <?php echo $usN; ?>">
    <?php 
    } else {
      $path = "<img src='userpics/default.jpg'>";
      echo $path;
    } ?>

  </div> <!--profile_img_placeholder-->
  <div class="profile-content">
    <h2><?php echo $usN; ?> </h2>
    <p>
    Förnamn: <?php echo $uFn; ?> <br> 
    Efternamn: <?php echo $uLn; ?> <br> 
    Email: <?php echo $uMail; ?><br><br>

  <?php
      if ($_SESSION["admin"] == 1) {
        echo "Behörighet: Superadministratör";
      }
    ?>

    </p>
    <a href="write_post.php"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Nytt inlägg</a><br>
    
    <a href="dashboard.php?settings=true"><i class='fa fa-cog' aria-hidden='true'></i>Inställningar</a><br>
    <?php if(isset($_GET["settings"])) {
    echo "<a href='edit_posts.php'><i class='fa fa-wrench' aria-hidden='true'></i> Hantera inlägg</a><br>";
     if(isset($_SESSION["userimage"])!= NULL) {
    echo "<a href ='dashboard.php?imgupload=true#bild'><i class='fa fa-user' aria-hidden='true'></i> Uppdatera din profilbild </a>"; ?>
    <?php 
    } else { 
      echo "<a href='dashboard.php?imgupload=true#bild'><i class='fa fa-user' aria-hidden='true'></i> Ladda upp profilbild </a>";
    } ?><br>

    <?php if(isset($_SESSION["description"])!= NULL) { ?>
      <?php echo "<a href ='dashboard.php?desc=true#text'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Uppdatera din beskrivning</a>";
    } else {
      echo "<a href ='dashboard.php?desc=false#text'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Lägg till en beskrivning</a>";
    } ?> <br>

    <?php 
    echo "<a href='dashboard.php?stats=true#stats'><i class='fa fa-bar-chart' aria-hidden='true'></i> Statistik</a><br>";
    } ?>

    <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logga ut</a>
    <!--</p>-->
  </div>
  <?php 
  if(isset($_SESSION["description"])!= 0) { ?>
    <article class="text"> <!--class description?-->
      <p><?php echo nl2br($desc); ?></p>
    </article><?php 
  } ?>
</section><!-- </section> profile-content end-->

<?php 
  if (isset($_GET['stats'])) {
      include "statistic.php";
  } 
  if (isset($_GET['imgupload'])) {
      include "fileupload.php";
  }
  if(isset($_GET['desc'])) {
      include "descupload.php";
  }
  ?>
<br>
<h2 class="messages">Dina inlägg</h2>
<section class="container">
  <?php $posts = fetchUserBlogPosts(); foreach($posts as $post) : ?> <!--Id:et fungerar inte!!-->
  <article class="post">
      <a href="blog_post.php?id=<?php echo $post['id']?>"><img class='post-image' src="<?php echo $post['post_img']; ?>">
      <h3><?php echo $post['post_title']; ?></h3>
      <p><?php echo $post['publish_date']; ?></p></a>
  </article>
  <?php endforeach; ?>
</section> <!--container end-->

<?php
  include "footer.php";
?>