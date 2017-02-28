 <!--Left Sidebar-->
        <div class="col-md-2"><div class="dropdown">
           
         <div class="container">
            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><?php
            if(isset($_SESSION["username"])){
                echo $_SESSION["username"];
            }else{
                echo "";
            }
            ?>
            <span class="caret"></span></button>
                <ul class="dropdown-menu">
                 <li><a href="login.php?logout=1">Logout</a></li>
                 
                </ul>
          </div>
      </div>
      
  </div>