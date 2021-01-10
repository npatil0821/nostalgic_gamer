<?php
    //includes db connection
    require_once '../db_connect.php';

    //gets session info
    session_start();
    
    //checks if user is logged in
    if ((isset($_SESSION['emp_login']) && $_SESSION['emp_login']) === false) {
        $_SESSION['emp_nli'] = true;
        header('Location: emp_login.php');
        exit();
    }
    
    //gets info about all items that are out of stock
    $query = "SELECT * FROM OUT_OF_STOCK";
    $results = $db->query($query);
    
    //gets number of results
    $num_results = $results->num_rows;
    
    //notifies user if stock was properly added
    if ($_SESSION['prod_update'] == 'success') {
        $notice = "<p style='color: green;'>Stock successfully updated.</p>";
        
        $_SESSION['prod_update'] = '';
    }
    
    //notifies user if stock could not be added
    else if ($_SESSION['prod_update'] == 'failed') {
        $notice = "<p style='color: red;'>ERROR: Could not update stock. Please try again.</p>";
        
        $_SESSION['prod_update'] = '';
    }
    
    //notifies user if input was not properly received
    else if ($_SESSION['search_fail'] == true) {
        $notice = "<p style='color: red;'>ERROR: Search terms were not input correctly. Please try again.</p>";
        
        $_SESSION['search_fail'] = false;
    }
    
    //notifies user if product was added
    else if ($_SESSION['prodadd'] == true) {
        $notice = "<p style='color: green;'>Product successfully added.</p>";
        
        $_SESSION['prodadd'] = false;
    }
    
    //notifies user if product was deleted
    else if ($_SESSION['prod_del'] == 'done') {
        $notice = "<p style='color: green;'>Product successfully deleted.</p>";
        
        $_SESSION['prod_del'] = '';
    }
    
    //notifies user if there was an error deleting the product
    else if ($_SESSION['prod_del'] == 'failed') {
        $notice = "<p style='color: red;'>ERROR: Could not delete product. Please try again.</p>";
        
        $_SESSION['prod_del'] = '';
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Product Info</title>
        
        <style>
            /*centers outputs and gives table borders*/
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
        <!--outputs notice for user-->
        <?php echo $notice ?>
        <h1>Out of Stock</h1>
        <?php
            //checks if there are any out of stock items. if not, informs user
            if ($num_results == 0) {
                echo 'There are no out of stock items.';
            }
            
            //otherwise prints out info about all out of stock items
            else {
                echo "<table>
                    <tr>
                        <th>
                            Product ID
                        </th>
                        <th>
                            Product Name
                        </th>
                        <th>
                            Type
                        </th>
                        <th>
                            Stock
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Add Stock
                        </th>
                        <th>
                            Delete
                        </th>
                    </tr>";
                
                //prints out product id, name, type, and stock for each item
                //allows uer to add stock or delete item
                for ($i = 0; $i < $num_results; $i++) {
                    $row = $results->fetch_assoc();
                    
                    echo "<tr>
                            <td>
                                ".$row['productid']."
                            </td>
                            <td>
                                ".$row['name']."
                            </td>
                            <td>
                                ".$row['type']."
                            </td>
                            <td>
                                ".$row['stock']."
                            </td>
                            <td>
                                ".$row['price']."
                            </td>
                            <td>
                                <form action='emp_process/add_stock.php' method='post'>
                                    <input type='hidden' name='prodid' value='".$row['productid']."'>
                                    <input type='number' name='addstock' min='1' required>
                                    <input type='submit' value='Add'>
                                </form>
                            </td>
                            <td>
                                <form action='emp_process/delete_product.php' method='post'>
                                    <input type='hidden' name='prodid' value='".$row['productid']."'>
                                    <input type='submit' value='Delete'>
                                </form>
                            </td>
                        </tr>";
                }
                
                echo "</table>";
            }
        ?>
        
        <!--allows user to search for product-->
        <h1>Product Search</h1>
        
        <!--takes input and passes it to search_prod_results.php for processing-->
        <form action="search_prod_results.php" method="post">
            <table>
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
                <tr style='text-align: center;'>
                    <td colspan='2'>
                        <input type='submit' value='Search' style='width: 40%;'> <input type='reset' value='Clear' style='width: 40%;'>
                    </td>
                </tr>
            </table>
        </form>
        
        <!--links user back to admin home or to product addition page-->
        <p><a href='admin_home.php'>Back to Admin Home</a>
        <br>
        <a href='add_product.php'>Add Product</a></p>
    </body>
</html>