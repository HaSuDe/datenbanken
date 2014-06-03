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
                        <div class="col-md-12">
                          <table id="myTable">
                            <thead> <tr> <th>Article</th> <th>Amount</th> <th>Prize</th> <th>Market</th> </tr> </thead>
                            <tbody> <tr> <td class="editable">Article</td> <td class="editable" >1</td> <td>Prize</td> <td>Market</td> </tr> </tbody>
                          </table>
                        </div>
                        </div>
                        <div>
                          <a href='' id="saveList"> Save List </a> |
                          <a href='' id="clearList"> Clear List </a>
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
