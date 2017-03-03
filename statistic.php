<a name="stats"></a><br>
<section class="container">
    <div class="stats-box">
        <p>Antal inlägg</p><span class="numbers">
        <?php
        $user_id = $_SESSION['id'];
        $query= "SELECT * FROM posts WHERE posts.user_id = {$user_id}"; 
        $blogpostTotal = getDbConnection($query);
        $rowcount = mysqli_num_rows($blogpostTotal);
        echo $rowcount;
        ?></span>
    </div>
    <div class="stats-box">
        <p>Antal kommentarer</p><span class="numbers">
        <?php
        $query = "SELECT comments.id FROM comments LEFT JOIN posts ON posts.id = comments.post_id LEFT JOIN users ON posts.user_id = users.id WHERE users.id = {$user_id} ORDER BY comments.id";
        $commentsTotal = getDbConnection($query);
        $rowcount = mysqli_num_rows($commentsTotal);
        echo $commentsTotal->num_rows;
        ?></span>
    </div>
        <div class="stats-box">
        <p>Kommentarer per inlägg</p><span class="numbers">
        <?php
        // $query= "SELECT * FROM comments LEFT JOIN posts ON comments.post_id =  ORDER BY id"; //HUR???

        // $result = getDbConnection($query);
        // $rowcount = mysqli_num_rows($result);
        $averageComments = $commentsTotal->num_rows / $rowcount;
        $floatValue = floatval($averageComments);

        echo $floatValue;
        

        //$averageComments = $commentsTotal/$blogpostTotal; //Kan inte konverteras till int!!
        //echo $averageComments;
        ?></span>
    </div>
</section>
