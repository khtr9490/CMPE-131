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



       </div>
       <h2>Thank you for shopping with us</h2>
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
