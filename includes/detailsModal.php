<?php 
require_once'/../core/init.php';
$id=$_POST['id'];
$sql="SELECT * FROM products WHERE id='$id'";
$result=mysql_query($sql) or die(mysql_error());
$product=mysql_fetch_array($result);
$brand_id=$product['brand'];
$sql2="SELECT brand from brand WHERE id='$brand_id'";
$brand=mysql_query($sql2);
$brandName=mysql_fetch_array($brand);


?>
<?php ob_start(); ?>

<div class="modal fade" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel"><?=$product['title'];?></h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <div class="center-block">
                        <img src="<?=$product['image'];?>" alt="<?=$product['title'];?>" class="img-thumb img-responsive" />
                    </div>
                </div>
                <div class="col-sm-6">
                    <h4>Details</h4>
                    <p><?=$product['description'];?></p>
                    <hr>
                    <p>Price: $<?=$product['price'];?></p>
                    <p>Brand:<?=$brandName['brand']?></p>
                    
                    
                    <!--Submit Form Validation-->
                    
                    <script>
                        function validate(){
                            if(document.getElementById("quantity").value==""){
                                document.getElementById("errorMessage").innerHTML="Quantity field is empty!";
                                
                                return false;
                            }
                            else if(document.getElementById("quantity").value<=0){
                                document.getElementById("errorMessage").innerHTML="Quantity Must be >0";
                                errorMessage
                                return false;
                            }
                            
                            else if(document.getElementById("quantity").value > <?=$product['quantity']?>){
                                document.getElementById("errorMessage").innerHTML="Sorry not enough Product available!";
                                return false;
                            }
                            return true;
                        }
                    </script>
                    
                    <!--Submit Form-->
                    
                    <form onsubmit="return validate();" action="index.php?pid=<?=$id?>" method="post">
                        <div class="form-group">
                            
                                <label for="quality">Quantity:</label>
                                <input type="text" class="form-control" id="quantity" name="quantity" />
                                <label style="color:red;" id="errorMessage"></label>
                            
                        
                        
                                <p style="color:green;">Available <?=$product['quantity']?></p>
                            
                        
                                <button type="submit" name="AddToCart" class="btn btn-warning"><span class="glyphicon glyphicon-shopping-cart"></span>Add To Cart</button>
                            
                        
                    </form>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div> 

<?php echo ob_get_clean(); ?>