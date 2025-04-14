<?php require '../includes/auth.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>User Dashboard</title>
  <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
  <h2>User Dashboard</h2>
  <form id="taskForm">
    <input type="text" name="title" placeholder="Task Title" required><br>
    <input type="date" name="deadline" required><br>
    <select name="priority">
      <option>High</option>
      <option>Medium</option>
      <option>Low</option>
    </select><br>
    <button type="submit">Add Task</button>
  </form>
  <div id="taskList"></div>

  <script>
    document.getElementById('taskForm').onsubmit = async function(e) {
      e.preventDefault();
      const formData = new FormData(this);
      await fetch('../api/create_task.php', {
        method: 'POST',
        body: JSON.stringify(Object.fromEntries(formData))
      });
      fetchTasks();
    };

    async function fetchTasks() {
      const res = await fetch('../api/get_tasks.php');
      const tasks = await res.json();
      document.getElementById('taskList').innerHTML = tasks.map(t => `
        <div class="task">
          <strong>${t.title}</strong> <br>
          Deadline: ${t.deadline} | Priority: ${t.priority}
          <button onclick="deleteTask(${t.id})">Delete</button>
        </div>`).join('');
    }

    async function deleteTask(id) {
      await fetch('../api/delete_task.php', {
        method: 'POST',
        body: JSON.stringify({ id })
      });
      fetchTasks();
    }

    fetchTasks();
  </script>
</body>
</html>
