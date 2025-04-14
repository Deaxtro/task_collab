<?php require '../includes/auth.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
  <h2>Admin Dashboard</h2>
  <div id="taskList"></div>
  <script>
    async function fetchTasks() {
      const res = await fetch('../api/get_tasks.php');
      const tasks = await res.json();
      document.getElementById('taskList').innerHTML = tasks.map(t => `
        <div class="task">
          <strong>${t.title}</strong> by ${t.name} <br>
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
