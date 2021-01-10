<?php
    //includes file with db connection
    require_once '../db_connect.php';
    
    //gets session info
    session_start();
    
    //checks if user is already logged in
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        header('Location: ../homepage.php');
        $_SESSION['relog'] = true;
        
        //closes db conection
	    $db->close();
        exit();
    }
    
    //takes input passed from form and assigns to variables
    $user = strtolower(trim($_POST['user']));
    $pass = trim($_POST['pass']);
    
    //informs user if not all inputs are entered and exits
    if (!$user || !$pass) {
        $_SESSION['logfail'] = 'impinp';
        header('Location: ../login.php');
        
        //closes db conection
	    $db->close();
        exit();
  }
    
    //queries db for username entered
    $query = "SELECT password, firstname FROM CUSTOMERS WHERE username = '".$user."'";
    $result = $db->query($query);
    
    
    //checks if results were returned
    if ($result->num_rows == 0) {
        $_SESSION['logfail'] = 'userdne';
        header('Location: ../login.php');
        
        //closes db conection
	    $db->close();
	    $result->free();
        exit();
    }
    
    //gets associative array from result
    $row = $result->fetch_assoc();
    
    //compares password hashed saved with password entered; logs in and redirects to homepage if passwords match
    if (password_verify($pass, $row['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['user'] = $user;
        $_SESSION['name'] = $row['firstname'];
        
        $_SESSION['newlog'] = true;
        header('Location: ../homepage.php');
        
        //closes db connection
        $result->free();
        $db->close();
        exit();
    }
    
    //if password is wrong, returns to login page
    else {
        $_SESSION['logfail'] = 'wrongpass';
        header('Location: ../login.php');
        
        //closes db connection
        $result->free();
        $db->close();
        exit();
    }
?>