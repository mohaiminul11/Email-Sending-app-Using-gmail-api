<?php 
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
if($_SESSION['role']!="admin"){
        header("Location:../login.php");
    }
$receivers=array(); 
require_once'../core/init.php';
include 'includes/header.php';
include 'includes/navigation.php';
include'config.php';


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
        <!--First Form-->
        <?php
            $query="Select * from Semester";
            $result=mysql_query($query)or die(mysql_error());
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label>Semester:</label>
                <select name="Semester" class="form-control">
                        <?php
                            while($row=mysql_fetch_array($result)):
                            ?>
                            <option value="<?=$row['Semester']?>"><?=$row['Semester']?></option>
                        <?php endwhile; ?>
    
                </select>
            </div>
            
            <div class="form-group">
                <label>Course:</label>
                <?php 
                    $query="Select * from Courses";
                    $result=mysql_query($query)or die(mysql_error());
                ?>
                <select name="Course" class="form-control">
                        <?php
                            while($row=mysql_fetch_array($result)):
                            ?>
                            <option value="<?=$row['coursename']?>"><?=$row['coursename']?></option>
                        <?php endwhile; ?>
                  
                </select>
            </div>
            <input type="submit" name="findStudent"  value="Find" class="btn btn-success form-control" />
    </form><!--End of First Form-->
    
    <!--2nd Form-->
        <?php 
        if(isset($_POST['findStudent'])): ?>
            <?php
            $query="Select * from users where Semester='".$_POST['Semester']."' AND Subject='".$_POST['Course']."'";
            $result2=mysql_query($query)or die(mysql_error());
            $_SESSION['Semester']=$_POST['Semester'];
            $_SESSION['Course']=$_POST['Course'];
            ?>
            <form action="" method="post" role="form">
            <table class="table table-striped table-bordered">
                <thead>
                    <th>Id</th>
                    <th>name</th>
                    <th>mark</th>
                </thead>
            
            <?php while($row=mysql_fetch_array($result2)): ?>
                <tr>
                 <td><?=$row['id']?><br /></td>
                 <td><?=$row['name']?></td>
                 <td><input type="checkbox" name="<?=$row['id']?>" class="form-control" value="<?=$row['id']?>" checked></td> 
                </tr>
      
            
            <?php endwhile; ?>
            </table>
            <input type="submit" name="Add" class="btn btn-success form-control" value="Add">
            </form>
            <?php endif; ?>
            <!--End of 2nd Form-->
            
            <?php 
            
            ?>
            <?php
            if(isset($_POST['Add'])){
                $query="Select * from users where Semester='".$_SESSION['Semester']."' AND Subject='".$_SESSION['Course']."'";
                $result=mysql_query($query)or die(mysql_error());
                
                while($row=mysql_fetch_array($result)){
                    //echo $row['id'];
                    if(isset($_POST[$row['id']])){
                        
                        //echo $row['id'];
                        $receivers[$row['id']]=$row['id'];
                    }
                }
                //echo "finished!";
                
                $_SESSION['receivers']=$receivers;
                //var_dump($_SESSION['receivers']);
            }
            ?>
       
    

    </div>
    



<div class="col-md-2" style="border-left: 1px solid #E0E0E0;">
    <?php
    if(isset($_SESSION['receivers'])):?>
        <h1 style="color:green;"><?=count($_SESSION['receivers'])?> Elements in the list.</h1>
        <a href="<?php echo $login_url; ?>" class="btn btn-success">Send mail</a>
        <a href="Sendmail.php?delete=1" class="btn btn-danger">Clear list</a>
    <?php endif; ?>
    
    <?php 
        if(isset($_GET['delete'])){
            unset($_SESSION['receivers']);
            header("Location: Sendmail.php");
        }
    ?>
</div>
</div>
 <?php 
 include 'includes/footer.php';
 ?>