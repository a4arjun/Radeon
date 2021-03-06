<?php include 'includes/config.php';?>
<?php include 'includes/page.php';?>
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
    

    <title><?php echo $page_title; echo " | "; echo $site_title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="adm-panel/styles/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="adm-panelstyles/dashboard.css" rel="stylesheet">

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
        <a class="navbar-brand" href="index.php"><?php echo $site_title; ?></a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
			<?php include 'includes/nav.php';?>
    </div>
  </div>
</nav>
<div class="container">
<div style="padding-top:60px; padding-bottom:100px; border-bottom: 1px solid #aaa;">    
<h2><?php echo $page_title;?></h2>
<p><?php echo $page_content; ?></p>
</div>
</div>
<center><br><?php echo $footer;?>
</body>
</html>
