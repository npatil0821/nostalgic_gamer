<?php
    //include db connection
    require_once '../../db_connect.php';
    
    //includes session info
    session_start();
    
    //checks if user is logged in
    if ((isset($_SESSION['emp_login']) && $_SESSION['emp_login']) === false) {
        $_SESSION['emp_nli'] = true;
        header('Location: emp_login.php');
        exit();
    }
    
    //assigns passed values to variables
    $prodid = $_POST['prodid'];
    $addstock = $_POST['addstock'];
    
    //gets current stock of selected product
    $query = "SELECT stock FROM PRODUCTS WHERE productid ='".$prodid."'";
    $results = $db->query($query);
    
    //assigns curent stock of product to variable
    $row = $results->fetch_assoc();
    $currstock = $row['stock'];
    
    //gets new stock value
    $newstock = $addstock + $currstock;
    
    //adds stock to selected product
    $query = "UPDATE PRODUCTS SET stock = ".$newstock." WHERE productid ='".$prodid."'";
    $results = $db->query($query);
    
    //checks if stock update was successful
    if ($results)
        $_SESSION['prod_update'] = 'success';
    
    else 
        $_SESSION['prod_update'] = 'failed';
        
        //redirects to product info page
        header('Location: ../product_info.php');
        
        //closes db connection
        $db->close();
        exit();
?>