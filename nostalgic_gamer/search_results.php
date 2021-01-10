<?php
    //includes file with db connection
    require_once 'db_connect.php';
    
    //gets session info
    session_start();
    
    //takes input passed from form and assigns to variables
    $searchtype = $_POST['type'];
    $searchterm = trim($_POST['term']);
    
    if (!$searchtype || ($searchterm == '')) {
        $_SESSION['search_fail'] = true;
        header('Location: search_products.php');
        
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
        
        <!--displays images at 200 x 200 px-->
        <style>
            body {text-align: center;}
        
            img {
                max-width: 200px;
                max-height: 200px;
            }
        </style>
    </head>
        
    <body>
        <p style='color: red;'><?php echo $notice ?></p>
        <h1>Search Results</h1>
        <p><?php echo $num_results ?> Results:</p>
        <br>
        <?php
        //loops through the queried results and outputs the image, ID, name, description, type, stock, and price of each product
        for ($i=0; $i <$num_results; $i++) {
            $row = $results->fetch_assoc();
            
            //passes quantity to cart if add to cart button is clicked
            echo "<img src='".$row['image']."' alt='product image'>
            <p>
                <form action='process/add_to_cart.php?id=".$row['productid']."' method='post'>
                    <b>Product ID:</b> ".$row['productid']."
                    <br>
                    <b>Name:</b> ".$row['name']."
                    <br>
                    <b>Description:</b> ".$row['description']."
                    <br>
                    <b>Type:</b> ".$row['type']."
                    <br>
                    <b>Stock:</b> ".$row['stock']."
                    <br>
                    <b>Price:</b> $".number_format($row['price'], 2)."
                    <br>
                    <label for='qty'>Add to cart:</label> <input type='number' id='qty' name='qty' min='1' max='".$row['stock']."' required> <input type='submit' value='Add'>
                </form>
            </p>
            <br>";
        }
        ?>
        
        <!--redirects to search_products.php if clicked-->
        <p><a href='search_products.php'>Back to Search</a></p>
    </body>
</html>

<?php
  //closes before exiting
  $results->free();
  $db->close();
?>