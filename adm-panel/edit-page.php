<?php //include config
require_once('../includes/config.php');

//if not logged in redirect to login page
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
            <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
            <li><h3>Posts</h3></li>
            <li><a href="add-post.php">Add New</a></li>
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
          <h1 class="page-header">Edit Page</h1>



  <?php

  //if form has been submitted process it
  if(isset($_POST['submit'])){

    $_POST = array_map( 'stripslashes', $_POST );

    //collect form data
    extract($_POST);

    //very basic validation
    if($pid ==''){
      $error[] = 'This post is missing a valid id!.';
    }

    if($title ==''){
      $error[] = 'Please enter the title.';
    }

    if($content ==''){
      $error[] = 'Please enter the description.';
    }

    if(!isset($error)){

      try {

        //insert into database
        $stmt = $db->prepare('UPDATE pages SET title = :title, content = :content WHERE pid = :pid') ;
        $stmt->execute(array(
          ':title' => $title,
          ':content' => $content,
          ':pid' => $pid
        ));

        //redirect to index page
        header('Location: view-pages.php?action=updated');
        exit;

      } catch(PDOException $e) {
          echo $e->getMessage();
      }

    }

  }

  ?>


  <?php
  //check for any errors
  if(isset($error)){
    foreach($error as $error){
      echo $error.'<br />';
    }
  }

    try {

      $stmt = $db->prepare('SELECT pid, title, content FROM pages WHERE pid = :pid') ;
      $stmt->execute(array(':pid' => $_GET['id']));
      $row = $stmt->fetch(); 

    } catch(PDOException $e) {
        echo $e->getMessage();
    }

  ?>

  <form action='' method='post'>
    <input type='hidden' name='pid' value='<?php echo $row['pid'];?>'>

    <p><label>Title</label><br />
    <input type='text' name='title' value='<?php echo $row['title'];?>'></p>

    <p><label>Description</label><br />
    <textarea name='content' cols='60' rows='10'><?php echo $row['content'];?></textarea></p>

    <p><input type='submit' name='submit' value='Update'></p>

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
