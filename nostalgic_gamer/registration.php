<?php
    //gets session info
    session_start();
    
    //notifies user if not everything was input
    if ($_SESSION['regfail'] == 'badinp') {
        $notice = 'Registration info was not properly input. Please try again.';
        
        $_SESSION['regfail'] = '';
    }
    
    //notifies user if password is not long enough
    else if ($_SESSION['regfail'] == 'shortpass') {
        $notice = 'Password must be at least 6 characters. Please try again.';
        
        $_SESSION['regfail'] = '';
    }
    
    //notifies user if passwords do not match
    else if ($_SESSION['regfail'] == 'nopassmatch') {
        $notice = 'Passwords do not match. Please try again.';
        
        $_SESSION['regfail'] = '';
    }
    
    //notifies user if username is already taken
    else if ($_SESSION['regfail'] == 'usertaken') {
        $notice = 'Username already taken. Please try again.';
        
        $_SESSION['regfail'] = '';
    }
    
    else if ($_SESSION['regfail'] == 'emailtaken') {
        $notice = 'Email already in use. Please try again.';
        
        $_SESSION['regfail'] = '';
    }
    
    //notifies user if some other error occurs
    else if ($_SESSION['regfail'] == 'randerr') {
        $notice = 'An error has occurred. Please try again.';
        
        $_SESSION['regfail'] = '';
    }

?>

<!--This page takes input from a new user to create an account. The user's username, password, first name, last name, street address, city, state, and zip code are taken. The form is then passed to reg_confirm.php to process.

    A table is set up to make the display of the form neater. Each row takes an
    input from the user for a value.

    The values taken are, in order, username, password, first name, last name,
    street address, city, state, and zip code. All inputs are required. 

    All of the inputs except state is taken through text. State is taken through
    a datalist. At the end, there is a submit button to submit the input and a
    reset button to clear the input.

    State and Zip inputs have a max length of 2 and 5.-->

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Registration</title>
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
        
        <!--takes inputs and passes them to reg_confirm.php to process-->
        <form action='process/reg_confirm.php' method='post'>
            <table>
                <!--outputs page title-->
                <tr>
                    <td colspan='2'>
                        <h1>Registration</h1>
                    </td>
                </tr>
                
                <!--takes input for username-->
                <tr>
                    <td class='cat'>
                        <label for='user'>Username:</label>
                    </td>
                    <td>
                        <input type='text' name='user' required>
                    </td>
                </tr>
                
                <!--takes input for password-->
                <tr>
                    <td class='cat'>
                        <label for='pass'>Password:</label>
                    </td>
                    <td>
                        <input type='password' name='pass' required>
                    </td>
                </tr>
                
                <!--takes password confirmation-->
                <tr>
                    <td class='cat'>
                        <label for='conpass'>Confirm Password:</label>
                    </td>
                    <td>
                        <input type='password' name='conpass' required>
                    </td>
                </tr>
                
                <!--takes input for email-->
                <tr>
                    <td class='cat'>
                        <label for='email'>Email:</label>
                    </td>
                    <td>
                        <input type='email' name='email' required>
                    </td>
                </tr>
                
                <!--takes input for first name-->
                <tr>
                    <td class='cat'>
                        <label for='fname'>First Name:</label>
                    </td>
                    <td>
                        <input type='text' name='fname' required>
                    </td>
                </tr>
                
                <!--takes input for last name-->
                <tr>
                    <td class='cat'>
                        <label for='lname'>Last Name:</label>
                    </td>
                    <td>
                        <input type='text' name='lname' required>
                    </td>
                </tr>
                
                <!--takes input for street address-->
                <tr>
                    <td class='cat'>
                        <label for='stadd'>Street Address:</label>
                    </td>
                    <td>
                        <input type='text' name='stadd' required>
                    </td>
                </tr>
                
                <!--takes input for city-->
                <tr>
                    <td class='cat'>
                        <label for='city'>City:</label>
                    </td>
                    <td>
                        <input type='text' name='city' required>
                    </td>
                </tr>
                
                <!--takes input for state-->
                <tr>
                    <td class='cat'>
                        <label for='state'>State:</label>
                    </td>
                    <td>
                        <!--code for dropdown menu modified from https://gist.github.com/pusherman/3145761-->
                        <select id="state" name='state' style='width: 100%;' required>
                            <option value=''>Select A State</option>
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </td>
                </tr>
                
                <!--takes input for zip code-->
                <tr>
                    <td class='cat'>
                        <label for='zip'>ZIP Code:</label>
                    </td>
                    <td>
                        <input type='text' name='zip' pattern='[0-9]{5}' title='5-digit ZIP code' required>
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                
                <!--allows user to submit inputs-->
                <tr>
                    <td colspan='2'>
                        <input type='submit' value='Register' style='width: 40%;'> <input type='reset' value='Clear' style='width: 40%;'>
                    </td>
                </tr>
            </table>
        </form>
        
        <!--links to log in page-->
        <p>Already have an account? <a href='login.php'>Log in now!</a></p>
    </body>
</html>