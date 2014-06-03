<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php 
      session_start(); 
    ?> 

    <?php 
      if(!isset($_SESSION["username"])) {
        header('location: index.html');
      }
    ?> 
    <head>
        <title>Shopping App</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./bs/css/bootstrap.min.css" rel="stylesheet">
        <link href="./css/editableTable.css" rel="stylesheet">
        <link href="./css/alertify.core.css" rel="stylesheet">
        <link href="./css/alertify.bootstrap.css" rel="stylesheet">
        <link href="./css/style.css" rel="stylesheet">
    </head>
    <body>
        <section id="container">
            <!-- Navbar start -->
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="./home.php">Cool Logo Here</a>
                  </div>

                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">	
                    <div class="nav navbar-nav navbar-right">
                        <ul class="nav navbar-nav">
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo "".$_SESSION["username"]."" ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li class="active"><a href="./home.html">Home</a></li>
                          <li><a href="./userLists.html">My Lists</a></li>
                          <li class=><a href="./createArticle.php">Create Article</a></li>
                          <li class=><a href="./createSupermarket.php">Create Supermarket</a></li>
                          <li class="divider"></li>
                          <li><a href="#">Settings</a></li>
                          <li class="divider"></li>
                          <li><a href="./logout.php">Logout</a></li>
                        </ul>
                      </li>
                      </ul>
                    </div>
                  </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
              </nav>
            <!-- Navbar end -->
            <!-- main content start -->
              <section id="main-content">
                <section class="wrapper">
                  <div class="panel panel-default">
                    <div class="panel-body shList">
                      <h1>Your Shopping List</h1>
                    </div>
                        <table id="myTable" class="table">
                          <thead> <tr> <th>Article</th> <th>Amount</th> <th>Prize</th> <th>Market</th> </tr> </thead>
                          <tbody> <tr id="tableRow0"> <td class="editable article">Type here for new Article</td> <td class="editable amount" >1</td> <td class="prize">Prize</td> <td class="market">Market</td> </tr> </tbody>
                        </table>
                        <div class="btn-group btn-group-justified">
                          <div class="btn-group">
                            <button id="saveList" type="button" class="btn btn-default">Save List</button>
                          </div>
                          <div class="btn-group">
                            <button id="clearList" type="button" class="btn btn-default">Clear List</button>
                          </div>
                          <div class="btn-group">
                            <button type="button" class="btn btn-primary">Shopping View</button>
                          </div>
                        </div>
                    </div>
                  </div>
                </section>
            </section>
              <!-- main content end -->
          </section>

       	<!-- JQuery -->
       	<script src="./js/jquery.js"></script>
       	<!-- Bootstrap -->
        <script src="./bs/js/bootstrap.min.js"></script> 
        <!-- EditableTalbe -->
        <script src="./js/listJs.js"></script>
        <script src="js/alertify.js"></script>
        <!-- login -->
        <script src="./js/login.js"></script>
    </body>
</html>
