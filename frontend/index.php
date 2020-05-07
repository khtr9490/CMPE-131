<?php
  session_start();
  include("db.php");

  if(isset($_POST["add"])){
    if(isset($_SESSION["cart"])){
      $item_array_id = array_column($_SESSION["cart"],"product_id");
      if(!in_array($_GET["id"], $item_array_id)){
        $count = count($_SESSION["cart"]);
        $item_array = array(
          'product_id' => $_GET["id"],
          'item_name' =>$_POST["hidden_name"],
          'item_weight' =>$_POST["hidden_weight"],
          'product_price' => $_POST["hidden_price"],
          'item_quantity' => $_POST["quantity"],
        );
        $_SESSION["cart"][$count] = $item_array;
        echo '<script>window.location="index.php"</script>';
      } else {
        echo '<script>alert("Product is already Added to Cart")</script>';
        echo '<script>window.location="index.php"</script>';
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
          echo '<script>window.location="index.php"</script>';
        }
      }
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Food Mart</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
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
  <div class="dropdown">
  <button class="dropbtn">Dropdown</button>
  <div class="dropdown-content">
    <a href="#">Link 1</a>
    <a href="#">Link 2</a>
    <a href="#">Link 3</a>
  </div>
</div>
<!--<header>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="catalog.html">Catalog</a></li>
        <li class="logo"><a href="index.php">Online Food Store Logo</a></li>
        <li><a href="login.html">Login/Register</a></li>
        <li><a href="cart.html">Cart</a></li>
      </ul>
    </nav>
  </header>-->


  <div class="home_content" style="text-align: center";>
        <div class="inner_home_content";>
        <img class='large_image' src="../img/cropfield.jpg">

        <div class="home_popular_items";>
            <div class="home_popular_items_title";>
                <a>Popular Items</a>
<!---PHP code for the items display--------->

                <div class="container">
                <?php
                  $query = "SELECT * FROM products ORDER BY product_id ASC";
                  $result = mysqli_query($con, $query)or die("Error: ". mysql_error(). " with query ");
                  if(mysqli_num_rows($result) > 0) {

                    while($row = mysqli_fetch_array($result)) {
                       ?>
                       <div class = "col-md-3">
                         <form method="post" action="index.php?action=add&id=<?php echo $row["product_id"]; ?>">
                           <div class = "product">
                             <img src="<?php echo $row["product_image"]; ?>" width="50" height="40" class="img-responsive">
                             <h5 class="text-info"> <?php echo $row["product_title"]; ?></h5>
                             <h5 class="text-danger"> <?php echo $row["product_price"]; ?> </h5>
                             <input type="text" name="quantity" class="form-control" value="1" >
                             <input type="hidden" name="hidden_name" value="<?php echo $row["product_title"]; ?>">
                             <input type="hidden" name="hidden_weight" value="<?php echo $row["weight"]; ?>">
                             <input type="hidden" name="hidden_price" value="<?php echo $row["product_price"]; ?>">
                             <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success" value="Add to Cart">


                           </div>

                         </form>
                       </div>
                       <?php
                     }
                   }
                       ?>
                 </div>
            </div>

        </div>
<!---Shopping Cart display-------->
        <div class="home_cart" style="text-align: center";>
            <div class="home_cart_title";>
                <a>Your Cart</a>
            </div>
            <div style="clear:both"> </div>
            <h3 class="title2"> Shopping Cart Details</h3>
            <div class="table-reponsive">
              <table class="table table-bordered">
              <tr>
                <th width="30%">Product Name</th>
                <th width="10%">Quantity</th>
                <th width="15%">Weight</th>
                <th width="13%">Price Details</th>
                <th width="10%">Total Price</th>
                <th widht="17%">Remove Item</th>

              </tr>

              <?php
                 if(!empty($_SESSION["cart"])) {
                   $total = 0;
                   $total_weight = 0;
                   foreach($_SESSION["cart"] as $key => $value) {
                     ?>
                     <tr>
                       <td><?php echo $value["item_name"];?></td>
                       <td><?php echo $value["item_quantity"];?></td>
                       <td><?php echo $value["item_weight"];?> pounds</td>
                       <td>$<?php echo $value["product_price"];?></td>
                       <td>$<?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?></td>
                       <td><a href="cart.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span class="text-danger">Remove Item</span></a></td>
                     </tr>
                     <?php
                     $total = $total + ($value["item_quantity"] * $value["product_price"]);
                     $total_weight = $total_weight + ($value["item_quantity"] * $value["item_weight"]);
                   }
                      ?>

                      <tr>
                        <td colspan="2" align="right">Total</td>
                        <th alight="right"> <?php echo $total_weight; ?> pounds</th>
                        <td colspan="1" align="right">Total</td>
                        <th alight="right">$ <?php echo number_format($total, 2); ?></th>
                        <td ></td>
                      </tr>
                      <?php

                 }
               ?>
             </table>

            </div>
        </div>

        <div class="home_categories";>
            <div class="home_categories_title";>
                <a>Categories</a>
            </div>
        </div>
    </div>




  <div class="footer";>
    <div class="inner_footer";>
      <a>123 Main Street San Jose, CA • 408-111-2345 • OnlineFoodStore@me.com</a>
    </div>
</div>
</body>

</html>
