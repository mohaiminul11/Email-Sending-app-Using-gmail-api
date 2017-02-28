<?php 
include 'includes/head.php';
include 'includes/navigation.php';
include 'includes/leftBar.php';
include 'core/init.php';
include 'config.php'
?>

<div class="col-md-8" >
	
	<script src="js/registrationvalid.js"></script>
	
  <h1>Registration Page</h1>
  <br />
  <br />
  
  <form action="" method="post" data-parsley-validate="" >
  	<table class="table">
  		<tr>	
  			<td><label>Id: </label></td>&nbsp;<td><input type="text" name="username" id="username" maxlength="12" required="" pattern="\d{2}-\d{5}-[1-3]"/></td>
  		</tr>
  		
  		<tr>	
  			<td><label>Name </label></td>&nbsp;<td><input type="text" name="name" id="name" maxlength="50" required=""/></td>
  		</tr>
  		<tr>	
  			<td><label >Password </label></td>&nbsp;<td><input type="password" name="password" id="password" maxlength="30" required="" /></td>
  		</tr>
  		
  		<tr>	
  			<td><label>Email </label></td>&nbsp;<td><input type="email" name="email" id="email" required=""  pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$"/></td>
  			
  		</tr>
  		
  		<tr>    
            <td><label>Semester </label></td>&nbsp;<td>
                <?php 
                    $sql="Select * From Semester";
                    $result=mysql_query($sql);
                ?>
                
                <select name="semester" class="form-control" required="">
                        <?php
                            while($row=mysql_fetch_array($result)):
                            ?>
                            <option value="<?=$row['Semester']?>"><?=$row['Semester']?></option>
                        <?php endwhile; ?>
    
                </select>
                </td>
            
        </tr>
        
        <tr>    
            <td><label>Course</label></td>&nbsp;<td>
                <?php 
                    $sql="Select * From courses";
                    $result=mysql_query($sql);
                ?>
                
                <select name="course" class="form-control" required="">
                        <?php
                            while($row=mysql_fetch_array($result)):
                            ?>
                            <option value="<?=$row['coursename']?>"><?=$row['coursename']?></option>
                        <?php endwhile; ?>
    
                </select>
                </td>
            
        </tr>
  		
  		<tr>
  			<!--<td><input type="reset" class="btn btn-danger" value="Reset"></td>-->
  			<td><input type="submit" name="submit" class="btn btn-success"  value="submit"></td>
  			
  		</tr>
  	</table>
  
  </form>
  <?php
  if(isset($_POST['submit'])){
      $sql="Select * From users where id='".$_POST['username']."'";
      $result=mysql_query($sql) or die(mysql_error());
      $row=mysql_fetch_array($result);
        if($row>0){
           echo "<b style=\"color:red\">User Exist!</b>"; 
        }
        else{
            $sql="INSERT INTO users VALUES('".$_REQUEST['username']."', '".$_REQUEST['name']."', 
               '".$_REQUEST['email']."', '".$_REQUEST['password']."','user','".$_REQUEST['semester']."','".$_REQUEST['course']."')";
                    
                    
                    $retval = mysql_query($sql)or die(mysql_error());
                if(!$retval){
                    
                    echo "<b style=\"color:red\">Data insertion Failed</b>";
                    }
                else {
                        echo "<b style=\"color:green\">Entered data successfully</b>";
                            
                    }
        }
  	
  
  }
  ?>
  
  
  
  
</div>

<?php 
    include 'includes/rightSideBar.php';
    include 'includes/footer.php';
?>