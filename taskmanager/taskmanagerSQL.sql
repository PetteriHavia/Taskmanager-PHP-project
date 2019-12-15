/*
This script creates table for the "taskmanager" case database and inserts test data in the table
*/

-- Table structure for tasktable
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
