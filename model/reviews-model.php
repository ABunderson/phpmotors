<?php

//function to insert a review into the reviews table
function addReview($reviewText, $invId, $clientId)
{
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO reviews (reviewText, invId, clientId) VALUES (:reviewText, :invId, :clientId)';
    // Create the prepared statement using the php_motors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with thte actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    //Insert the data
    $stmt->execute();
    // Ask how many rosw changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

//function to get reviews for a specific inventory item
function getItemReviews($invId)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM reviews INNER JOIN clients ON reviews.clientId = clients.clientId  WHERE reviews.invId = :invId ORDER BY reviews.reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

//function to get reviews written by a specific client
function getClientReviews($clientId)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM reviews INNER JOIN inventory ON reviews.invId = inventory.invId WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

//function to get a specific review
function getReview($reviewId)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM reviews INNER JOIN inventory ON reviews.invId = inventory.invId WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

//function to update a specific review
function updateReview($reviewId, $reviewText)
{
    $db = phpmotorsConnect();
    $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
    // Create the prepared statement using the php_motors connection
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    //insert data
    $stmt->execute();
    // Ask how many rosw changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

//function to delete a specific review
function deleteReview($reviewId)
{
    // open database
    $db = phpmotorsConnect();
    // Create the sql statement
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    // Create the prepared statement using the php_motors connection
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    //Insert the data
    $stmt->execute();
    // Ask how many rosw changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}
