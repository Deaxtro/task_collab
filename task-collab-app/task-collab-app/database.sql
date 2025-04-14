CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  role ENUM('admin', 'user') DEFAULT 'user'
);
CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  title VARCHAR(255),
  deadline DATE,
  priority ENUM('High', 'Medium', 'Low'),
  status ENUM('Pending', 'Completed') DEFAULT 'Pending',
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);