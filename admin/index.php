<?php 
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
if($_SESSION['role']!="admin"){
        header("Location:../login.php");
    } 
require_once'../core/init.php';
include 'includes/header.php';
include 'includes/navigation.php';
//include 'config.php';


$sql="SELECT * FROM users WHERE id='".$_SESSION["id"]."'";
    
    $result=mysql_query($sql) or die(mysql_error());
    $row=mysql_fetch_array($result);

?>
<div class="col-md-2">
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
                 <li><a href="../login.php?logout=1">Logout</a></li>
                 
                </ul>
          </div>
</div>

    <div class="col-md-8">
        <?php if(isset($_GET['edit'])): ?>
                    <form method="post" action="" data-parsley-validate="">
                       <table class="table table-striped table-inverse">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Value</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><b>Id</b></td>
                              <td><?=$row['id']?></td>
                            </tr>
                            <tr>
                              <td><b>Name</b></td>
                              <td><input type="text" name="name" value="<?=$row['name']?>" required=""></td>
                            </tr>
                            <tr>
                              <td><b>Email</b></td>
                              <td><input type="text" name="email" value="<?=$row['email']?>" required=""  pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$"></td>
                            </tr>
                            <tr>
                              <td><b>Password</b></td>
                              <td><input type="password" name="password" value="<?=$row['password']?>" maxlength="30" required=""></td>
                            </tr>
                        </tbody>
                        </table>
                        <input type="submit" name="submit" class="btn btn-success"  value="submit"></td>
                </form>
                <?php else: ?>
                    <h1 style="color:green;">Welcome <?=$row['name']?></h1>
                <hr />
                <h3>Your details are below:</h3>
                <table class="table table-striped table-inverse">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Value</th>
                    </tr>
                  </thead>
                  <tbody>
                      
                    <tr>
                      <td><b>Id</b></td>
                      <td><?=$row['id']?></td>
                    </tr>
                    <tr>
                      <td><b>Name</b></td>
                      <td><?=$row['name']?></td>
                    </tr>
                    <tr>
                      <td><b>Email</b></td>
                      <td><?=$row['email']?></td>
                    </tr>
                    <tr>
                      <td><b>Password</b></td>
                      <td><?=$row['password']?></td>
                    </tr>
                    
                    
                  </tbody>
                </table>
                <a href="index.php?edit=true" class="btn btn-primary btn-md">Edit Info</a>
                <?php endif ?>
                
            </div>
            
<?php
    if(isset($_POST['submit'])){
        $sql="UPDATE users
SET  name='".$_POST['name']."',email='".$_POST['email']."',password='".$_POST['password']."'
WHERE id='".$row['id']."'";
$result=mysql_query($sql)or die(mysql_error());
header("Location: index.php");
        
    }
        
?>
	

    </div>
</div>


<div class="col-md-2"></div>
 <?php 
 include 'includes/footer.php';
 ?>