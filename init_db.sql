DROP TABLE IF EXISTS sneakers;

CREATE TABLE sneakers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  image VARCHAR(255),
  name VARCHAR(100),
  sname VARCHAR(100),
  comment TEXT
);

