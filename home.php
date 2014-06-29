<!DOCTYPE html>
<!--
Author Julian Suttner, Niklas Hatje, Cedric Deege
-->
<html>
    <?php 
      session_start(); 
    ?> 

    <?php 
      if(!isset($_SESSION["username"])) {
        $_SESSION["error"] = "Bitte loggen Sie sich zunächst ein.";
        header('location: index.php');
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
                      <a class="navbar-brand" href="./home.php">Logo</a>
                  </div>

                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">	
                    <div class="nav navbar-nav navbar-right">
                        <ul class="nav navbar-nav">
                        <li class="dropdown">
                        <a id="userName" href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo "".$_SESSION["username"]."" ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li class="active"><a href="./home.php">Home</a></li>
                          <li><a href="./userLists.php">My Lists</a></li>
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
                          <tbody id="myTableBody"> 
                          <?php if(!isset($_GET["listID"])) : ?>
                            <tr id="tableRow0"> 
                              <td class="editable article">Type here for new Article</td> 
                              <td class="editable amount" >1</td> 
                              <td class="prize">Prize</td> 
                              <td class="market">Market</td> 
                            </tr>
                          <?php endif; ?> 
                          <?php 
                            if(isset($_GET["listID"])) {
                              include 'ajax/loadTable.php';
                              load();
                            } 
                          ?>
                          </tbody>
                        </table>
                        <div class="btn-group btn-group-justified">
                          <div class="btn-group">
                            <button id="saveList" type="button" class="btn btn-default">Save List</button>
                          </div>
                          <div class="btn-group">
                            <button id="clearList" type="button" class="btn btn-default">Clear List</button>
                          </div>
                          <div class="btn-group">
                            <button id="shoppingView" type="button" class="btn btn-primary">Shopping View</button>
                          </div>
                        </div>
                    </div>
                  </div>
                </section>
            </section>
              <!-- main content end -->
              
              <!-- Modal type Shoppinglist Name-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="listNameModal" class="modal fade">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">Enter Shoppinglist name</h4>
                          </div>
                          <div class="modal-body">
                            <form action="/changeEventData" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                      <p>Enter Name</p>
                                      <input type="text" name="listName" id="listName" placeholder="List name" autocomplete="off" class="modal-form-control placeholder-no-fix">
                                    </div>
                                </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                              <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                              <button class="btn btn-success" id="shoppingListNameSubmit" type="submit">Save</button>
                          </div>
                      </div>
                  </div>
                </div>
               <!-- modal type Shoppinglist Name-->
          </section>

       	<!-- JQuery -->
       	<script src="./js/jquery.js"></script>
       	<!-- Bootstrap -->
        <script src="./bs/js/bootstrap.min.js"></script> 
        <!-- Load availabe Articles(XML)-->
        <script src="./js/loadArticleXML.js"></script>
        <!-- EditableTalbe -->
        <script src="./js/listJs.js"></script>
        <script src="js/alertify.js"></script>
        <!-- login -->
        <script src="./js/login.js"></script>
        <script src="./js/shoppingView.js"></script>
        <script src="./js/saveShoppingList.js"></script>

    </body>
</html>
