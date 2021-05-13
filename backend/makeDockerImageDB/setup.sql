CREATE DATABASE IF NOT EXISTS GroupUp;
USE GroupUp;
CREATE TABLE IF NOT EXISTS event (event_id INT AUTO_INCREMENT PRIMARY KEY, userName VARCHAR(30), eventTitle VARCHAR(50), eventType VARCHAR(30), eventDescription VARCHAR(200), userPhone VARCHAR(15), eventStreet VARCHAR(100), eventCity VARCHAR(50), eventState CHAR(2), eventZip VARCHAR(11), eventCountry VARCHAR(20), latitude DECIMAL(11,7), longitude DECIMAL(11,7));
