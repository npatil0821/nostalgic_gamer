<?php
    //includes session info
    session_start();
    
    //checks if user is logged in
    if ((isset($_SESSION['emp_login']) && $_SESSION['emp_login']) === false) {
        $_SESSION['emp_nli'] = true;
        header('Location: emp_login.php');
        exit();
    }
    
    //notifies user if not everything was input
    if ($_SESSION['addfail'] == 'badinp') {
        $notice = 'ERROR: Product info was not properly input. Please try again.';
        
        $_SESSION['addfail'] = '';
    }
    
    //notifies user if some other error occurs
    else if ($_SESSION['addfail'] == 'randerr') {
        $notice = 'ERROR: Could not add product. Please try again.';
        
        $_SESSION['addfail'] = '';
    }
    
    //notifies user if productid is already taken
    else if ($_SESSION['prodidtaken'] == true) {
        $notice = "ERROR: Product ID already exists. Please try again.";
        
        $_SESSION['prodidtaken'] = false;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Add Product</title>
        <style>
            /*Used to center all outputs*/
            body {text-align: center;}
            
            table {
                position: relative;
                margin-left: auto;
                margin-right: auto;
            }
            
            .cat {text-align: right;}
        </style>
    </head>
    
    <body style='text-align: center;'>
        <!--prints notice for user-->
        <p style='color: red;'><?php echo $notice; ?></p>
        
        <!--takes input and passes it to new_prod.php for processing-->
        <form action='emp_process/new_prod.php' method='post'>
            <table>
                <!--displays page title-->
                <tr>
                    <td colspan='2'>
                        <h1>Add Product</h1>
                    </td>
                </tr>
                
                <!--takes input for product id-->
                <tr>
                    <td class='cat'>
                        <label for='prodid'>Product ID:</label>
                    </td>
                    <td>
                        <input type='text' name='prodid' pattern='[0-9]{4}' required>
                    </td>
                </tr>
                
                <!--takes input for product name-->
                <tr>
                    <td class='cat'>
                        <label for='name'>Product Name:</label>
                    </td>
                    <td>
                        <input type='text' name='name' required>
                    </td>
                </tr>
                
                <!--takes input for product description-->
                <tr>
                    <td class='cat'>
                        <label for='desc'>Product Description:</label>
                    </td>
                    <td>
                        <input type='text' name='desc' required>
                    </td>
                </tr>
                
                <!--takes input for image source-->
                <tr>
                    <td class='cat'>
                        <label for='image'>Image Source:</label>
                    </td>
                    <td>
                        <input type='text' name='image' required>
                    </td>
                </tr>
                
                <!--takes input for product type-->
                <tr>
                    <td class='cat'>
                        <label for='type'>Product Type:</label>
                    </td>
                    <td>
                        <select id='type' name='type' style='width: 100%;' required>
                            <option value=''>Select a type</option>
                            <option value='Console'>Console</option>
                            <option value='Controller/Link'>Controller/Link</option>
                            <option value='Memory Storage'>Memory Storage</option>
                            <option value='Charger/Battery'>Charger/Battery</option>
                            <option value='Game'>Game</option>
                        </select>
                    </td>
                </tr>
                
                <!--takes input for product stock-->
                <tr>
                    <td class='cat'>
                        <label for='stock'>Stock:</label>
                    </td>
                    <td>
                        <input type='number' name='stock' min='1' required>
                    </td>
                </tr>
                
                <!--takes input for product price-->
                <tr>
                    <td class='cat'>
                        <label for='price'>Price ($):</label>
                    </td>
                    <td>
                        <input type='number' name='price' min='1' required>
                    </td>
                </tr>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                
                <!--allows user to submit input-->
                <tr>
                    <td colspan='2'>
                        <input type='submit' value='Add Product' style='width: 40%;'> <input type='reset' value='Clear' style='width: 40%;'>
                    </td>
                </tr>
            </table>
        </form>
        
        <!--links user back to products info page-->
        <p><a href='product_info.php'>Back to Product Info</a></p>
    </body>
</html>