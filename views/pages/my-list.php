<!DOCTYPE html>
<!-- saved from url=(0059)http://getbootstrap.com/docs/4.0/examples/starter-template/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Anabella Di Grazia">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

    <title>My To-Do List</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    
    <link href="fontello/css/fontello.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="logoutdiv"><p>Logged as <span class="username"><?php echo $user->getUsername();?></span></p><a onclick="logout()">Log out</a></div>
    </nav>
    <?php include ROOT_PATH . 'views/sections/modal.php'?>
    <div class="container">
        <!-- Modal -->

      <div class="starter-template">
        <h1>My to-do list</h1>
        <div><p id="msj"></p></div>
        <div class="item-list" id="item-list">
            <?php include ROOT_PATH . 'views/sections/list.php'; ?>
        </div>
        <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-add">Create new to do Item</button>
      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.2.1.min.js"></script>
<!--    <script src="js/jquery-3.2.1.slim.min.js.descarga" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>-->
    <script src="js/popper.min.js.descarga"></script>
    <script src="js/bootstrap.min.js.descarga"></script>
    <script src="js/app.js"></script>
   
  

</body></html>