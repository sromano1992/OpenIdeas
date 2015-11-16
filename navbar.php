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
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Contatti</a>
                </li>
                <?php
                    session_start();
                    if (isset($_SESSION['email'])){
                        ?>
                         <li>
                            <a href="logout.php">
                              Logout
                            </a>
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
                <li>
                    <a style="visibility: hidden" href="#" onclick="logOut();" id="logout">Logout</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
