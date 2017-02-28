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
        <?php 
            if(isset($_GET['edit'])):?>
            <?php 
                $query="Select * from courses where courseid='".$_GET['edit']."'";
                $result=mysql_query($query)or die(mysql_error());
                $row=mysql_fetch_array($result);
            ?>
            <form method="post" action="">
                <table class="table">
                    <tr>
                        <td>id:</td>
                        <td><?=$row['courseid']?></td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td><input type="text" name="name" value="<?=$row['coursename']?>" /></td>
                    </tr>
                </table>
                <input type="submit" name="update" value="Update" class="btn btn-primary" />
            </form>
            <?php 
                if(isset($_POST['update'])){
                    $query="update courses set coursename='".$_POST['name']."' where courseid='".$row['courseid']."'";
                    $result=mysql_query($query)or die(mysql_error());
                    if($result>0){
                        echo "Updated";
                    }
                    else{
                        echo"failed!";
                    }
                }
            ?>
        <?php else:?>
        <form method="post" action="">
            <table class="table">
                <tr>
                    <td>Courseid:</td>
                    <td><input type="text" class="form-control" name="id"/></td>
                </tr>
                <tr>
                    <td>Course:</td>
                    <td><input type="text" class="form-control" name="course" /></td>
                </tr>
                
                
            </table>
            <input type="submit" class="btn btn-success" name="addcourse" value="Add course" />
            
        </form>
        
        <?php 
            if(isset($_POST['addcourse'])){
                $query="Insert into courses Values('".$_POST['id']."','".$_POST['course']."')";
                $result=mysql_query($query)or die(mysql_error());
                if($result>0){
                    echo "**Added**";
                }
            }
            
        ?> <!--End of Add-->
        <hr />
        <a href="courses.php?show=1" class="btn btn-primary">Show courses</a>
        <?php 
            if(isset($_GET['show'])){
            $query="Select * from courses";
            $result=mysql_query($query);?>
            
            <table class="table">
                    <thead>
                        <th>id:</th>
                        <th>name:</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    
            
            <?php
            while($row=mysql_fetch_array($result)){?>
                
                    <tbody>
                        <tr>
                            <td><?=$row['courseid']?></td>
                            <td><?=$row['coursename']?></td>
                            <td><a class="btn-btn-primary" href="courses.php?edit=<?=$row['courseid']?>">Edit</a></td>
                            <td><a class="btn-btn-primary" href="courses.php?delete=<?=$row['courseid']?>">Delete</a></td>
                        </tr>
                    </tbody>
                
            <?php }?>
            </table>
            <?php
        }
        ?>
        
        <?php 
            if(isset($_GET['delete'])){
                $query="Delete from courses where courseid='".$_GET['delete']."'";
                $result=mysql_query($query)or die(mysql_error());
                if($result>0){
                    echo"Deleted";
                }else{
                    echo "Failed";
                }
            }
        ?>
               
    </div>
    

    </div>
</div>


<div class="col-md-2"></div>
 <?php 
 include 'includes/footer.php';
 ?>
 <?php endif;?>