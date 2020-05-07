<?php
  session_start();
  $servername = "localhost";
  $username = "root";
  $password = "";
  $db = "ecommerece";

  // Create connection
  $con = mysqli_connect($servername, $username, $password,$db);

  if(isset($_POST["add"])){
    if(isset($_SESSION["cart"])){
      $item_array_id = array_column($_SESSION["cart"],"product_id");
      if(!in_array($_GET["id"], $item_array_id)){
        $count = count($_SESSION["cart"]);
        $item_array = array(
          'product_id' => $_GET["product_id"],
          'item_name' =>$_POST["hidden_name"],
          'item_weight' =>$_POST["hidden_weight"],
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
        'item_weight' =>$_POST["hidden_weight"],
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


<!DOCTYPE html>
<html>
<head>
  <title>Online Food Store</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="cart.css">
<head>
<body>
  <div class="header";>
    <div class="inner_header";>
       <div class="hamburger_button">
         <img src="../img/menu-white.svg">
        </div>

       <div class="logo_container">
         <a href="index.php"><span>FOOD</span>MART</a>
        </div>

       <div class="search_bar">
         <input type="text" placeholder="Search..">
        </div>

       <ul class="navigation">
        <a href="login.php"><li>LOGIN/REGISTER</li></a>
          <a href="cart.php"><li>CART</li></a>
        </ul>
    </div>
  </div>
<div class="cart_content">
    <div class="inner_cart_content">
        <div class="cart_tile">
            <div class="cart_title">
            <a>Cart</a>

</div>
       <div style="clear:both"> </div>
       <div class="table-reponsive">
         <table class="table table-bordered">

         <?php
            if(!empty($_SESSION["cart"])) {
              $final_total = 0;
              $total = 0;
              $taxes = 0;
              $total_weight = 0;
              $shipping = 0;
              foreach($_SESSION["cart"] as $key => $value) {
                ?>

                <?php
                $total = $total + ($value["item_quantity"] * $value["product_price"]);
                $taxes = ($total * 0.0725);
                $total_weight = ($value["item_quantity"] * $value["item_weight"]);

                if($total_weight > 20) {
                  $shipping = 5;
                }
                $final_total = $final_total + $taxes + $shipping + ($value["item_quantity"] * $value["product_price"]);

              }
                 ?>
                 <div style="text-align:center">
                   <textarea name="add" placeholder="Enter Address" required="required"></textarea>
                   <br><br>
                   <input type="number" name="card" placeholder="Card Number" required>
                   <br> <br>

                 <table style="width:65%">
                 <tr>
                   <td colspan="4" align="right">Total Weight</td>
                   <th alight="right"> <?php echo $total_weight; ?> pounds</th>
                   <td ></td>
                 </tr>
                 <tr>
                   <td colspan="4" align="right">Total</td>
                   <th alight="right">$ <?php echo number_format($total, 2); ?></th>
                 </tr>
                 <tr>
                   <td colspan="4" align="right">Shipping</td>
                   <th alight="right"> <?php if($total_weight >= 20) {
                     echo "FREE";
                   } else {
                      echo "$5";
                   } ?></th>
                 </tr>
                 <tr>
                   <td colspan="4" align="right">Taxes</td>
                   <th alight="right">$ <?php echo number_format($taxes, 2); ?></th>
                 </tr>
                 <tr>
                   <td colspan="4" align="right">Final Total</td>
                   <th alight="right">$ <?php echo number_format($final_total, 2); ?></th>
                 </tr>
               </table>
               </div>



                 <?php

            }
          ?>
        </table>
        <?php
        $query = "SELECT * FROM products ORDER BY product_id ASC";
        $result = mysqli_query($con, $query)or die("Error: ". mysql_error(). " with query ");
         ?>

        <?php
        if(mysqli_num_rows($result) > 0) {
         ?>

        <div>
          <a href="thankyou.php"><center><button>Finish Order</button></center></a>
        </div>
      <?php } else {
        ?>
        <div style="tex-align:center">
          <p> <center>No Products Added In Cart </p>
          <a href="index.php"><button>Buy Items</button></center></a>
        </div>
        <?php } ?>




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
