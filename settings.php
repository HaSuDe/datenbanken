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
                          <li class=""><a href="./home.php">Home</a></li>
                          <li><a href="./userLists.php">My Lists</a></li>
                          <li class=><a href="./createArticle.php">Create Article</a></li>
                          <li class=><a href="./createSupermarket.php">Create Supermarket</a></li>
                          <li><a href="./articleOverview.php">Article Overview</a></li>
                          <li class="divider"></li>
                          <li><a class="active" href="./settings.php">Settings</a></li>
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
                  <h1>Personal Settings</h1>
                  <hr>
                  <div class="row">
                      
                      <div class="col-md-12 personal-info">
                        <div class="alert alert-danger alert-dismissable hidden">
                          <a class="panel-close close" data-dismiss="alert">×</a> 
                        </div>
                        <h3>Personal info</h3>
                        
                        <form id="personalForm" class="form-horizontal" role="form">
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Username:</label>
                            <div class="col-lg-10">
                              <input id="userName" name="name" class="form-control" type="text" value=<?php echo "".$_SESSION["username"].""?> readonly>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Email:</label>
                            <div class="col-lg-10">
                              <input id="userEmail" name="email" class="form-control" type="text" placeholder="email">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-2 control-label">Password:</label>
                            <div class="col-md-10">
                              <input name="password" class="form-control" type="password" placeholder="">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-2 control-label">Confirm password:</label>
                            <div class="col-md-10">
                              <input name="password" class="form-control" type="password" placeholder="">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">City, postal code:</label>
                            <div class="col-lg-5">
                              <input id="userCity" name="city" class="form-control" type="placeholder" placeholder="City">
                            </div>
                            <div class="col-lg-5">
                              <input id="userCode" name="code" class="form-control" type="placeholder" placeholder="Code">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Address:</label>
                            <div class="col-lg-10">
                              <input id="userStreet" name="address" class="form-control" type="text" placeholder="Address">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-2 control-label"></label>
                            <div class="col-md-10">
                              <input id="savePersonalBtn" type="button" class="btn btn-primary" value="Save Changes">
                              <input id="cancelPersonalBtn" type="reset" class="btn btn-default" value="Cancel">
                            </div>
                          </div>
                        </form>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 markets">
                    <h3>Markets</h3>
                    <form id="marketForm" class="form-horizontal" role="form">
                      <div class="form-group">
                        <label class="col-md-2 control-label"></label>
                        <div class="col-md-8">
                          <input class="form-control" type="text" placeholder="MarketName">
                        </div>
                        <div class="col-md-2">
                          <input type="button" class="btn btn-default findM" value="Find Market">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                          <input id="addMarketBtn" type="button" class="btn btn-primary" value="Add Market">
                          <input id="saveMarketBtn" type="button" class="btn btn-primary" value="Save Changes">
                          <input id="cancelMarketBtn" type="reset" class="btn btn-default" value="Cancel">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
            </section>
              <!-- main content end -->
              <!-- Modal Find Market-->
              <div id="findMarketM" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Find Market</h4>
                      </div>
                      <div class="modal-body">
                        <form id="modalSearch">
                            <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="control-label">Market name (e.g. REWE):</label>
                                      <input name="name" class="form-control modalSearch" type="text" placeholder="Marketname here">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label">Country:</label>
                                    <input name="country" class="form-control modalSearch" type="text" placeholder="Enter your Country">
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label">City:</label>
                                    <input name="city" class="form-control modalSearch" type="text" placeholder="Enter your City">
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label">Postal Code:</label>
                                    <input name="code" class="form-control modalSearch" type="text" placeholder="Postal Code">
                                  </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="control-label">Address:</label>
                                    <input name="street" class="form-control modalSearch" type="text" placeholder="Enter the adress the market should be in">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Longitude:</label>
                                    <input name="longitude" class="form-control modalSearch" type="text" placeholder="You can find this value on Google Maps">
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label">Latitude:</label>
                                    <input name="latitude" class="form-control modalSearch" type="text" placeholder="You can find this value on Google Maps">
                                  </div>
                            </div>
                        </form>
                      </div>

                      <!-- Result view -->
                      <div class="marketView col-sm-12">
                        <h4>The following Markets were found</h4>
                        <ol id="marketList">
                        </ol>
                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
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
        <!-- EditableTalbe -->
        <script src="js/alertify.js"></script>

        <script src="js/settings.js"></script>

    </body>
</html>
