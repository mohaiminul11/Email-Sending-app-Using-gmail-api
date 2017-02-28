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
                $query="Select * from Semester where id='".$_GET['edit']."'";
                $result=mysql_query($query)or die(mysql_error());
                $row=mysql_fetch_array($result);
            ?>
            <!--Update-->
            <form method="post" action="">
                <table class="table">
                    <tr>
                        <td>id:</td>
                        <td><?=$row['id']?></td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td><input type="text" name="name" value="<?=$row['Semester']?>" /></td>
                    </tr>
                </table>
                <input type="submit" name="update" value="Update" class="btn btn-primary" />
            </form>
            <?php 
                if(isset($_POST['update'])){
                    $query="update Semester set Semester='".$_POST['name']."' where id='".$row['id']."'";
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
        <!--Add Semester-->
        <form method="post" action="">
            <table class="table">
                <tr>
                    <td>Semester:</td>
                    <td><input type="text" class="form-control" name="Semester" /></td>
                </tr>
                
                
            </table>
            <input type="submit" class="btn btn-success" name="addSemester" value="Add Semester" />
            
        </form>
        
        <?php 
            if(isset($_POST['addSemester'])){
                $sql="Select * from Semester";
                $flag=0;
                $res1=mysql_query($sql)or die(mysql_error());
                while($row=mysql_fetch_array($res1)){
                    if($row['Semester']==$_POST['Semester']){
                        echo "Already Exist!";
                        $flag=1;
                    }
                }
                if($flag==0){
                    $query="Insert into Semester Values('','".$_POST['Semester']."')";
                    $result=mysql_query($query)or die(mysql_error());
                    if($result>0){
                    echo "**Added**";
                }
                }
                
                
                
            }
            
        ?> <!--End of Add-->
        <hr />
        <a href="Semester.php?show=1" class="btn btn-primary">Show Semester</a>
        <?php 
            if(isset($_GET['show'])){
            $query="Select * from Semester";
            $result=mysql_query($query);?>
            
            <table class="table">
                    <thead>
                        <th>id:</th>
                        <th>Semester:</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    
            
            <?php
            while($row=mysql_fetch_array($result)){?>
                
                    <tbody>
                        <tr>
                            <td><?=$row['id']?></td>
                            <td><?=$row['Semester']?></td>
                            <td><a class="btn-btn-primary" href="Semester.php?edit=<?=$row['id']?>">Edit</a></td>
                            <td><a class="btn-btn-primary" href="Semester.php?delete=<?=$row['id']?>">Delete</a></td>
                        </tr>
                    </tbody>
                
            <?php }?>
            </table>
            <?php
        }
        ?>
        
        <?php 
            if(isset($_GET['delete'])){
                $query="Delete from Semester where id='".$_GET['delete']."'";
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