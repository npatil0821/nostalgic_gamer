<?php
    //includes db connection info
    require_once '../db_connect.php';

    //gets session info
    session_start();
    
    //assigns passed values to variables
    $id = $_GET['id'];
    $qty = $_POST['qty'];
    
    //checks if user has logged in. if not, redirects to login page
    if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin']) === false) {
        header('Location: ../login.php');
        $_SESSION['needlog'] = true;
        
        exit();
    }
    
    //checks if new item has been added to cart
    if (!empty($id)) {
        //gets available stock of item
            $query = "SELECT stock, price FROM PRODUCTS where productid ='".$id."'";
            $result = $db->query($query);
            $row = $result->fetch_assoc();
            $stock = $row['stock'];
            $price = $row['price'];
        
        //checks if stock for amount being added to cart is available. if not, redirects user to search page
        if ($qty > $stock) {
            $_SESSION['overstock'] = true;
                header('Location: ../search_products.php');
            
            $result->free();
            $db->close();
            exit();
        }
        
        //checks if cart is empty. if so initializes arrays for it
        if (empty($_SESSION['cart_id'])) {
            $_SESSION['cart_id'] = array($id);
            $_SESSION['cart_qty'] = array($qty);
            $_SESSION['cart_price'] = array($price);
        }
        
        //if cart is not empty and item has previously been added, finds the index of added item and adds to the quantity
        else if (in_array($id, $_SESSION['cart_id'])) {
            $index = array_search($id, $_SESSION['cart_id']);
            
            //checks if enough stock is available to add to carrt
            if ($_SESSION['cart_qty'][$index] + $qty <= $stock)
                $_SESSION['cart_qty'][$index] += $qty;
                
            //redirects to search page is necessary stock is not available
            else {
                $_SESSION['overstock'] = true;
                header('Location: ../search_products.php');
                
                $result->free();
                $db->close();
                exit();
            }
        }
        
        //if cart is not empty but item has not been added, adds item
        else {
            array_push($_SESSION['cart_id'], $id);
            array_push($_SESSION['cart_qty'], $qty);
            array_push($_SESSION['cart_price'], $price);
        }
        
        //gives confirmation that items were added to the cart
        $_SESSION['added'] = true;
        
        //redirects to cart
        header('Location: ../cart.php');
        exit();
    }
    
    else {
        //redirects to search results page if there was an error adding to cart
        $_SESSION['cart_add_fail'] = true;
        header('Location: ../search_products.php');
        exit();
    }
?>