<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Projet Cherry</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
               
                if(!isset($_SESSION['email']))
                    echo '<li class="active"><a href="index.php">Log in <span class="glyphicon glyphicon-log-in"></span></a></li>';
                else
                    echo '<li class="active"><a href="logout.php">Log out <span class="glyphicon glyphicon-log-out"></span></a></li>';
                ?>
              
                <li ><a href="authentication.php">Sign up <span class="glyphicon glyphicon-user"></a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>
