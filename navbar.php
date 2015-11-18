<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">OpenIdeas</a>
            <a class="navbar-brand" rel="home" href="#">
                <img style="width:18px;" src="images/logo.png"/>
            </a>
    
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">                
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="linkedData.php">Linked-data</a>
                </li>
                <?php
                    session_start();
                    if (isset($_SESSION['email'])){
                        ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo $_SESSION['picture'];?>" style="width: 18px; height: 18px;" class="profile-image img-circle"> Username <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="userPage.php">Profilo</a></li>
                                <li class="divider"></li>
                                <li><a href="logOut.php">Log-out</a></li>
                            </ul>
                        </li> 
                        <?php
                    }
                    else{?>
                         <li id="login">
                            <a href="login.php">
                              Login
                            </a>
                        </li> <?php
                    }
                ?>           
                
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
