<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
if($_SESSION['role']!="user"){
        header("Location:login.php");
    } 
include 'core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
include 'includes/leftBar.php';
    
    
    $sql="SELECT * FROM users WHERE id='".$_SESSION["id"]."'";
    
    $result=mysql_query($sql) or die(mysql_error());
    $row=mysql_fetch_array($result);

?>
		
		
		
	   
	    
	    <!--Main Content-->
	    <div class="col-md-8">
	        <div class="row">
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
                              <tr>
                              <td><b>Semester</b></td>
                              <td><input type="text" name="Semester" value="<?=$row['Semester']?>" maxlength="30" required=""></td>
                            </tr>
                            
                             <tr>
                              <td><b>Course</b></td>
                              <td><input type="text" name="Subject" value="<?=$row['Subject']?>" maxlength="30" required=""></td>
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
                    <tr>
                      <td><b>Semester</b></td>
                      <td><?=$row['Semester']?></td>
                    </tr>
                    <tr>
                      <td><b>Course</b></td>
                      <td><?=$row['Subject']?></td>
                    </tr>
                    
                    
                  </tbody>
                </table>
                <a href="index.php?edit=true" class="btn btn-primary btn-md">Edit Info</a>
	            <?php endif ?>
	            
	        </div>
	        
<?php
    if(isset($_POST['submit'])){
        $sql="UPDATE users
SET  name='".$_POST['name']."',email='".$_POST['email']."',password='".$_POST['password']."', Semester='".$_POST['Semester']."',Subject='".$_POST['Subject']."'
WHERE id='".$row['id']."'";
$result=mysql_query($sql)or die(mysql_error());
header("Location: index.php");
        
    }
        
?>
	    </div>

	    

    <?php 
    
    include 'includes/rightSideBar.php';
    include 'includes/footer.php';
?>