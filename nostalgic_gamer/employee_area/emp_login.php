<?php
    //includes session info
    session_start();
    
    //checks if user is already logged in
    if (isset($_SESSION['emp_login']) && $_SESSION['emp_login'] === true) {
        $_SESSION['emp_ali'] = true;
        header('Location: admin_home.php');
        exit();
    }
    
    //notifies user if they are not logged in
    if ($_SESSION['emp_nli'] == true) {
        $notice = "ERROR: Not logged in. Please log in.";
        $_SESSION['emp_nli'] = false;
    }

    //creates variables from passed values
    $user = trim(strtolower($_POST['user']));
    $pass = trim($_POST['pass']);
   
   //checks if input was taken
   if (!empty($user) && !empty($pass)) { 
        //checks if login info is valid
        if ($user == 'ng_admin' && $pass == 'nachip0821') {
            //redirects to admin if valid
            $_SESSION['emp_login'] = true;
            $_SESSION['loggedin'] = false;
            header('Location: admin_home.php');
            exit();
        }
        
        //informs user if login info is incorrect
        else {
            $notice = "ERROR: Incorrect login info.";
        }
   }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Employee Log In</title>
        
        <style>
        /*centers output*/
            body {text-align: center;}
            
            table {
                position: relative;
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </head>
    
    <body>
        <!--prints notice for user-->
        <p style='color: red;'><?php echo $notice; ?></p>
        
        <!--outputs page title-->
        <h1>Employee Log In</h1>
        
        <!--takes input and passes it to self for processing-->
        <form action='emp_login.php' method='post'>
            <table>
                
                <!--takes input for username-->
                <tr>
                    <td>
                        <label for='user'>Username: </label>
                    </td>
                    <td>
                        <input type='text' name='user'>
                    </td>
                </tr>
                
                <!--takes input for password-->
                <tr>
                    <td>
                        <label for='pass'>Password: </label>
                    </td>
                    <td>
                        <input type='password' name='pass'>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br>
                    </td>
                </tr>
                
                <!--allows user to submit input-->
                <tr>
                    <td colspan='2'>
                        <input type='submit' value='Log In'>
                    </td>
                </tr>
            </table>
        </form>
        
        <!--links user back to customer log in page-->
        <p><a href='../login.php'>Customer Log In</a></p>
    </body>
</html>