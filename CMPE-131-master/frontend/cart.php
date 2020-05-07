<?php
  include("header.php");
  include("db.php");
  
  if(isset($_POST["add"])){
    if(isset($_SESSION["cart"])){
      $item_array_id = array_column($_SESSION["cart"],"product_id");
      if(!in_array($_GET["id"], $item_array_id)){
        $count = count($_SESSION["cart"]);
        $item_array = array(
          'product_id' => $_GET["id"],
          'item_name' =>$_POST["hidden_name"],
          'product_price' => $_POST["hidden_price"],
          'item_quantity' => $_POST["quantity"],
        );
        $_SESSION["cart"][$count] = $item_array;
        echo '<script>window.location="cart.php"</script>';
      } else {
        echo '<script>alert("Product is already Added to Cart")</script>';
        echo '<script>window.location="cart.php"</script>';
      }
    } else {
      $item_array = array(
        'product_id' => $_GET["id"],
        'item_name' =>$_POST["hidden_name"],
        'product_price' => $_POST["hidden_price"],
        'item_quantity' => $_POST["quantity"],
      );
      $_SESSION["cart"][0] = $item_array;
    }
  }
  if(isset($_GET["action"])){
    if ($_GET['action']== "delete") {
      foreach($_SESSION["cart"] as $keys => $value) {
        if($value ["product_id"] == $_GET["id"]) {
          unset($_SESSION["cart"][$keys]);
          echo '<script>alert("Product has been removed...")</script>';
          echo '<script>window.location="cart.php"</script>';
        }
      }
    }
  }
?>

<div class="cart_content">
    <div class="inner_cart_content">
        <div class="cart_tile">
            <div class="cart_title">
            <a>Cart</a>

</div>
       <div style="clear:both"> </div>
       <h3 class="title2"> Shopping Cart Details</h3>
       <div class="table-reponsive">
         <table class="table table-bordered">
         <tr>
           <th width="30%">Product Name</th>
           <th width="10%">Quantity</th>
           <th width="13%">Price Details</th>
           <th width="10%">Total Price</th>
           <th widht="17%">Remove Item</th>

         </tr>

         <?php
            if(!empty($_SESSION["cart"])) {
              $total = 0;
              foreach($_SESSION["cart"] as $key => $value) {
                ?>
                <tr>
                  <td><?php echo $value["item_name"];?></td>
                  <td><?php echo $value["item_quantity"];?></td>
                  <td>$<?php echo $value["product_price"];?></td>
                  <td>$<?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?></td>
                  <td><a href="cart.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span class="text-danger">Remove Item</span></a></td>
                </tr>
                <?php
                $total = $total + ($value["item_quantity"] * $value["product_price"]);
              }
                 ?>

                 <tr>
                   <td colspan="3" align="right">Total</td>
                   <th alight="right">$ <?php echo number_format($total, 2); ?></th>
                   <td ></td>
                 </tr>
                 <?php

            }
          ?>
        </table>

       </div>
     </div>

</div>
</div>
</div>

  <div class="footer";>
    <div class="inner_footer";>
      <a>123 Main Street San Jose, CA • 408-111-2345 • OnlineFoodStore@me.com</a>
    </div>
</div>
</body>

</html>
