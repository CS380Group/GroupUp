
echo "It is recommended that we use a docker image for our database, instead of a local instance."

sudo mariadb --user='root' --password='123' -e "CREATE DATABASE IF NOT EXISTS GroupUp"
sudo mariadb --user='root' --password='123' GroupUp -e "CREATE TABLE IF NOT EXISTS event(event_id INT AUTO_INCREMENT PRIMARY KEY, userName VARCHAR(30), userTitle VARCHAR(50), userType VARCHAR(30), userDescription VARCHAR(200), userPhone VARCHAR(15), userAddress VARCHAR(100), userCity VARCHAR(20), userState CHAR(2)); "
