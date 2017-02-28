<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
if($_SESSION['role']!="admin"){
        header("Location:../login.php");
    }
require_once'../core/init.php';
include 'Qassim_HTTP.php';
include 'config.php';
include 'includes/header.php';
include 'includes/navigation.php';
/* By Qassim Hassan, http://wp-time.com/send-email-via-gmail-api-using-php/ */
?>
<div class="col-md-2"></div>
<div class="col-md-8">
    <?php if( isset($_SESSION['access_token']) ) : // if user is logged in ?>


    <h1>Hello <?php echo $_SESSION["emailAddress"]; ?></h1>

    <?php
    if( isset($_SESSION['sent']) ){ // if message has been sent
        echo '<h3 style="color:red;">'.$_SESSION['sent'].'</h3>';
        unset($_SESSION['sent']);
    }
    ?>

    <form method="POST" action="send.php">
        <table class="table">
            <tr>
                <td>Subject:</td>
                <td><input name="subject" type="text" value="" placeholder="Enter subject"></td>
            </tr>
            <tr>
                <td>To:</td>
                <td><input name="to" type="text" value="<?php if(isset($_SESSION['receivers'])){
                    
                    foreach ($_SESSION['receivers'] as $key => $value) {
                        $query="Select * from users where id='".$value."'";
                        $result=mysql_query($query)or die(mysql_error());
                        $row=mysql_fetch_array($result);
                        echo $row['email'].",";
                    }
                } ?>" placeholder="Enter email"></td>
            </tr>
            <tr>
                <td>Message:</td>
                <td><textarea name="message" placeholder="Enter message"></textarea></td>
            </tr>
        </table>
        <p><input type="submit" name="submit" value="Send!" class="btn btn-success"></p>
    </form>

    <p><a href="logout.php">Logout?</a></p>


<?php else : // if user is not logged in, show sign in link ?>


    <a href="<?php echo $login_url; ?>">Sign in with Gmail</a>


<?php endif; ?>
</div>
<div class="col-md-2"></div>

<?php 
 include 'includes/footer.php';
 ?>