      <?php
          try {

            $stmt = $db->query('SELECT postID, postTitle, postDesc, postDate FROM blog_posts ORDER BY postID DESC');
            while($row = $stmt->fetch()){
              
              echo '<div>';
                echo '<h1><a href="view.php?page='.$row['postID'].'">'.$row['postTitle'].'</a></h1>';
                echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
                echo '<p>'.$row['postDesc'].'</p>';       
                echo '<p><a class="btn btn-default" href="view.php?page='.$row['postID'].'">Read More &raquo;</a></p>';       
              echo '</div>';

            }

          } catch(PDOException $e) {
              echo $e->getMessage();
          }
      ?>
