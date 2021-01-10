<?php
    //includes db connection
    require_once '../../db_connect.php';
    
    //includes session info
    session_start();
    
    echo $_SESSION['search_fail'];
    
     //checks if user is logged in. if not redirects them to log in page
    if ((isset($_SESSION['emp_login']) && $_SESSION['emp_login']) === false) {
        $_SESSION['emp_nli'] = true;
        header('Location: ../emp_login.php');
        
        //closes db connection
        $db->close();
        exit();
    }
    
    //gets values passed and assigns them to variables
    $ordid = $_POST['ordid'];
    $empid = $_POST['empid'];
    
    //checks is information was input properly. if not redirects them to customer orders page
    if ($ordid == '' || $empid == '') {
        $_SESSION['impinp'] = true;
        header('Location: ../customer_orders.php');
        
        //closes db connection
        $db->close();
        exit();
    }
    
    //queries db for employee id
    $query = "SELECT * FROM EMPLOYEES WHERE employeeid = '".$empid."'";
    $results = $db->query($query);
    
    $num_results = $results->num_rows;
    
    
    //checks if employee id exists. if not, redirects to customer orders page
    if ($num_results == 0) {
        $_SESSION['emp_dne'] = true;
        
        header ('Location: ../customer_orders.php');
        
        //closes db connection
        $results->free();
        $db->close();
        exit();
    }
    
    //updates authempid value of selected order
    $query = "UPDATE ORDERS SET authempid = '".$empid."' WHERE orderid ='".$ordid."'";
    $results = $db->query($query);
    
    //checks if order was updated
    if ($results)
        $_SESSION['ord_updated'] = true;
    
    else
        $_SESSION['ord_updated'] = false;
    
    //redirects to customer orders page
    header('Location: ../customer_orders.php');
    
    //closes db connection
    $db->close();
    exit();
?>