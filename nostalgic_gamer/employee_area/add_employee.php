<?php
    //includes session info
    session_start();
    
    //notifies user if not everything was input
    if ($_SESSION['addfail'] == 'badinp') {
        $notice = 'Employee info was not properly input. Please try again.';
        
        $_SESSION['addfail'] = '';
    }
    
    //notifies user if email is already taken
    if ($_SESSION['addfail'] == 'emailtaken') {
        $notice = 'Email already in use. Please try again.';
        
        $_SESSION['addfail'] = '';
    }
    
    //notifies user if some other error occurs
    else if ($_SESSION['addfail'] == 'randerr') {
        $notice = 'An error has occurred. Please try again.';
        
        $_SESSION['addfail'] = '';
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Add Employee</title>
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
        
        <!--takes input and passes it to new_emp.php for processing-->
        <form action='emp_process/new_emp.php' method='post'>
            <table>
                <!--outputs page title-->
                <tr>
                    <td colspan='2'>
                        <h1>Add Employee</h1>
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
                
                <!--takes input for email-->
                <tr>
                    <td class='cat'>
                        <label for='email'>Email:</label>
                    </td>
                    <td>
                        <input type='email' name='email' required>
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
                
                <!--takes input for cellphone-->
                <tr>
                    <td class='cat'>
                        <label for='phone'>Cellphone:</label>
                    </td>
                    <td>
                        <input type='text' name='phone' pattern='[0-9]{10}' title='10 digit phone number' required>
                    </td>
                </tr>
                
                <!--takes input for position-->
                <tr>
                    <td class='cat'>
                        <label for='position'>Position:</label>
                    </td>
                    <td>
                        <input type='text' name='position' required>
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                
                <!--allows user to submit inputs-->
                <tr>
                    <td colspan='2'>
                        <input type='submit' value='Add Employee' style='width: 40%;'> <input type='reset' value='Clear' style='width: 40%;'>
                    </td>
                </tr>
            </table>
        </form>
        
        <!--links to employee info page-->
        <p><a href='employee_info.php'>Return to Employee Info</a></p>
    </body>
</html>

