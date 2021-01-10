<?php
//includes file with db connection
    require_once '../../db_connect.php';
    
    //gets session info
    session_start();
    
    //takes input passed from form and assigns to variables
    $prodid = trim($_POST['prodid']);
    $name = trim($_POST['name']);
	$desc = trim($_POST['desc']);
	$image = trim($_POST['image']);
	$type = trim($_POST['type']);
	$stock = intval(trim($_POST['stock']));
	$price = floatval(trim($_POST['price']));
	
	//checks if all inputs have been passed
	if (!$prodid || !$name || !$desc || !$image || !$type || !$stock || !$price) {
	    $_SESSION['addfail'] = 'badinp';
	    header('Location: ../add_product.php');
	    
	    //closes db conection
	    $db->close();
	    exit();
	}
	
	//gets all product ids from db
	$query = "SELECT * FROM PRODUCTS WHERE productid ='".$prodid."'";
	$results = $db->query($query);
	$num_results = $results->num_rows;
	
	//checks if product id already exists. redirects to add products page if so
	if ($num_results > 0) {
	    $_SESSION['prodidtaken'] = true;
	    header('Location: ../add_product.php');
	    
	    //closes db connection
	    $results->free();
	    $db->close();
	    exit();
	}
	
	//inserts new product into db
	$query = "INSERT INTO PRODUCTS VALUES (
	    '".$prodid."',
	    '".$name."',
	    '".$desc."',
	    '".$image."',
	    '".$type."',
	    ".$stock.",
	    ".$price.")";
	$results = $db->query($query);
	
	//checks if insertion was successful
	if ($results) {
	    $_SESSION['prodadd'] = true;
	
	    //redirects to product info page
	    header('Location: ../product_info.php');    
	}
	else {
	    $_SESSION['addfail'] = 'randerr';
	    
	    //redirections to add product page
	    header('Location: ../add_product.php');
	}
	
	//closes db connection
	$db->close();
	exit();