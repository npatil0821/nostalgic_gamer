<?php
    //gets session info
    session_start();
    
    //notifies user if input was not properly received
    if ($_SESSION['search_fail'] == true) {
        $notice = 'ERROR: Search terms were not input correctly. Please try again.';
        
        $_SESSION['search_fail'] = false;
    }
    
    //notifies user if items could not be added to cart
    else if ($_SESSION['cart_add_fail'] == true) {
        $notice = 'ERROR: Item could not be added to cart. Please try again.';
        
        $_SESSION['cart_add_fail'] = false;
    }
    
    //notifies user if enough stock is unavailable
    else if ($_SESSION['overstock'] == true) {
        $notice = 'ERROR: Not enough stock. Please try again.';
        
        $_SESSION['overstock'] = false;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Search Products</title>
        <style>
            /*centers output*/
            body {text-align: center;}
            
            table {
                position: relative;
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </head>
    
    <body>
        <!--outputs notice for user-->
        <p style='color: red'><?php echo $notice ?></p>
        
        <!--takes input and passes to search_results.php for processing-->
        <form action="search_results.php" method="post">
            <table>
                <!--outputs page title-->
                 <tr>
                    <td colspan='2'>
                        <h1 style='text-align: center;'>Search Products</h1>
                    </td>
                </tr>
                <!--takes input for search type-->
                <tr>
                    <td>
                        <label for='type'>Search By:</label>
                    </td>
                    <td>
                        <select id='type' name='type' style='width: 100%;' required>
                            <option value='productid'>Product ID</option>
                            <option value="name">Product Name</option>
                            <option value="type">Product Type</option>
                        </select>
                    </td>
                </tr>
                
                <!--takes input for search term-->
                <tr>
                    <td>
                        <label for='term'>Search Term:</label>
                    </td>
                    <td>
                        <input type='text' name='term' required>
                    </td>
                </tr>
                
                <!--allows user to submit input-->
                <tr>
                    <td><br></td>
                </tr>
                <tr style='text-align: center;'>
                    <td colspan='2'>
                        <input type='submit' value='Search' style='width: 40%;'> <input type='reset' value='Clear' style='width: 40%;'>
                    </td>
                </tr>
            </table>
        </form>
        
        <!--links user back to homepage-->
        <p><a href='homepage.php'>Home</a></p>
    </body>
</html>