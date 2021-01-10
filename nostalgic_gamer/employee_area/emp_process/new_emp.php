<?php
//includes file with db connection
    require_once '../../db_connect.php';
    
    //gets session info
    session_start();
    
    //takes input passed from form and assigns to variables
    $fname = trim($_POST['fname']);
	$lname = trim($_POST['lname']);
	$email = trim($_POST['email']);
	$stadd = trim($_POST['stadd']);
	$city = trim($_POST['city']);
	$state = trim($_POST['state']);
	$zip = trim($_POST['zip']);
	$phone = trim($_POST['phone']);
	$position = trim($_POST['position']);
	
	//checks if all inputs have been passed
	if (!$fname || !$lname || !$email || !$stadd || !$city || !$state || !$zip || !$phone || !$position) {
	    $_SESSION['addfail'] = 'badinp';
	    header('Location: ../add_employee.php');
	    
	    //closes db conection
	    $db->close();
	    exit();
	}
	
    //gets id from current employees
    $query = 'SELECT employeeid, email FROM EMPLOYEES';
	$results = $db->query($query);
	
	//gets the number of results
	$num_results = $results->num_rows;
    
    //generates a 5 digit random number for employee id
    $empid = mt_rand(10000, 99999);
	
	//adds slashes for any quotes in inputs
	if (!get_magic_quotes_gpc()) {
        $fname = addslashes($fname);
        $lname = addslashes($lname);
        $stadd = addslashes($stadd);
        $city = addslashes($city);
        $email = addslashes($email);
        $position = addslashes($position);
	}
	
	$address = $stadd.', '.$city.', '.$state.' '.$zip;
  
    //loops through all current customers
    for ($i = 0; $i < $num_results; $i++) {
        $row = $results->fetch_assoc();
        
        //compares current ids with new ids
        if ($empid == $row['employeeid'])
            //creates a new random id if there is a match
            $empid = mt_rand(10000, 99999);
            
        //checks if email is already in use
        if ($email == $row['email']) {
            //redirects user to add employee page
            $_SESSION['addfail'] = 'emailtaken';
	        header('Location: ../add_employee.php');
	    
	        //closes db conection
	        $results->free();
	        $db->close();
	        exit();
        }
    }
    
    //converts customer id into string
    $empid = strval($empid);
	
	//creates insert query for db with user info
	$query = "INSERT INTO EMPLOYEES VALUES 
	('".$empid."',
	'".$fname."',
	'".$lname."',
	'".$email."',
	'".$address."',
	'".$phone."',
	'".$position."'
	)";
	
	//tries to insert user info into db
	$results = $db->query($query);
	
	//checks if insert was successful
	if ($results) {
	    $_SESSION['add_done'] = true;
	    header('Location: ../employee_info.php');
	    exit();
	}
	
	//checks if some other error has occurred
	else {
	    $_SESSION['addfail'] = 'randerr';
	    header('Location: ../add_employee.php');
	    exit();
	}
	
	//closes db connection
    $db->close();
?>