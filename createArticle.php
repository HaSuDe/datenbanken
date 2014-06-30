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
        <link href="./css/addArticle.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="js/bootstrap-fileupload/bootstrap-fileupload.css" />

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
                          <li class="active"><a href="./createArticle.php">Create Article</a></li>
                          <li><a href="./createSupermarket.php">Create Supermarket</a></li>
                          <li><a href="./articleOverview.php">Article Overview</a></li>
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
                    <div class="panel panel-default createPanel">
                        <div class="row">
                            <div class="col-md-12">
                                <header class="panel-heading">
                                    <b>Create a new Article</b>
                                </header>
                            </div>
                        </div>
                        <div class="panel-body shList">
                            <form class="form-horizontal" method="post" action="php/addArticle.php" enctype="multipart/form-data">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <!-- Article Name -->
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="articleName" placeholder="Enter Name of Article">  
                                    </div>
                                    <div class="form-group">
                                        <!-- Article Brand -->
                                        <label>Brand</label>
                                        <input type="text" class="form-control" name="articleBrand" placeholder="Enter Brand of Article">  
                                    </div>
                                    <div class="form-group">
                                        <!-- Article Prize -->
                                        <label>Prize in Euro</label>
                                        <input type="text" class="form-control" name="articlePrize"placeholder="Enter Prize of Article">  
                                    </div>
                                    <div class="form-group">
                                        <label for="supermarket">Amount</label>
                                        <div class="input-group">
                                            <input type="text" placeholder="Enter Amount" name="articleAmount" class="form-control">
                                            <div class="input-group-btn">
                                                <select name="articleAmountUnit" class="form-control optionMenu">
                                                    <option value="default">--Unit--</option>
                                                    <option value="ml">ml</option>
                                                    <option value="l">l</option>
                                                    <option value="g">g</option>
                                                    <option value="kg">kg</option>
                                                    <option value="pieces">pieces</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <!-- Supermarket -->
                                        <label for="supermarket">Supermarket</label>
                                        <input name="articleSupermarket" id="marketFinder" class="form-control" type='text' placeholder="Click to find market"></input>
                                    </div>                                 
                                    <div class="form-group addButton"> 
                                      <button type="submit" class="btn btn-default">Add Article</button>
                                    </div>
                                    <?php 
                                        if(isset($_SESSION["status"]) && $_SESSION["status"] != 'Article successfully created' && $_SESSION["status"] != '') {
                                            echo '<div class="alert alert-danger">'.$_SESSION["status"].'</div>';
                                            $_SESSION["status"] = '';
                                        } else if(isset($_SESSION["status"]) && $_SESSION["status"] == 'Article successfully created'){
                                            echo '<div class="alert alert-success">'.$_SESSION["status"].'</div>';
                                            $_SESSION["status"] = '';
                                        }
                                    ?>
                                </div>
                                <div class="col-md-3">
                                    <label for="supermarket">Image</label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail" style="width: 175px; height: 125px;">
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                        </div>
                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                <input name="articleImage" type="file" class="form-control" />
                                            </span>
                                            <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i>Remove</a>
                                        </div>
                                    </div>
                                </div> 
                            </form>
                        </div>
                    </div>
                </section>
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

        <script src="./js/addArticle.js"></script>
        <!-- Bootstrap -->
        <script src="./bs/js/bootstrap.min.js"></script> 
        <script src="js/alertify.js"></script>
        <!--Fileupload-->
        <script type="text/javascript" src="js/bootstrap-fileupload/bootstrap-fileupload.js"></script>
    </body>
</html>
