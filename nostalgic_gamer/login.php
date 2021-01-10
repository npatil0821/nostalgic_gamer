<?php
    //gets session info
    session_start();
    
    //informs user if input was not put in correctly
    if ($_SESSION['logfail'] == 'impinp') {
        $notice = 'ERROR: Log in info was not properly input. Please try again.';
        $_SESSION['logfail'] = '';
    }
    
    //informs user if username does not exist
    else if ($_SESSION['logfail'] == 'userdne') {
        $notice = 'ERROR: Username does not exist. Please try again.';
        $_SESSION['logfail'] = '';
    }
    
    //informs user if password is incorrect
    else if ($_SESSION['logfail'] == 'wrongpass') {
        $notice = 'ERROR: Incorrect password. Please try again.';
        $_SESSION['logfail'] = '';
    }
    
    //informs user if they tried to add items to cart prior to logging in
    else if ($_SESSION['needlog'] == true) {
        $notice = 'ERROR: You are not logged in. Please log in and try again.';
        $_SESSION['needlog'] = false;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Log In</title>
        <style>
        /*Used to center align all outputs*/
            body {text-align: center;}
            
            table {
                position: relative;
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </head>
    
    <body>
        <!--outputs notice for user-->
        <p style='color: red;'><?php echo $notice; ?></p>
        
        <!--passes inputs to login_confirm.php to process-->
        <form action='process/login_confirm.php' method='post'>
            <table>
                <!--outputs page title-->
                <tr>
                    <td colspan='2'>
                        <h1>Log In</h1>
                    </td>
                </tr>
                <!--takes input for username-->
                <tr>
                    <td>
                        <label for='user'>Username:</label>
                    </td>
                    <td>
                        <input type='text' name='user' required>
                    </td>
                </tr>
                <!--takes input for password-->
                <tr>
                    <td>
                        <label for='pass'>Password:</label>
                    </td>
                    <td>
                        <input type='password' name='pass' required>
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                <!--allows user to submit values-->
                <tr>
                    <td colspan='2'>
                        <input type='submit' value='Log In' style='width: 40%;'> <input type='reset' value='Clear' style='width: 40%;'>
                    </td>
                </tr>
            </table>
        </form>
        
        <!--links to register page-->
        <p>
            Don't have an account? <a href='registration.php'>Register now!</a>
            <br><br>
            <a href='employee_area/emp_login.php'>Employee Log In</a>
        </p>
    </body>
</html>