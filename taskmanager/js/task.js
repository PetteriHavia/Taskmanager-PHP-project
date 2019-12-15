function error() {

  var task = document.getElementById('taskInput').value;
  var taskPerson = document.getElementById('taskPerson').value;

  if (task == '' || taskPerson =='' ) {
        alert('You need to fill both fields!');
  }
}
