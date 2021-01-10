<?php
    //includes file with db connection
    require_once '../db_connect.php';
    
    //gets session info
    session_start();
    
     //checks if user is logged in
    if ((isset($_SESSION['emp_login']) && $_SESSION['emp_login']) === false) {
        $_SESSION['emp_nli'] = true;
        header('Location: emp_login.php');
        exit();
    }
    
    //takes input passed from form and assigns to variables
    $searchtype = $_POST['type'];
    $searchterm = trim($_POST['term']);
    
    //checks if search terms were not properly entered. redirects to customer orders page if so
    if ($searchtype == '' || $searchterm == '') {
        $_SESSION['search_fail'] = true;
        header('Location: customer_orders.php');
        
        //closes db connection
        $db->close();
        exit();
    }
    
    //adds backslashes to any quotes in search term or type name
    if (!get_magic_quotes_gpc())
      $searchterm = addslashes($searchterm);
    
    //queries database for search term in search type
    $query = "SELECT * from ORDERS WHERE ".$searchtype." like '%".$searchterm."%'";
    $results = $db->query($query);
  
    //gets number of items found
    $num_results = $results->num_rows;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Search Results</title>
        
        <!--centers output and gives table borders-->
        <style>
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
        <h1>Search Results</h1>
        <p><?php echo $num_results ?> Results:</p>
        <br>
        <?php
            //checks if any results were returned
            if ($num_results != 0) {
                echo"<table>
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
                
                //loops through results
                for ($i=0; $i <$num_results; $i++) {
                    $row = $results->fetch_assoc();
                    
                    //allows user to authorize order if unauthorized
                    if ($row['authempid'] == 'NULL') {
                        $auth_display = "<form action='emp_process/auth_orders.php' method='post'>
                        <input type='hidden' name='ordid' value='".$row['orderid']."'>
                        <input type='text' name='empid' pattern='[0-9]{5}' placeholder='Enter Employee ID'>
                        <input type='submit' value='Authorize'>
                        </form>";
                    }
            
                    //displays authorizing employee's id if authorized already
                    else
                        $auth_display = $row['authempid'];
            
                    //prints out returned results
                    echo "<tr>
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
                                ".$auth_display."
                            </td>
                        </tr>";
                }
                
            echo "</table>";
            }
        ?>
        
        <!--redirects to search_products.php if clicked-->
        <p><a href='customer_orders.php'>Back to Order Search</a></p>
    </body>
</html>

<?php
  //closes before exiting
  $results->free();
  $db->close();
?>