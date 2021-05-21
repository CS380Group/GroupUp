CREATE DATABASE IF NOT EXISTS GroupUp;
USE GroupUp;
CREATE TABLE IF NOT EXISTS user (
    userId INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(255),
    lastName VARCHAR(255), 
    emailAddress VARCHAR(255),
    streetAddress VARCHAR(255),
    cityAddress VARCHAR(255),
    stateAddress CHAR(2),
    phoneNumber VARCHAR(15),
    password VARCHAR(255),
    dateOfCreation DATE
);
CREATE TABLE IF NOT EXISTS event (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    userId INT, 
    eventTitle VARCHAR(50), 
    eventType VARCHAR(30), 
    eventDescription VARCHAR(200), 
    userPhone VARCHAR(15), 
    eventStreet VARCHAR(255), 
    eventCity VARCHAR(255), 
    eventState CHAR(2), 
    eventZip VARCHAR(11), 
    eventCountry VARCHAR(255), 
    latitude DECIMAL(11,7), 
    longitude DECIMAL(11,7),
    FOREIGN KEY (userId) REFERENCES user(userId)
);
CREATE TABLE IF NOT EXISTS directMessage (
    messageId INT AUTO_INCREMENT PRIMARY KEY,
    messageSendDate DATE,
    messageSender INT,
    messageRecipient INT,
    messageContents VARCHAR(8000),
    FOREIGN KEY (messageSender) REFERENCES user(userId),
    FOREIGN KEY (messageRecipient) REFERENCES user(userId)
);
CREATE TABLE IF NOT EXISTS eventComment (
    commentId INT AUTO_INCREMENT PRIMARY KEY,
    commentDate DATE,
    commentEvent INT,
    commentUser INT,
    commentContents VARCHAR(8000),
    FOREIGN KEY (commentUser) REFERENCES user(userId),
    FOREIGN KEY (commentEvent) REFERENCES event(event_id)
);
