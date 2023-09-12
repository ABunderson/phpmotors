/*
    reset after practice.
    ALTER TABLE clients AUTO_INCREMENT = 1;
*/

/*
    Enhancement 2: 1
	Insert a client into clients table
*/
INSERT INTO clients 
	(clientFirstname, clientLastname, clientEmail, clientPassword, comment)
Values 
	('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 'I am the real Ironman');
    
/*
    Enhancement 2: 2
	Change a clients level in the clients table
*/
UPDATE 
	clients
SET
	clientLevel = 3
WHERE
	clientId = 1;

/*
    Enhancement 2: 3
	Modify a car from the inventory
*/
UPDATE	
	inventory
SET
	invDescription = REPLACE(invDescription, 'small', 'spacious')
WHERE
	invId = 12;

/*
	Enhancement 2: 4
	Select all the invModels from the inventory table and the classification names from the carclassification table with the car classification of SUV found on the carclassification table.
*/
SELECT 
	inventory.invModel, carclassification.classificationName
FROM
	inventory
INNER JOIN
	carclassification ON inventory.classificationId=carclassification.classificationId
WHERE
	carclassification.classificationId = 1;

/*
	Enhancement 2: 5
	Delete an item from the inventory table
*/
DELETE
FROM
	inventory
WHERE
	invId = 1;

/*
	Enhancement 2: 6
	Update all inventory items to add '/phpmotors' to the file path of invImage and invThumbnail.
*/
UPDATE
	inventory
SET
	invImage = concat('/phpmotors', invImage), invThumbnail = concat('/phpmotors', invThumbnail);