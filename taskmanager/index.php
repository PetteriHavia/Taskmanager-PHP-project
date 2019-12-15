<?php

  //connect to database
  $servername ="localhost";
  $username = "root";
  $password = "";
  $dbname = "taskmanager";


  //Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  //Check connection
  if($conn->connect_error) {
    die("Connection failed: " .$conn->connect_error);
  }


  //Select all data from "taskmanager" database
  $tasktable = mysqli_query($conn, "SELECT * FROM tasktable");

  ?>


<!DOCTYPE html>

<html>

  <head>
    <meta charset="utf-8">
    <title>Taskmanager</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- My CSS -->
    <link rel="stylesheet" type="text/css" href="css/taskcss.css">
    <!-- My JavaScript -->
    <script type="text/javascript" src="js/task.js"></script>

  </head>

  <body>
    <div class="header">
      <h1>TASKMANAGER</h1>
    </div>

<!-- Form starts here -->
  <?php require_once 'process.php'; ?>
    <form method="POST" action="process.php" name="taskForm">

      <!--Hidden inputfield used to get id of the row when edit btn is clicked -->
      <input type="hidden" name="id" value="<?php echo $id; ?> ">

    <!-- User input -->
      <input name="task" type ="text" id="taskInput" placeholder="Write task..."
      value="<?php echo $task; ?>">
      <input name="taskPerson" type ="text" id="taskPerson" placeholder="Person name..."
      value="<?php echo $taskPerson; ?>">

      <div id="message">
        <p></p>
      </div>

    <!-- List button -->
      <div class=btnDiv>
        <?php
        // Compare if form should show "list" btn or "update" btn
        if ($update == true):
        ?>
          <button type="submit" name="update" onclick="error()" class="listBtn">UPDATE</button>
      <?php else: ?>
          <button type="submit" name="submit" onclick="error()" class="listBtn">LIST</button>
      <?php endif; ?>
      </div>


    </form>

    <!-- Table starts here -->
    <table>
      <thead>
        <tr>
          <th>Order</th>
          <th>Task Description</th>
          <th>Person</th>
          <th>Manage</th>
        </tr>

      </thead>

      <tbody>
        <!-- Fetch all the data from database and insert them into table -->
        <!-- Add variable i to keep id in order after user deletes rows.-->
        <?php $i = 1; while($row = mysqli_fetch_array($tasktable)) { ?>
        <tr>
        <!-- Display all the rows from database -->
          <td><?php echo $i; ?></td>
          <td class="task"><?php echo $row['task']; ?></td>
          <td class="person"><?php echo $row['taskPerson']; ?></td>
          <td class="manage">
            <a href="index.php? edit=<?php echo $row['ID']; ?>" class ="edit" >Edit</a>
            <a href="process.php? delete=<?php echo $row['ID']; ?>" class ="delete" >Delete</a>
          </td>
        </tr>
        <?php $i++;} ?>
      </tbody>

    </table>

    <div class="bottomDiv">
      <!--ClEAR BUTTON-->
      <a href="process.php? clearBtn=<?php echo $row['ID']; ?>" class ="clearBtn" >CLEAR</a>
    </div>


  </body>

</html>
