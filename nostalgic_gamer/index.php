<?php
    //creates variables from passed values
    $user = trim(strtolower($_POST['user']));
    $pass = trim($_POST['pass']);
   
   //checks if input was taken
   if (!empty($user) && !empty($pass)) { 
        //checks if login info is valid
        if ($user == 'db_semester_project' && $pass == 'fall2020s2') {
            //redirects to homepage if valid
            header('Location: homepage.php');
            exit();
        }
        
        //informs user if login info is incorrect
        else {
            $notice = "<p style='color: red;'>Incorrect Login Info</p>";
        }
   }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>DB Semester Project</title>
        
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
        <?php echo $notice; ?>
        
        <!--takes input for username and password and passes to itself-->
        <form action='index.php' method='post'>
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
                <!--allows user to submit input-->
                <tr>
                    <td colspan='2'>
                        <input type='submit' value='Log In'>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>