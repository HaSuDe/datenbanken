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
        <title>Create Supermarket</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./bs/css/bootstrap.min.css" rel="stylesheet">
        <link href="./css/editableTable.css" rel="stylesheet">
        <link href="./css/alertify.core.css" rel="stylesheet">
        <link href="./css/alertify.bootstrap.css" rel="stylesheet">
        <link href="./css/style.css" rel="stylesheet">
        <link href="./css/addSupermarket.css" rel="stylesheet">
        <!-- Google web fonts -->
        <link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
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
                    <a class="navbar-brand" href="#">Logo</a>
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
                          <li class="active"><a href="./createSupermarket.php">Create Supermarket</a></li>
                          <li><a href="./articleOverview.php">Article Overview</a></li>
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
                  <div class="panel panel-default createLable">
                      
                    <div class="row">
                    <div class="col-md-12">
                    <header class="panel-heading">
                        <b>Create a new Supermarket</b>
                    </header>
                    </div>
                    </div>
                      
                    <div class="panel-body shList">

                        
                      <div class="col-md-12">
                            <form class="form-reg"">
                              <div class="form-group">
                                <!-- Supermarket Name -->
                                <label>Name</label>
                                <input type="text" class="form-control" id="supermarketName" placeholder="Enter Market Name">  
                              </div>
                              <div class="form-group">
                                <!-- Supermarket Street -->
                                <label>Street</label>
                                <input type="text" class="form-control" id="supermarketStreet" placeholder="Enter Street of Supermarket">  
                              </div>
                              <div class="form-group">
                                <!-- Supermarket City -->
                                <label>City</label>
                                <input type="text" class="form-control" id="supermarketCity" placeholder="Enter City of Supermarket">  
                              </div>
                              <div class="form-group">
                                <!-- Supermarket ZipCode -->
                                <label>Zip Code</label>
                                <input type="text" class="form-control" id="supermarketZipCode" placeholder="Enter Zip Code of Supermarket">  
                              </div>
                              <div class="form-group">
                                <!-- Supermarket ZipCode -->
                                <label>Country</label>
                                <input type="text" class="form-control" id="supermarketCountry" placeholder="Enter Country of Supermarket">  
                              </div>
                              <div class="form-group">
                                <!-- Supermarket ZipCode -->
                                <label>Position</label>
                                <input type="text" class="form-control" id="supermarketLatitude" placeholder="Enter Latitude of Supermarket">  
                                <input type="text" class="form-control" id="supermarketLongitude" placeholder="Enter Longitude of Supermarket">  
                              </div>
                              <div class="form-group addButton">
                                <button id="createSupermarket" type="button" class="btn btn-default">Create Supermarket</button>
                              </div>
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
        <!-- Alertify -->
        <script src="js/alertify.js"></script>
        <!-- Bootstrap -->
        <script src="./bs/js/bootstrap.min.js"></script> 
        <script src="./js/addSupermarket.js"></script> 
    </body>
</html>