<?php
    //includes session info
    session_start();
    
    //checks if user is logged in
    if ((isset($_SESSION['emp_login']) && $_SESSION['emp_login']) === false) {
        $_SESSION['emp_nli'] = true;
        header('Location: emp_login.php');
        exit();
    }
    
    //notifies user if they are already logged in
    if ($_SESSION['emp_ali'] == true) {
        $notice = 'You are already logged in.';
        $_SESSION['emp_ali'] = false;
    }
    
    //gets input and assigns it to variable
    $logout = $_POST['logout'];
    
    //if user has logged out, redirects them to homepage
    if ($logout == true) {
        session_unset();
        session_destroy();
        $_SESSION['logout'] = true;
        header('Location: ../homepage.php');
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>NG Admin</title>
        
        <style>
            /*centers all output*/
            body {text-align: center;}
        </style>
    </head>
    
    <body>
        <p style='color: green;'><?php echo $notice; ?></p>
        <h1>NG Admin</h1>
        
        <p>
            <!--allows user to go to page to view employee info-->
            <a href='employee_info.php'>Employee Info</a>
            <br>
            
            <!--redirects user to customer orders page-->
            <a href='customer_orders.php'>Customer Orders</a>
            <br>
            
            <!--redirects user to product info page-->
            <a href='product_info.php'>Product Info</a>
            <br>
            
            <!--logs out the user and returns them to homepage-->
            <form action='admin_home.php' method='post'>
                <input type='hidden' name='logout' value='true'>
                <input type='submit' value='Log Out'>
            </form>
        </p>
    </body>
</html>