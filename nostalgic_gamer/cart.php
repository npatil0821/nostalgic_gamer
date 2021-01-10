<?php
    //incudes database connection file
    require_once 'db_connect.php';
    
    //gets session info
    session_start();
    
    $cart_empty = $_GET['cart_empty'];
    
    //checks if user has logged in. if not, redirects to login page
    if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin']) === false) {
        header('Location: login.php');
        $_SESSION['needlog'] = true;
        
        exit();
    }
    
    //checks if new items were added to cart. informs user if they were
    if($_SESSION['added'] == true) {
        $notice = "<p style='color: green;'>Items added to cart.</p>";
        
        $_SESSION['added'] = false;
    }
    
    //checks if items have been removed informs user if they were
    else if ($_SESSION['removed'] == true) {
        $notice == "<p style='color: green;'>Items removed from cart.</p>";
        
        $_SESSION['removed'] = false;
    }
    
    //notifies user if removal of item not in cart was attempted
    else if ($_SESSION['cart_rm_fail'] == 'notincart') {
        $notice = "<p style='color: red;'>ERROR: Item is not in cart.</p>";
        
        $_SESSION['cart_rm_fail'] = '';
    }
    
    //notifies user if removal from an empty cart was attempted
    else if ($_SESSION['cart_rm_fail'] == 'empty' || $_SESSION['ord_failed'] == 'empty') {
        $notice = "<p style='color: red;'>ERROR: Cart is empty.</p>";
        
        $_SESSION['cart_rm_fail'] = '';
        $_SESSION['ord_failed'] = '';
    }
    
    //empties cart if requested
    else if ($cart_empty == true) {
        $_SESSION['cart_id'] = [];
        $_SESSION['cart_qty'] = [];
        
        $cart_empty = false;
        
        $notice = "<p style='color: green;'>Cart emptied</p>";
    }
    
    //informs user if order placement has failed
    else if ($_SESSION['ord_failed'] == 'failedinsert') {
        $notice = "<p style='color: red;'>ERROR: Order could not be placed. Please try again.</p>";
        
        $_SESSION['ord_failed'] = false;
    }
    
    //gets cart info if cart is not empty
    if (!empty($_SESSION['cart_id']))
        $in = join("', '", $_SESSION['cart_id']);
    
    
    $query = "SELECT productid, name, image FROM PRODUCTS WHERE productid IN ('".$in."')";
    $results = $db->query($query);
    
    $num_results = $results->num_rows;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Your Cart</title>
        <style>
        /*sets appropriate image size*/
            img {
                max-width: 200px;
                max-height: 200px;
            }
        </style>
    </head>
    
    <body style='text-align: center;'>
        <?php echo $notice; ?>
        <h1>Your Cart</h1>
        <br>
        <?php
            //loops through the queried results and outputs the image, ID, name, quantity, and price of each product
            //allows item to be removed from cart; passes quantity input and product id to remove_from_cart.php to process
            for ($i=0; $i <$num_results; $i++) {
                $row = $results->fetch_assoc();
                $item_price = $_SESSION['cart_price'][$i] * $_SESSION['cart_qty'][$i];
                echo "<img src='".$row['image']."' alt='product image'>
                <p>
                    <form action='process/remove_from_cart.php?id=".$row['productid']."' method='post'>
                        <b>Product ID:</b> ".$row['productid']."
                        <br>
                        <b>Name:</b> ".$row['name']."
                        <br>
                        <b>Quantity:</b> ".$_SESSION['cart_qty'][$i]."
                        <br>
                        <b>Price:</b> $".number_format($_SESSION['cart_price'][$i], 2)."
                        <br>
                        <label for='qty'>Remove from cart:</label> <input type='number' id='qty' name='qty' min='1' max='".$_SESSION['cart_qty'][$i]."' required> <input type='submit' value='Remove'>
                    </form>
                </p>
                <br>";
            
                $total_price += $item_price;
            }
    
            //displays total price of items in cart. if empty, informs user cart is empty
            if (!empty($total_price))
                echo "<p>Total price: $".number_format($total_price, 2)."</p>
                <br>
                <form action='process/place_order.php' method='post'>
                    <input type='hidden' name='total_price' value='".$total_price."'>
                    <input type='submit' value='Place Order'>
                </form>
                <br>
                <form action='cart.php?cart_empty=true' method='post'>
                    <input type='submit' value='Empty Cart'>
                </form>
                <br>";
    
            else
                echo "<br>
                <p>Your cart is empty.</p>
                <br>";
        ?>
        </p>
        <!--displays links to return to index page or to go to search-->
        <p><a href='homepage.php'>Home</a><br><a href='search_products.php'>Product Search</a></p>
    </body>
</html>

<?php
    //clears returned values and closes db connection
    $results->free();
    $db->close();
?>