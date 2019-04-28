
General info:

 - The migration.sql is located in PHP/Model/database
 - There is a basic test user with username: 'testuser' and password: 'password'
 - For me all the tests are passed when run from root folder.
 - All paths are changed to work only from root folder. It will not work if served of my folder (madre10).
 - See DB.config in root to change DB connection configs



##### FOR MYSELF ####
Run PHP server:
1. Command prompt "cmd"
2. Navigate to C:\Users\phoel\OneDrive\Dokumenter\GitHub\SDU-ITI-F19\madre10
                C:\Users\phoel\Documents\GitHub\SDU-ITI-F19\madre10 (Home)
3. php -S localhost:8080


Connect do MariaDB:
1. Open command prompt "cmd"
2. mysql -u root -p
3. password = root  //So much for plaintext passwords committed to GitHub. 10/10 stars.
4. use madre10


MAKE DUMP:
Possible navigate to a suitable folder.
Run this as administrator from CMD:
    mysqldump -u root -p madre10 > dump.sql

LOAD DUMP:
CREATE DATABASE test_db;
mysql -u root -p test_db < dump.sql
