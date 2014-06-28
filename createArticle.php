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
        <!-- Google web fonts -->
        <link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
        <!-- The main CSS file -->
        <link href="dropzone/assets/css/style.css" rel="stylesheet" />

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
                    <a class="navbar-brand" href="#">Cool Logo Here</a>
                  </div>
                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">  
                    <div class="nav navbar-nav navbar-right">
                        <ul class="nav navbar-nav">
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo "".$_SESSION["username"]."" ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="./home.html">Home</a></li>
                          <li><a href="./userLists.php">My Lists</a></li>
                          <li class="active"><a href="./createArticle.php">Create Article</a></li>
                          <li><a href="./createSupermarket.php">Create Supermarket</a></li>
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

                        
                      <div class="col-md-9">
                            <form class="form-reg" action="./addArticle.php" method="post">
                              <div class="form-group">
                                <!-- Article Name -->
                                <label>Name</label>
                                <input type="text" class="form-control" name="articleName" placeholder="Enter Article Name">  
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
                              <input type="text" name="articleAmount" class="form-control">
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
                                
                                <select class="form-control optionMenu" name="articleSupermarket">
                                    <option value="default">--Enter Supermarket--</option>
                                    <option value="1">Rewe - Neustadt</option>
                                    <option value="2">Aldi - Neustadt</option>
                                    <option value="3">Penny - Neustadt</option>
                                </select>
                                
                              </div>                                 
                              <div class="form-group addButton"> 
                                <button type="submit" class="btn btn-default">Add Article</button>
                              </div>
                            </form>
                      </div>
                      <div class="col-md-3 dropArea">
                        <form id="upload" method="post" action="./dropzone/upload.php" enctype="multipart/form-data">
                            <div id="drop">
                                Drop your Photo here
                                <br>
                                <a>Or Browse</a>
                                <input type="file" name="upl" multiple />
                            </div>
                            <ul>
                                <!-- The file uploads will be shown here -->
                            </ul>
                        </form>
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
        
        <!-- JavaScript Includes -->

        <script src="dropzone/assets/js/jquery.knob.js"></script>

        <!-- jQuery File Upload Dependencies -->
        <script src="dropzone/assets/js/jquery.ui.widget.js"></script>
        <script src="dropzone/assets/js/jquery.iframe-transport.js"></script>
        <script src="dropzone/assets/js/jquery.fileupload.js"></script>

        <!-- Our main JS file -->
        <script src="dropzone/assets/js/script.js"></script>
        
        <!-- login -->
        <script src="./js/login.js"></script>
    </body>
</html>
