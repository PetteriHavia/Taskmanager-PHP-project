<?php

  session_start();
  // Connect to database
  $conn = mysqli_connect("localhost", "root", "", "taskmanager") or die (mysqli_error($conn));

  // Variables
  $id = 0;
  //update btn display
  $update= false;
  // Before edit btn is clicked set task and taskPerson to be empty strings
  $task = '';
  $taskPerson = '';


  /*Insert new task into "taskmanager" database in table called "tasktable"
  + prevent SQL injections*/
  if(isset($_POST['submit'])) {
  //Connect to database
  $conn = mysqli_connect("localhost", "root", "", "taskmanager");
  // Check connection
  if($conn->connect_error) {
    die("Connection failed: " .$conn->connect_error);
  }
  //Check if user input is empty
  if(empty($_POST['task']) || empty($_POST['taskPerson'])) {
  //task.js calls error message in different file
     header('location: index.php');
   }else{
  //Make a prepared statement to prevent SQL injections
  $sql = "INSERT INTO tasktable (Task, taskPerson) VALUES (?, ?)";

  if($stmt = mysqli_prepare($conn, $sql)){
  // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "ss", $task, $taskPerson);
  //Set the parameters values and execute the statement again to insert another row
    $task = $_POST['task'];
    $taskPerson = $_POST['taskPerson'];
    mysqli_stmt_execute($stmt);
    header('location: index.php');
  }
  // Close statement
  mysqli_stmt_close($stmt);
}
  // Close connection
  mysqli_close($conn);
}



//Delete single row of data from database
if(isset($_GET['delete'])) {
  //Connect to database
  $conn = mysqli_connect("localhost", "root", "", "taskmanager");
  // Check connection
  if($conn->connect_error) {
    die("Connection failed: " .$conn->connect_error);
  }
  //Select the row id
  $id = $_GET['delete'];
  //Delete row where id matches
  mysqli_query($conn, "DELETE FROM tasktable WHERE ID=$id");
  header('location: index.php');
}



//Delete all the content from database
if(isset($_GET['clearBtn'])) {
  //Connect to database
  $conn = mysqli_connect("localhost", "root", "", "taskmanager");
  // Check connection
  if($conn->connect_error) {
    die("Connection failed: " .$conn->connect_error);
  }
  //Remove all the data from tasktable and reset the id
  mysqli_query($conn, "TRUNCATE TABLE tasktable");
  header('location: index.php');
}



//Edit selected table row
if(isset($_GET['edit'])) {
  $conn = mysqli_connect("localhost", "root", "", "taskmanager");
  // Check connection
  if($conn->connect_error) {
    die("Connection failed: " .$conn->connect_error);
  }

  $id = $_GET['edit'];
  $update = true; //Set update btn to be visible
  $result = $conn->query("SELECT * FROM tasktable WHERE ID=$id") or die($conn->error());

//Check if row exist in the table
if(!empty($result)==1) {
  $row = $result->fetch_array();
  $task = $row['task'];
  $taskPerson = $row['taskPerson'];
  }
}


//Update data
if(isset($_POST['update'])) {
//Check input fields
  if(empty($_POST['task']) || empty($_POST['taskPerson'])) {
     header('location: index.php');
   }else{
    $id = $_POST['id'];
    $task = $_POST['task'];
    $taskPerson = $_POST['taskPerson'];

    //prevent SQL injections with prepared statement
    $sql = $conn->prepare("UPDATE tasktable SET task = ?, taskPerson = ? WHERE ID= ?");
    $sql->bind_param("ssi", $task, $taskPerson, $id);
    $sql->execute();
    header('location: index.php');
  }
}
