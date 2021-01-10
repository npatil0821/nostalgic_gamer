<?php
    //creates new database object
    @ $db = new mysqli('localhost', 'patiln1_ng_admin', 'fall2020s2', 'patiln1_nostalgic_gamer');
    
    //checks connection to database
    if (mysqli_connect_errno()) {
        echo 'Error: could not connect to database. Please try again later.';
        exit();
    }
?>