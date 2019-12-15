# Taskmanager-PHP-project

Project: TASKMANAGER

PROJECT DESCRIPTION

Taskmanager is a small app that was made for keeping records of information. Information consists of two things task and person responsible
for it. The app is much like a todo-list. The app displays saved information from the database to user and user can add ,edit/update and
delete the records in the database. It also has message function created with JavaScript that tells user if all the input fields are not
filled with needed information.

INSTALLATION

In order to get this application to work you need to use XAMPP and phpMyAdmin.

1. Move Taskmanager folder in to the XAMPP folder called htdocs.
  path: D/xampp/htdocs <-- Taskmanager inside here
  
2. Start XAMPP (xampp-start file).

3. Open XAMPP control and start Apache and MySQL. Check the portnumber your machine is using for Apache

4. Open browser and type in http://localhost/phpmyadmin/
   Remember to use the portnumber the Apache is using example: http://localhost:80/phpmyadmin/
   
5. Create new database called "taskmanager" in phpMyAdmin.

6. Import the taskmanagerSQL file to the database.
   This creates the needed table information for the app to save and display data.
   (The file is located in the Taskmanager folder)
   
  Incase the file taskmanagerSQL gives you error, copy paste the information below to the database SQL section and run it.
  Otherwise ignore this sql script. 
   
   CREATE TABLE TASKTABLE (
  ID int NOT NULL AUTO_INCREMENT,
  task varchar(255) NOT NULL,
  taskPerson varchar(255) NOT NULL,
  PRIMARY KEY (ID)
);

-- Insert some test data to  tasktable
  INSERT INTO TASKTABLE VALUES
  (1, 'Learn PHP', 'Petteri'),
  (2, 'This is test data', 'Person A'),
  (3, 'README file for information ', 'Person B');
   
   
   
7. Go to browser and type in http://localhost/Taskmanager/index.php. Remember the portnumber!

8. Application is now ready to be used.
