<?php
    //gets db connection info
    require_once 'db_connect.php';
    
    //gets session info
    session_start();
    
    //checks if user has logged in. if not, redirects to login page
    if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin']) === false) {
        $_SESSION['needlog'] = true;
        header('Location: login.php');
        
        //closes db connection
        $db->close();
        exit();
    }
    
    //creates query to get user info from YOUR_INFO view
    $query = "SELECT * FROM YOUR_INFO WHERE username = '".$_SESSION['user']."'";
    
    //gets info from db
    $results = $db->query($query);
    $row = $results->fetch_assoc();
    
    //creates variables from queried values
    $username = $row['username'];
    $email = $row['email'];
    $fname = $row['firstname'];
    $lname = $row['lastname'];
    $address = $row['address'];
    
    //closes connection and clears results
    $results->free();
    $db->close();
    ?>
    
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Your Account</title>
        <style>
        /*centers all outputs and bolds category names*/
            p {text-align: center;}
                
            table {
                position: relative;
                margin-left: auto;
                margin-right: auto;
            }
            
            td {
                text-align: right;
                font-weight: bold;
            }
            
            .info {
                font-weight: normal;
                text-align: left;
            }
        </style>
    </head>
        
    <body>
        <!--outputs query results in a table-->
        <table>
            <tr>
                <td colspan='2' style='text-align: center;'>
                    <h1>Your Account</h1>
                </td>
            </tr>
            <!--outputs username-->
            <tr>
                <td>
                    Username: 
                </td>
                <td class='info'>
                    <?php echo $username; ?>
                </td>
            </tr>
            <!--outputs email-->
            <tr>
                <td>
                    Email: 
                </td>
                <td class='info'>
                    <?php echo $email; ?>
                </td>
            </tr>
            <!--outputs first name-->
            <tr>
                <td>
                    First Name: 
                </td>
                <td class='info'>
                    <?php echo $fname; ?>
                </td>
            </tr>
            <!--outputs last name-->
            <tr>
                <td>
                    Last Name: 
                </td>
                <td class='info'>
                    <?php echo $lname; ?>
                </td>
            </tr>
            <!--outputs address-->
            <tr>
                <td>
                    Address: 
                </td>
                <td class='info'>
                    <?php echo $address; ?>
                </td>
            </tr>
        </table>
        <br>
        <p>
            <!--links back to homepage-->
            <a href='homepage.php'>Home</a>
            <br>
            <!--links to previous orders page-->
            <a href='previous_orders.php'>Previous Orders</a>
            <br>
        </p>
    </body>
</html>