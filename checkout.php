<?php

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../user_login.php');
	exit;
}
include("../db.php");
include "sidenav.php";
include "topheader.php";

// set page title
$page_title="Checkout";

// include page header html
include 'tophead.php';

// $cart_count variable is initialized in navigation.php
if($cart_count>0){

    $cart_item->user_id="1";
    $stmt=$cart_item->read();

    $total=0;
    $item_count=0;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $sub_total=$price*$quantity;

            echo "<div class='cart-row'>";
                echo "<div class='col-md-8'>";

                    echo "<div class='product-name m-b-10px'><h4>{$name}</h4></div>";
                    echo $quantity>1 ? "<div>{$quantity} items</div>" : "<div>{$quantity} item</div>";

                echo "</div>";

                echo "<div class='col-md-4'>";
                    echo "<h4>&#36;" . number_format($price, 2, '.', ',') . "</h4>";
                echo "</div>";
            echo "</div>";

            $item_count += $quantity;
            $total+=$sub_total;
        }

        echo "<div class='col-md-12 text-align-center'>";
            echo "<div class='cart-row'>";
                if($item_count>1){
                    echo "<h4 class='m-b-10px'>Total ({$item_count} items)</h4>";
                }else{
                    echo "<h4 class='m-b-10px'>Total ({$item_count} item)</h4>";
                }
                echo "<h4>&#36;" . number_format($total, 2, '.', ',') . "</h4>";

                echo "<a href='place_order.php' class='btn btn-lg btn-success m-b-10px'>";
                    echo "<span class='glyphicon glyphicon-shopping-cart'></span> Place Order";
                echo "</a>";
            echo "</div>";
        echo "</div>";

    }
    else{
    echo "<div class='col-md-12'>";
        echo "<div class='alert alert-danger'>";
            echo "No products found in your cart!";
        echo "</div>";
    echo "</div>";
}

include 'footer.php';
?>
