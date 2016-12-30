<?php

      $stmt = $db->prepare('SELECT pid, title, content FROM pages WHERE pid = :postID');
      $stmt->execute(array(':postID' => $_GET['page']));
      $row = $stmt->fetch();

      //if post does not exists redirect user.
      if($row['pid'] == ''){
        header('Location: ./index.php');
        exit;
      }


    try {
          $stmt = $db->prepare('SELECT pid, title, content FROM pages WHERE pid = :postID');
          $stmt->execute(array(':postID' => $_GET['page']));
          $row = $stmt->fetch();

          {

            echo '<div>';
            echo '<h1>'.$row['title'].'</h1>';
            echo '<p>'.$row['content'].'</p>';       
            echo '</div>';

          }
        } catch(PDOException $e) 
        {
          echo $e->getMessage();
        }
 ?>
