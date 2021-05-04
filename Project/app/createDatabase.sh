sudo mariadb -e "CREATE DATABASE IF NOT EXISTS groupUp"
sudo mariadb groupUp -e "CREATE TABLE IF NOT EXISTS event(event_id INT AUTO_INCREMENT PRIMARY KEY, userName VARCHAR(12), userTitle VARCHAR(20), userAddress VARCHAR(100), userCity VARCHAR(20), userState CHAR(2)); "
