<?php
include 'Search.php';
$search = new Search();
$sqlConditions = array();
if(!empty($_POST['type']) && (!empty($_POST['keywords']) || !empty($_POST['sortValue']))){
    if($_POST['type'] == 'search'){
        $sqlConditions['search'] = array('product_title'=>$_POST['keywords'],'product_cat'=>$_POST['keywords'], 'product_price'=>$_POST['keywords']);
        $sqlConditions['order_by'] = 'product_title DESC';
    }elseif($_POST['type'] == 'sort'){
		if($_POST['keywords']) {
			$sqlConditions['search'] = array('product_title'=>$_POST['keywords'],'product_cat'=>$_POST['keywords'],'product_price'=>$_POST['keywords']);
		}
        $sortValue = $_POST['sortValue'];
        $sortArribute = array(
            'new' => array(
                'order_by' => 'product_cat DESC'
            ),
            'asc'=>array(
                'order_by'=>'product_price ASC'
            ),
            'desc'=>array(
                'order_by'=>'product_price DESC'
            )
        );
        $sortKey = key($sortArribute[$sortValue]);
        $sqlConditions[$sortKey] = $sortArribute[$sortValue][$sortKey];
    }
}else{
    $sqlConditions['order_by'] = 'product_cat DESC';
}
$orders = $search->searchResult($sqlConditions);
if(!empty($orders)){    
	foreach($orders as $order){
		echo '
		<tr>
		<td><img src="../product_images/'.$order["product_image"].'" style="width:50px; height:50px; border:groove #000"></td>
		<td>'.$order["product_title"].'</td>
		<td>'.$order["product_cat"].'</td>
		<td>$'.$order["product_price"].'</td>
		</tr>';
	}
}else{
    echo '<tr><td colspan="5">No user(s) found...</td></tr>';
}
exit;