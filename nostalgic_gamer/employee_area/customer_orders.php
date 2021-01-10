<?php
    //includes db connection
    require_once '../db_connect.php';
    
    //includes session info
    session_start();
    
    //checks if user is logged in
    if ((isset($_SESSION['emp_login']) && $_SESSION['emp_login']) === false) {
        $_SESSION['emp_nli'] = true;
        header('Location: emp_login.php');
        
        //closes db connection
        $db->close();
        exit();
    }
    
    //informs user if employee id does not exist
    if ($_SESSION['emp_dne'] == true) {
        $notice = "<p style='color: red'>ERROR: Employee ID does not exist. Please try again.</p>";
        
        $_SESSION['emp_dne'] = false;
    }
    
    //informs user if order was successfully authorized
    else if ($_SESSION['ord_updated'] == true) {
        $notice = "<p style='color: green'>Order successfully authorized.</p>";
        
        $_SESSION['ord_updated'] = '';
    }
    //informs user if order authorization failed
    else if ($_SESSION['ord_updated'] == false) {
        $notice == "<p style='color: red'>ERROR: Order could not be authorized. Please try again.</p>";
        
        $_SESSION['ord_updated'] = '';
    }
    
    //gets all unauthorized orders
    $query = "SELECT * FROM UNAUTH_ORDERS";
    $results = $db->query($query);
    
    //gets number of results
    $num_results = $results->num_rows;
   
   
    //notifies user if input was not properly received
    if ($_SESSION['search_fail'] == true) {
        $notice = "<p style='color: red'>ERROR: Search terms were not properly entered. Please try again.</p>";
        
        $_SESSION['search_fail'] = false;
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Customer Orders</title>
        
        <style>
        /*centers output and gives table borders*/
            body {text-align: center;}
            
            table {
                position: relative;
                margin-right: auto;
                margin-left: auto;
                border: solid 1px black;
                border-collapse: collapse;
            }
            
            th, td {border: solid 1px black;}
        </style>
    </head>
    
    <body>
        <!--outputs notice for user-->
        <?php echo $notice; ?>
        <h1>Unauthorized Orders</h1>
        <?php
            //checks if there are unauthorized orders.
            if ($num_results > '0') {
                echo "<table>
                    <tr>
                        <th>
                            Order ID
                        </th>
                        <th>
                            Customer ID
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
                            Authorized By
                        </th>
                    </tr>";
                
                //if there are unauthorized orders, outputs order info and allows user to authorize them
                for ($i = 0; $i < $num_results; $i++) {
                    $row = $results->fetch_assoc();
                        
                    echo "<form action='emp_process/auth_orders.php' method='post'>
                        <tr>
                            <td>
                                ".$row['orderid']."
                            </td>
                            <td>
                                ".$row['customerid']."
                            </td>
                            <td>
                                ".$row['cost']."
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
                                <input type='text' name='empid' pattern='[0-9]{5}' placeholder='Enter Employee ID'>
                                <input type='submit' value='Authorize'>
                            </td>
                        </tr>
                    </form>";
                }
            }
            
            //informs user there is no unauthorized orders
            else {
                echo "There are no unauthorized orders.";
            }
                ?>
        </table>
        
        <!--allows user to search orders by customer or order id-->
        <h1>Search Orders</h1>
        
        <!--takes input and passes it to ord_search_results.php for processing-->
        <form action="ord_search_results.php" method="post">
            <table>
                <!--takes input for search type-->
                <tr>
                    <td>
                        <label for='type'>Search By:</label>
                    </td>
                    <td>
                        <select id='type' name='type' style='width: 100%;' required>
                            <option value='orderid'>Order ID</option>
                            <option value="customerid">Customer ID</option>
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
                <tr style='text-align: center;'>
                    <td colspan='2'>
                        <input type='submit' value='Search' style='width: 40%;'> <input type='reset' value='Clear' style='width: 40%;'>
                    </td>
                </tr>
            </table>
        </form>
        
        <!--links user back to admin home-->
        <p><a href='admin_home.php'>Back to Admin Home</a></p>
    </body>
</html>