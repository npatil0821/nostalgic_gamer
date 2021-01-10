<?php
    //includes db connection
    require_once '../../db_connect.php';
    
    //includes session info
    session_start();
    
    //assigns value passed to variable
    $prodid = $_POST['prodid'];
    
    //deletes entry of employee with passed id
    $query = "DELETE FROM PRODUCTS WHERE productid = '".$prodid."'";
    $results = $db->query($query);
    
    //checks if employee was successfully deleted and redirects to employee_info.php
    if ($results) {
        $_SESSION['prod_del'] = 'done';
        header('Location: ../product_info.php');
    }
    
    else {
        $_SESSION['prod_del'] = 'failed';
        header('Location: ../product_info.php');
    }
    
    //closes connection
    $db->close();
    exit();
?>