<?php
    //includes db connection
    require_once '../db_connect.php';
    
    //includes session info
    session_start();
    
    //checks if user is logged in
    if ((isset($_SESSION['emp_login']) && $_SESSION['emp_login']) === false) {
        $_SESSION['emp_nli'] = true;
        header('Location: emp_login.php');
        exit();
    }
    
    //informs user if employee was successfully deleted
    if ($_SESSION['emp_del'] == 'done') {
        $notice = "<p style='color: green;'>Employee successfully deleted!</p>";
        
        $_SESSION['emp_del'] = '';
    }
    
    //informs user if employee deletion failed
    else if ($_SESSION['emp_del'] == 'failed') {
        $notice = "<p style='color: red;'>ERROR: Could not delete employee. Please try again.";
        
        $_SESSION['emp_del'] = '';
    }
    
    else if ($_SESSION['emp_del'] == 'owner') {
        $notice = "<p style='color: red;'>ERROR: Cannot delete owner.</p>";
        
        $_SESSION['emp_del'] = '';
    }
    
    else if ($_SESSION['add_done'] == true) {
        $notice = "<p style='color: green;'>New employee added!</p>";
        
        $_SESSION['add_done'] == false;
    }
    
    //gets employee info
    $query = "SELECT * FROM EMPLOYEES";
    $results = $db->query($query);
    
    //gets number of results
    $num_results = $results->num_rows;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Employee Info</title>
        
        <style>
            /*centers all outputs and puts border around table and cells*/
            body {text-align: center;}
            
            table {
                position: relative;
                margin-left: auto;
                margin-right: auto;
                border: solid 1px black;
                border-collapse: collapse;
            }
            
            th, td {border: solid 1px black;}
        </style>
    </head>
    
    <body>
        <!--outputs header of all employee info-->
        <?php echo $notice; ?>
        <h1>Employee Info</h1>
        <table>
            <tr>
                <th>
                    Employee ID
                </th>
                <th>
                    First Name
                </th>
                <th>
                    Last Name
                </th>
                <th>
                    Email
                </th>
                <th>
                    Address
                </th>
                <th>
                    Cellphone
                </th>
                <th>
                    Position
                </th>
                <th>
                    Remove Employee
                </th>
            </tr>
            <?php
        for ($i = 0; $i < $num_results; $i++) {
            //outputs info for each employee as rows
            //allows user to click button to delete employee
            //form redirects to delete_employee.php for processing
            //sends employee id by post
            $row = $results->fetch_assoc();
            
            echo "<form action='emp_process/delete_employee.php' method='post'> 
                <tr>
                    <td>
                        ".$row['employeeid']."
                    </td>
                    <td>
                        ".$row['firstname']."
                    </td>
                    <td>
                        ".$row['lastname']."
                    </td>
                    <td>
                        ".$row['email']."
                    </td>
                    <td>
                        ".$row['address']."
                    </td>
                    <td>
                        ".$row['cellphone']."
                    </td>
                    <td>
                        ".$row['position']."
                    </td>
                    <td>
                        <input type='hidden' name='empid' value='".$row['employeeid']."'>
                        <input type='submit' value='Remove'>
                    </td>
                </tr>
            </form>";
        }
        ?>
        </table>
        <br>
        <!--redirects user to add_employee.php or admin_home.php-->
        <p>
            <a href='add_employee.php'>Add New Employee</a>
            <br>
            <a href='admin_home.php'>Admin Home</a>
        </p>
    </body>
</html>
<?php
    //closes db connection
    $results->free();
    $db->close();
?>