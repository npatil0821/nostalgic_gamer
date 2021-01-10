<?php
    //include db connection
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
    
    //gets all previous orders placed by customer
    $query = "SELECT orderid, cost, address, date, time from ORDERS WHERE customerid = (SELECT customerid FROM CUSTOMERS WHERE username = '".$_SESSION['user']."') ORDER BY date, time";
    $results = $db->query($query);
    
    //gets number of orders
    $num_results = $results->num_rows;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Previous Orders</title>
        <style>
        /*centers ouput and creates a black border around table*/
            body {text-align: center;}
            
            table {
                position: relative;
                margin-left: auto;
                margin-right: auto;
                border: solid 1px black;
                border-collapse: collapse;
            }
            
            th, td {border: solid 1px black;}
        </style>
    </head>
    
    <body>
        <h1>Previous Orders</h1>
        <?php
            //checks if there is at least 1 order
            if ($num_results > 0) {
                echo "<table>
                        <tr>
                            <th>
                                Order ID
                            </th>
                            <th>
                                Total Cost
                            </th>
                            <th>
                                Address Shipped
                            </th>
                            <th>
                                Date Placed
                            </th>
                            <th>
                                Time Placed
                            </th>
                            <th>
                                Details
                            </th>
                        </tr>";
                
                //outputs info for all orders in table rows
                for ($i = 0; $i < $num_results; $i++) {
                $row = $results->fetch_assoc();
                
                //passes order ID and total cost through php to order_details for processing if button to view details is pressed
                echo "<form action='order_details.php' method='post'>
                    <tr>
                        <td>
                            ".$row['orderid']."
                        </td>
                        <td>
                            $".number_format($row['cost'], 2)."
                        </td>
                        <td>
                            ".$row['address']."
                        </td>
                        <td>
                            ".$row['date']."
                        </td>
                        <td>
                            ".$row['time']."
                        </td>
                        <td>
                            <input type='hidden' name='ordid' value='".$row['orderid']."'>
                            <input type='hidden' name='cost' value='".$row['cost']."'>
                            <input type='submit' value='View Details'>
                        </td>
                    </tr>
                </form>";
                }
            
            echo "</table>";
                
            }
            
            //informs user they have no orders if no orders were found
            else
                echo "<p>You have not placed any orders yet!</p>";
        ?>
        
        <!--displays links which redirect to homepage and account page-->
        <p>
            <a href='account.php'>Your Account</a>
            <br>
            <a href='homepage.php'>Home</a>
        </p>
    </body>
</html>

<?php
    //closes db connection
    if ($num_results > 0)
        $results->free();
        
    $db->close();
?>