<?php
    //includes db connection
    require_once 'db_connect.php';
    
    //includes session info
    session_start();
    
    //checks if user is logged in
    if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin']) === false) {
        header('Location: homepage.php');
        $_SESSION['needlog'] = true;
        
        //closes db conection
	    $db->close();
        exit();
    }
    
    //gets passed values and assigns them to variables
    $ordid = $_POST['ordid'];
    $cost = $_POST['cost'];
    
    //queries for items in order value passed
    $query = "SELECT productid, productname, price, quantity FROM ORDER_CONTAINS WHERE orderid ='".$ordid."'";
    $results = $db->query($query);
    
    //gets number of results
    $num_results = $results->num_rows;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Order Details</title>
        <style>
            /*centers output and puts borders around tables and cells*/
            body {text-align: center;}
            
            table {
                position: relative;
                margin-left: auto;
                margin-right: auto;
            }
            
            th, .cellbord {border: solid 1px black;}
        </style>
    </head>
    
    <body>
        <table>
            <tr>
                <td colspan='2'>
                    <h1>Order Details</h1>
                </td>
            </tr>
            <tr>
                <td>
                    Order ID:
                </td>
                <td>
                    <!--prints out the order id of current order-->
                    <?php echo $ordid; ?>
                </td>
            </tr>
            <tr>
                <td>
                    Total Cost:
                </td>
                <td>
                    <!--prints out the total cost of current order-->
                    <?php echo "$".number_format($cost, 2); ?>
                </td>
            </tr>
        </table>
        <br>
        <!--outputs table with id, name, price, and quantity of products-->
        <table style='border: solid 1px black; border-collapse: collapse;'>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            <?php
                //outputs id, name, cost, and quantity of each item bought
                for ($i = 0; $i < $num_results; $i++) {
                    $row = $results->fetch_assoc();
                    
                    echo "<tr>
                        <td class='cellbord'>
                            ".$row['productid']."
                        </td>
                        <td class='cellbord'>
                            ".$row['productname']."
                        </td>
                        <td class='cellbord'>
                            $".number_format($row['price'], 2)."
                        </td>
                        <td class='cellbord'>
                            ".$row['quantity']."
                        </td>
                    </tr>";
                }
            ?>
        </table>
        <br>
        <!--redirects to previous orders-->
        <p><a href='previous_orders.php'>View Other Orders</a></p>
    </body>
</html>