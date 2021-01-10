<?php
    //includes file with db connection
    require_once '../db_connect.php';
    
    //gets session info
    session_start();
    
    if ((isset($_SESSION['emp_login']) && $_SESSION['emp_login']) === false) {
        $_SESSION['emp_nli'] = true;
        header('Location: emp_login.php');
        exit();
    }
    
    //takes input passed from form and assigns to variables
    $searchtype = $_POST['type'];
    $searchterm = trim($_POST['term']);
    
    if (!$searchtype || ($searchterm == '')) {
        $_SESSION['search_fail'] = true;
        header('Location: product_info.php');
        
        //closes db connection
        $db->close();
        exit();
  }
    
    //adds backslashes to any quotes in search term or type name
    if (!get_magic_quotes_gpc())
      $searchterm = addslashes($searchterm);
    
    //queries database for search term in search type
    $query = "SELECT * from PRODUCTS WHERE ".$searchtype." like '%".$searchterm."%'";
    $results = $db->query($query);
  
    //gets number of items found
    $num_results = $results->num_rows;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Search Results</title>
        

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
        <p style='color: red;'><?php echo $notice ?></p>
        
        <!--outputs title of page-->
        <h1>Search Results</h1>
        
        <!--outputs number of results-->
        <p><?php echo $num_results ?> Results:</p>
        <br>
        
        <!--outputs header for product info-->
        <table>
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
            </tr>
        
        <?php
            //loops through products and outputs each product's info
            //allows user to add stock or delete item
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
        ?>
        </table>
        
        <!--redirects to search_products.php if clicked-->
        <p><a href='product_info.php'>Back to Product Info</a></p>
    </body>
</html>

<?php
  //closes before exiting
  $results->free();
  $db->close();
?>