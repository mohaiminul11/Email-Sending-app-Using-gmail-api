<?php
    include 'core/init.php'; 
    //$sql="SELECT * FROM categories WHERE parent=0";
    //$result=mysql_query($sql) or die(mysql_error());
?>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <a href="index.php" class="navbar-brand">Eshop</a>
                <ul class="nav navbar-nav">
                    <?php if(isset($_SESSION['role'])&&$_SESSION['role']=="user"): ?>
                                       
                    <?php else: ?>
                     <li><a href="#">About</a></li>   
                    <?php endif ?>
                </ul>               
            </div>          
        </nav>
        <div class="container-fluid">