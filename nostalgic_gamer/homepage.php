<?php
    //includes session information
    session_start();
    
    //checks if user has logged in; if they are, outputs a greeting with their name, the option to view their cart, and the option to log out.
    //clicking link to account redirects to account page
    //clicking link to cart redirects to cart page
    //clicking link to log out redirects to logout page
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        $user_info = "Hello, ".$_SESSION['name']."!
        <br>
        <a href='account.php'>Your Account</a>
        <br>
        <a href='cart.php'>Your Cart</a>
        <br>
        <a href='process/logout.php'>Log Out</a>";
    }
    
    //notifies user if they are already logged in
    if ($_SESSION['relog'] == true) {
        $notice = "<p style='text-align: center; color: red;'>You are already logged in.</p>";
                
        $_SESSION['relog'] = false;
    }
    
    //notifies user if they have logged out
    else if ($_SESSION['logout'] == true) {
        $notice = "<p style='text-align: center; color: green;'>You have successfully logged out.</p>";
                
        $_SESSION['logout'] = false;
    }
            
    //notifies user if they have logged in
    else if ($_SESSION['newlog'] == true) {
        $notice = "<p style='text-align: center; color: green;'>You have successfully logged in.</p>";
                
        $_SESSION['newlog'] = false;
    }
    
    //notifies user if they have registered        
    else if ($_SESSION['regdone'] == true) {
        $notice = "<p style='text-align: center; color: green;'>You have successfully registered! Please Log in.</p>";
                
        $_SESSION['regdone'] = false;
    }
    
    //notifies user if order has been placed        
    else if ($_SESSION['ord_saved'] == true) {
        $notice = "<p style='color: green;'>Your order has been placed!</p>";
                
        $_SESSION['ord_saved'] = false;
    }
    
    //notifies user if updating stock has failed
    else if ($_SESSION['ordfailed'] == 'stockupdatefail') {
        $notice = "<p style='color: red;'>ERROR: Stock was not updated.</p>";
                
        $_SESSION['ordfailed'] = '';
    }
    
    //notifies user if saving order info has failed
    else if ($_SESSION['ordfailed'] == 'ordinfofail') {
        $notice = "<p style='color: red;'>ERROR: Order info was not saved.</p>";
                
        $_SESSION['ordfailed'] = '';
    }
    
    //notifies user if saving order info has failed
    else if ($_SESSION['needlog'] == true) {
        $notice = "<p style='color: red;'>ERROR: You must be logged in to view previous orders. Please log in.</p>";
                
        $_SESSION['needlog'] = false;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>The Nostalgic Gamer</title>
        <style>
            /*centers outputs*/
            body {text-align: center;}
        
            table {
                max-width: 50%;
                margin-left: auto;
                margin-right: auto;
                position: relative;
            }
            
            /*aligns user info to top right*/
            .user_info {
                text-align: right;
                position: relative;
                margin-right: 5%;
            }
        </style>
    </head>
    
    <body>
        <!--prints notices for user-->
        <?php echo $notice; ?>
        
        <p class='user_info'>
            <?php echo $user_info;?>
        </p>
        
        <table>
            <tr>
                <!--outputs page title-->
                <td>
                    <h1>Welcome to The Nostalgic Gamer!</h1>
                </td>
            </tr>
            <!--outputs website info-->
            <tr>
                <td>
                    <p>At The Nostalgic Gamer, we have video games, consoles, and console accessories which were prominent in the 2000s. With our products, Millenials can relive their childhood memories, and older gamers can reindulge in the gaming experiences of a past era. Even those who are younger who may not have had a prominent gaming experience in the 2000s can find something new for themselves and experience what an amazing decade of gaming has to offer!</p>
                </td>
            </tr>
            <tr>
                <td>
                    <!--link to product search page-->
                    <a href='search_products.php'>View Our Products</a>
                    <?php
                        if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin']) === false) {
                            echo "<br>
                            <a href='login.php'>Log In</a>
                            <br>
                            <a href='registration.php'>Register</a>";
                        }
                    ?>
                </td>
            </tr>
        </table>
    </body>
</html>