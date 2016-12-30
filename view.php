<!--includes config file of the CMS, which is a must include for every page -->
<?php require('includes/config.php'); ?>

<html>
<!--includes header of page-->
<?php include 'includes/header.php'; ?>

<body>
<!-- includes navbar of the site-->
<?php include 'includes/nav.php' ?>

<!--main content starts from here-->
    <div class="jumbotron">
      <div class="container">
       <?php include 'includes/post.php'; ?>
      </div>
    </div>
<!-- end of content-->
<!--includes footer-->
<?php include 'includes/footer.php'; ?>
</body>
</html>