<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login / Register</title>
  <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
  <h2>Login</h2>
  <form id="loginForm">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
  </form>

  <h2>Register</h2>
  <form id="registerForm">
    <input type="text" name="name" placeholder="Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Register</button>
  </form>

  <script>
    document.getElementById('loginForm').onsubmit = async function(e) {
      e.preventDefault();
      const formData = new FormData(this);
      const res = await fetch('../api/login.php', {
        method: 'POST',
        body: JSON.stringify(Object.fromEntries(formData))
      });
      const data = await res.json();
      if (data.success) window.location.href = 'dashboard.php';
      else alert('Login failed');
    };

    document.getElementById('registerForm').onsubmit = async function(e) {
      e.preventDefault();
      const formData = new FormData(this);
      const res = await fetch('../api/register.php', {
        method: 'POST',
        body: JSON.stringify(Object.fromEntries(formData))
      });
      const data = await res.json();
      if (data.success) alert('Registered successfully');
      else alert('Registration failed');
    };
  </script>
</body>
</html>
