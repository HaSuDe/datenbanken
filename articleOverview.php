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
        <title>Create Article</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./bs/css/bootstrap.min.css" rel="stylesheet">
        <link href="./css/editableTable.css" rel="stylesheet">
        <link href="./css/style.css" rel="stylesheet">
        <link href="./css/alertify.core.css" rel="stylesheet">
        <link href="./css/alertify.bootstrap.css" rel="stylesheet">
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
                      <a class="navbar-brand" href="./home.php"><img src="images/logo.png" alt="" width="70px"></a>
                  </div>
                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">  
                    <div class="nav navbar-nav navbar-right">
                        <ul class="nav navbar-nav">
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo "".$_SESSION["username"]."" ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="./home.php">Home</a></li>
                          <li><a href="./userLists.php">My Lists</a></li>
                          <li><a href="./createArticle.php">Create Article</a></li>
                          <li><a href="./createSupermarket.php">Create Supermarket</a></li>
                          <li class="active"><a href="./articleOverview.php">Article Overview</a></li>
                          <li class="divider"></li>
                          <li><a href="./settings.php">Settings</a></li>
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
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                  <div class="panel panel-default">
                    <div class="panel-body">
	                    <h1>List of all articles<br/> <small>Click on the article you like to see or edit</small></h1>
                        <ul id="articleList" class="list-group">
                        </ul>
                    </div>
                  </div>
                </section>
            </section>
            <!-- main content end -->  
            
            <!-- Modal type Shoppinglist Name-->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="articleModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Article Overview</h4>
                      </div>
                      <div class="modal-body">
                        <form action="/changeEventData" method="post">
                            <div id="showArticle" class="row">
                                <div class="col-md-6">
                                  <p>Name</p>
                                  <input type="text" name="listName" id="articleName" placeholder="Name" autocomplete="off" class="form-control placeholder-no-fix">
                                  <p>Brand</p>
                                  <input type="text" name="listName" id="articleBrand" placeholder="Brand" autocomplete="off" class="form-control placeholder-no-fix">
                                  <p>Supermarket</p>
                                    <input name="articleSupermarket" id="marketFinder" class="form-control" type='text' placeholder="Click to find market"></input>
                                  <p>Prize in Euro</p>
                                  <input type="text" name="listName" id="articlePrize" placeholder="Prize" autocomplete="off" class="form-control placeholder-no-fix">
                                  <p>Amount</p>
                                  <input type="text" name="listName" id="articleSize" placeholder="Size" autocomplete="off" class="form-control placeholder-no-fix">
                                  <p>Unit</p>
                                        <select id="articleUnit" class="form-control optionMenu">
                                            <option value="default">--Unit--</option>
                                            <option value="ml">ml</option>
                                            <option value="l">l</option>
                                            <option value="g">g</option>
                                            <option value="kg">kg</option>
                                            <option value="pieces">pieces</option>
                                        </select>
                                </div>
                                <div class="col-md-6">
                                    <img id="articleImage" src="uploads/article/noImage.jpg" style="width: 200px; height: 200px; margin-top:10px; " alt="Article Image">
                                </div>
                            </div>
                            
                            <div id="editArticle" class="row hidden">
                                <div class="col-md-6">
                                  <p>Name</p>
                                  <input type="text" name="listName" id="editArticleName" placeholder="Name" autocomplete="off" class="form-control placeholder-no-fix">
                                  <p>Brand</p>
                                  <input type="text" name="listName" id="editArticleBrand" placeholder="Brand" autocomplete="off" class="form-control placeholder-no-fix">
                                  <p>Supermarket</p>
                                    <input name="articleSupermarket" id="marketFinder" class="form-control finderedit" type='text' placeholder="Click to find market"></input>
                                  <p>Prize in Euro</p>
                                  <input type="text" name="listName" id="editArticlePrize" placeholder="Prize" autocomplete="off" class="form-control placeholder-no-fix">
                                  <p>Amount</p>
                                  <input type="text" name="listName" id="editArticleSize" placeholder="Amount" autocomplete="off" class="form-control placeholder-no-fix">
                                  <p>Unit</p>
                                    <select id="editArticleUnit" class="form-control optionMenu">
                                        <option value="default">--Unit--</option>
                                        <option value="ml">ml</option>
                                        <option value="l">l</option>
                                        <option value="g">g</option>
                                        <option value="kg">kg</option>
                                        <option value="pieces">pieces</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div id="buttonContainer" style="margin-top:10px;">
                                <button id="addMarket" class="btn btn-default" type="button">Add new Market to Article</button>
                                <button id="cancelAddMarket" class="btn btn-default hidden" type="button">Cancel</button>
                            </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                            <div id="articleChange">
                                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                                <button class="btn btn-success" id="articleChangeButton" type="button">Save</button>
                            </div>
                            <div class="hidden" id="articleMarketAdd">
                                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                                <button class="btn btn-success" id="articleMarketButton" type="button">Save</button>
                            </div>
                      </div>
                  </div>
              </div>
            </div>
           <!-- modal type Shoppinglist Name-->

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
        <!-- Article Overview -->
        <script src="js/articleOverview.js"></script> 
        <!-- Article View -->
        <script src="js/articleView.js"></script> 
        <!-- Alertify-->
        <script src="js/alertify.js"></script>
    </body>
</html>
