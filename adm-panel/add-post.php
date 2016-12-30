<?php
require_once('../includes/config.php');

if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Admin Panel</title>

    <!-- Bootstrap core CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="styles/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Radeon</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="#">Overview <span class="sr-only">(current)</span></a></li>
            <li><h3>Posts</h3></li>
            <li class="active"><a href="add-post.php">Add New</a></li>
            <li><a href="view-posts.php">View Posts</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><h3>Pages</h3></li>
            <li><a href="add-page.php">Add New</a></li>
            <li><a href="view-pages.php">Manage Pages</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><h3>Customize</h3></li>
            <li><a href="">Themes</a></li>
            <li><a href="">Edit site details</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Add New Post</h1>

    <?php

        //if form has been submitted process it
        if(isset($_POST['submit'])){

          $_POST = array_map( 'stripslashes', $_POST );

          //collect form data
          extract($_POST);

          //very basic validation
          if($postTitle ==''){
            $error[] = '<div class="alert alert-danger">Please enter the title.</div>';
          }

          if($postDesc ==''){
            $error[] = '<div class="alert alert-danger">Please enter the description.</div>';
          }

          if($postCont ==''){
            $error[] = '<div class="alert alert-danger">Please enter the content.</div>';
          }

          if(!isset($error)){

            try {

              //insert into database
              $stmt = $db->prepare('INSERT INTO blog_posts (postTitle,postDesc,postCont,postDate) VALUES (:postTitle, :postDesc, :postCont, :postDate)') ;
              $stmt->execute(array(
                ':postTitle' => $postTitle,
                ':postDesc' => $postDesc,
                ':postCont' => $postCont,
                ':postDate' => date('Y-m-d H:i:s')
              ));

              //redirect to index page
              header('Location: index.php?action=added');
              exit;

            } catch(PDOException $e) {
                echo $e->getMessage();
            }

          }

        }

        //check for any errors
        if(isset($error)){
          foreach($error as $error){
            echo '<p class="error">'.$error.'</p>';
          }
        }
  ?>

  <form action='' method='post'>

    <p><label>Title</label><br />
    <input class="title" type='text' name='postTitle' value='<?php if(isset($error)){ echo $_POST['postTitle'];}?>'></p>

    <p><label>Description</label><br />
    <textarea class="title" name='postDesc' cols='60' rows='5'><?php if(isset($error)){ echo $_POST['postDesc'];}?></textarea></p>

    <p><label>Content</label><br />
    <textarea class="title" name='postCont' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postCont'];}?></textarea></p>

    <p><input class="btn btn-primary" type='submit' name='submit' value='Submit'></p>

  </form>

        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
    <script>
          tinymce.init({
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
    </script>
  </body>
</html>
