<?php
    try {
          $stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
          $stmt->execute(array(':postID' => $_GET['page']));
          $row = $stmt->fetch();
              {

                  echo '<div>';
                  echo '<h1>'.$row['postTitle'].'</h1>';
                  echo '<p>'.$row['postCont'].'</p>';       
                  echo '</div>';

              }

              } catch(PDOException $e) {
                                echo $e->getMessage();
                            }

              $stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
              $stmt->execute(array(':postID' => $_GET['page']));
              $row = $stmt->fetch();

              if($row['postID'] == ''){
                              header('Location: ./index.php');
                              exit;
                            }

?>
