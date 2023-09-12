<?php
//This is the Main PHP Motors Model

//get the classification information from the carclassification table
function getClassifications() {
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();

    // The SQL statement to be used with the database
    $sql = 'SELECT classificationName, classificationId FROM carclassification ORDER BY classificationName ASC';

    //Create the prepared statement using the connection
    $stmt = $db->prepare($sql);
    //Run the prepared statement
    $stmt->execute();
    //Get the data from database and store it in named array
    $classifications = $stmt->fetchAll();

    //closes interaction with database
    $stmt->closeCursor();
    //returns array to function call
    return $classifications;
}


?>