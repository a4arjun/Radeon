    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./index.php">Radeon</a>
        </div>
        <div class="navbar-collapse collapse">
          
                    <?php
                          try {

                            $stmt = $db->query('SELECT  pid,title FROM pages ORDER BY pid ASC');
                            while($row = $stmt->fetch()){
                              
                              echo '<ul class="nav navbar-nav">';
                                echo '<li><a href="page.php?page='.$row['pid'].'">'.$row['title'].'</a></li>';       
                              echo '</ul>';

                            }

                          } catch(PDOException $e) {
                              echo $e->getMessage();
                          }
                    ?>

        </div><!--/.navbar-collapse -->
      </div>
    </div>