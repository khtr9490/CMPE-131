 <?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../emp-login.php');
	exit;
}
include("../db.php");

include "sidenav.php";
include "topheader.php";
?>
      <!-- End Navbar -->
	  <div class="content">
        <div class="container-fluid">
			<div class="col-md-14">
				<div class="card ">
				  <div class="card-header card-header-primary">
					<h4 class="card-title"> Products List</h4>
					  </div>
					  <div class="card-body">
						<div class="table-responsive ps">
						<table class="table tablesorter " id="page1">
							<div class="row">		
								<div class="form-group col-md-3">
									<input type="text" class="search form-control" id="keywords" name="keywords" placeholder="By name or catagory">			
								</div>
								<div class="form-group col-md-2">
									<input type="button" class="btn btn-primary" value="Search" id="search" name="search" />
								</div>
								<div class="form-group col-md-4">
									<select class="form-control" id="sortSearch" >
									  <option value="" disable selected hidden>Sort by</option>
									  <option value="new">Sort by Product Category</option>
									  <option value="asc">Sort by Price: Low to Hight</option>
									  <option value="desc">Sort by Price: Hight to Low</option>
									</select>
								</div>
							</div>
							<table class="table">
								<thead>
									<tr>
										<th>Product Image</th>
										<th>Product Name</th>
										<th>Product Category</th>
										<th>Value</th>
									</tr>
								</thead>
								<tbody id="userData">		
									<?php			
									include 'Search.php';
									$search = new Search();
									$allOrders = $search->searchResult(array('order_by'=>'product_id DESC'));      
									if(!empty($allOrders)) {
										foreach($allOrders as $order) {
											echo '
											<tr>
											<td><img src="../product_images/'.$order["product_image"].'" style="width:50px; height:50px; border:groove #000"></td>
											<td>'.$order["product_title"].'</td>
											<td>'.$order["product_cat"].'</td>
											<td>$'.$order["product_price"].'</td>
											</tr>';
										}
									} else {
									?>            
										<tr><td colspan="5">No result found...</td></tr>
									<?php } ?>
								</tbody>
							</table>	
						</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

      <?php
include "footer.php";
?>